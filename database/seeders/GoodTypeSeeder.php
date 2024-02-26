<?php

namespace Database\Seeders;

use App\Enums\GoodTypeEnum;
use App\Models\GoodType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class GoodTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        GoodType::query()->delete();
        foreach ($this->goodTypes() as $goodType => $goodTypeData) {
            GoodType::factory()->create([
                'name' => $goodType,
                'code' => Str::lower($goodTypeData['code']),
                'description' => $goodTypeData['description'],
            ]);
        }
    }

    public function goodTypes(): array
    {
        return [
            GoodTypeEnum::CAMERAS->value => [
                'code' => GoodTypeEnum::CAMERAS->name,
                'description' => 'Фото и видео камеры', ],
            GoodTypeEnum::LENSES->value => [
                'code' => GoodTypeEnum::LENSES->name,
                'description' => 'Объективы для камер', ],
            GoodTypeEnum::LIGHT->value => [
                'code' => GoodTypeEnum::LIGHT->name,
                'description' => 'Софтбоксы, лампы, доп. освещение', ],
            GoodTypeEnum::SOUND->value => [
                'code' => GoodTypeEnum::SOUND->name,
                'description' => 'Микрофоны, звукопульты, рекордеры', ],
            GoodTypeEnum::STABILIZERS->value => [
                'code' => GoodTypeEnum::STABILIZERS->name,
                'description' => 'Стабилизаторы для камер', ],
            GoodTypeEnum::BATTERIES->value => [
                'code' => GoodTypeEnum::BATTERIES->name,
                'description' => 'Аккумуляторы для оборудования', ],
            GoodTypeEnum::DRONES->value => [
                'code' => GoodTypeEnum::DRONES->name,
                'description' => 'Квадрокоптеры на пульте управления', ],
            GoodTypeEnum::DATA_CARDS->value => [
                'code' => GoodTypeEnum::DATA_CARDS->name,
                'description' => 'Расширяемая память для устройств', ],
            GoodTypeEnum::CAGES->value => [
                'code' => GoodTypeEnum::CAGES->name,
                'description' => 'Клетки для оборудования', ],
            GoodTypeEnum::DISPLAYS->value => [
                'code' => GoodTypeEnum::DISPLAYS->name,
                'description' => 'Мониторы для лучшего обзора съемочных объектов', ],
            GoodTypeEnum::MISCELLANEOUS->value => [
                'code' => GoodTypeEnum::MISCELLANEOUS->name,
                'description' => 'Дополнительные инструменты для оборудования', ],
            GoodTypeEnum::SOFTBOXES->value => [
                'code' => GoodTypeEnum::SOFTBOXES->name,
                'description' => 'Софтбоксы для наладки света', ],
            GoodTypeEnum::FILTERS->value => [
                'code' => GoodTypeEnum::FILTERS->name,
                'description' => 'Фильтры для камер', ],
            GoodTypeEnum::STANDS->value => [
                'code' => GoodTypeEnum::STANDS->name,
                'description' => 'Штативы и стойки для удобной установки камер и оборудования', ],
            GoodTypeEnum::KITS->value => [
                'code' => GoodTypeEnum::KITS->name,
                'description' => 'Наборы инструментов, тщательно подобранные для комфортной работы друг с другом', ],
        ];
    }
}
