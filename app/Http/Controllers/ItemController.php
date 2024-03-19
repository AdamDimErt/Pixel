<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    public function getUnavailableDates(Request $request, Item $item)
    {
        $relatedOrderStamps = DB::table('order_items')
            ->select(['rent_start_date', 'rent_end_date'])
            ->where('item_id', '=', $item->id)
            ->get();

        $forbiddenDates = $this->getDatesBetween($relatedOrderStamps);

        return response()
            ->json([
                'success' => true,
                'forbiddenDates' => $forbiddenDates
            ]);
    }

    public function getAvailableTimes(Request $request, Item $item)
    {
        $startDate = $request->input('start_date');
        $relatedOrderTimeStamps = DB::table('order_items')
            ->where('item_id', '=', $item->id)
            ->get();

        $forbiddenTimes = $this->getAvailableTimespans($relatedOrderTimeStamps, $startDate);
        $nextUnavailableDate = $this->getNextOrderDate($relatedOrderTimeStamps, $startDate);

        return response()
            ->json([
                'success' => true,
                'availableTimes' => $forbiddenTimes,
                'nextUnavailableDate' => $nextUnavailableDate
            ]);
    }

    public function getAvailableRentEndTimespans(Request $request, Item $item)
    {
        $finishDate = $request->input('finish_date');
        $finishTime = $request->input('finish_time');
        $relatedOrderTimeStamps = DB::table('order_items')
            ->where('item_id', '=', $item->id)
            ->get();

        $timeSpans = $this->getNextRentTimeSpans($relatedOrderTimeStamps, $finishDate, $finishTime);

        return response()
            ->json([
                'success' => true,
                'nextAvailableTimes' => $timeSpans
            ]);
    }

    public function getNextRentTimeSpans(Collection $orderItems, $rentStartDate, $rentStartTime)
    {
        $selectedDateTime = Carbon::parse("$rentStartDate $rentStartTime");

        $futureRentStartTimes = [];

        foreach ($orderItems as $orderItem) {
            $itemRentStartDate = Carbon::parse($orderItem->rent_start_date . ' ' . $orderItem->rent_start_time);

            if ($selectedDateTime->lessThan($itemRentStartDate)) {
                $futureRentStartTimes[] = $itemRentStartDate;
            }
        }

        usort($futureRentStartTimes, function ($a, $b) use ($selectedDateTime) {
            $diffA = $a->diffInMinutes($selectedDateTime);
            $diffB = $b->diffInMinutes($selectedDateTime);
            return $diffA <=> $diffB;
        });

        $timeSpans = [];

        if (!empty($futureRentStartTimes)) {
            $closestRentStartTime = $futureRentStartTimes[0];

            $currentTime = $selectedDateTime->copy();
            $currentTime->addMinutes(5);

            while ($currentTime->lessThanOrEqualTo($closestRentStartTime)) {
                $timeSpans[] = $currentTime->format('H:i');
                $currentTime->addMinutes(5);
            }
        } else {
            $rentStartData = explode(':', $rentStartTime);
            for ($hours = (int) $rentStartData[0]; $hours < 24; $hours++) {
                for ($minutes = (int) $rentStartData[1] + 5; $minutes < 60; $minutes += 5) {
                    $hoursStr = str_pad($hours, 2, '0', STR_PAD_LEFT);
                    $minutesStr = str_pad($minutes, 2, '0', STR_PAD_LEFT);

                    $timeSpans[] = "$hoursStr:$minutesStr";
                }
            }
            return $timeSpans;
        }

        return $timeSpans;
    }

    public function getNextOrderDate(Collection $orderItems, $date)
    {
        $selectedDate = Carbon::parse($date);

        $futureRentStartDates = [];

        foreach ($orderItems as $orderItem) {
            $rentStartDate = Carbon::parse($orderItem->rent_start_date);

            if ($rentStartDate->greaterThanOrEqualTo($selectedDate)) {
                $futureRentStartDates[] = $rentStartDate;
            }
        }

        usort($futureRentStartDates, function ($a, $b) {
            return $a <=> $b;
        });
        if (!empty($futureRentStartDates)) {
            return $futureRentStartDates[0]->format('Y-m-d');
        }

        return null;
    }

    public function getAvailableTimeSpans(Collection $orderItems, $date)
    {
        $occupiedTimeSlots = [];
        $selectedDate = Carbon::parse($date);
        foreach ($orderItems as $orderItem) {
            $rentStartDate = Carbon::parse($orderItem->rent_start_date);
            $rentStartTime = Carbon::parse($orderItem->rent_start_time);
            $rentEndDate = Carbon::parse($orderItem->rent_end_date);
            $rentEndTime = Carbon::parse($orderItem->rent_end_time);
            if ($selectedDate->between($rentStartDate, $rentEndDate)) {
                if ($selectedDate->equalTo($rentStartDate)) {
                    $startTime = $rentStartTime;
                } else {
                    $startTime = Carbon::createFromTime(0, 0, 0);
                }
                if ($selectedDate->equalTo($rentEndDate)) {
                    $endTime = $rentEndTime;
                } else {
                    $endTime = Carbon::createFromTime(23, 59, 0);
                }
                while ($startTime->lessThan($endTime)) {
                    $occupiedTimeSlots[] = $startTime->format('H:i');
                    $startTime->addMinutes(5);
                }
            }
        }
        $availableTimeSlots = [];
        $startTime = Carbon::createFromTime(0, 0, 0);
        $endTime = Carbon::createFromTime(23, 59, 0);
        while ($startTime->lessThan($endTime)) {
            $timeSlot = $startTime->format('H:i');
            if (!in_array($timeSlot, $occupiedTimeSlots)) {
                $availableTimeSlots[] = $timeSlot;
            }
            $startTime->addMinutes(5);
        }

        return $availableTimeSlots;
    }

    public static function getDatesBetween(Collection $items): array
    {
        $dates = [];
        foreach ($items as $item) {
            $startDate = Carbon::parse($item->rent_start_date);
            $endDate = Carbon::parse($item->rent_end_date);
            while ($startDate->addDay() < $endDate) {
                $dates[] = $startDate->copy()->format('d/m/Y');
            }
        }

        return $dates;
    }
}
