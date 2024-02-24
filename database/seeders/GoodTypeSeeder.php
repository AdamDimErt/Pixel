<?php

namespace Database\Seeders;

use App\Enums\GoodTypeEnum;
use App\Models\GoodType;
use Illuminate\Database\Seeder;

class GoodTypeSeeder extends Seeder
{

    private const GOODTYPES = [
        GoodTypeEnum::CAMERAS->value => 'Фото и видео камеры',
        GoodTypeEnum::LENSES->value => 'Объективы для камер',
        GoodTypeEnum::LIGHT->value => 'Софтбоксы, лампы, доп. освещение',
        GoodTypeEnum::SOUND->value => 'Микрофоны, звукопульты, рекордеры',
        GoodTypeEnum::STABILIZERS->value => 'Стабилизаторы для камер',
        GoodTypeEnum::BATTERIES->value => 'Аккумуляторы для оборудования',
        GoodTypeEnum::DRONES->value => 'Квадрокоптеры на пульте управления',
        GoodTypeEnum::DATA_CARDS->value => 'Расширяемая память для устройств',
        GoodTypeEnum::CAGES->value => 'Клетки для оборудования',
        GoodTypeEnum::DISPLAYS->value => 'Мониторы для лучшего обзора съемочных объектов',
        GoodTypeEnum::MISCELLANEOUS->value => 'Дополнительные инструменты для оборудования',
        GoodTypeEnum::SOFTBOXES->value => 'Софтбоксы для наладки света',
        GoodTypeEnum::FILTERS->value => 'Фильтры для камер',
        GoodTypeEnum::STANDS->value => 'Штативы и стойки для удобной установки камер и оборудования',
        GoodTypeEnum::KITS->value => 'Наборы инструментов, тщательно подобранные для комфортной работы друг с другом',
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        GoodType::query()->delete();
        foreach (self::GOODTYPES as $goodTypeName => $desc){
            GoodType::factory()->create([
                'name' => $goodTypeName,
                'description' => $desc,
            ]);
        }
    }
}
