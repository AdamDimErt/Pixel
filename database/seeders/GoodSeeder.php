<?php

namespace Database\Seeders;

use App\Enums\GoodEnum;
use App\Enums\GoodTypeEnum;
use App\Models\Additional;
use App\Models\Good;
use App\Models\GoodType;
use Illuminate\Database\Seeder;
use Illuminate\Http\UploadedFile;
use Orchid\Attachment\File;

class GoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Good::query()->delete();
        foreach ($this->goods() as $goodTypeName => $good) {
            $goodTypeId = GoodType::query()->where('name', '=', $goodTypeName)->firstOrFail()->id;

            foreach ($good as $key => $value) {
                $good = Good::factory()->create([
                    'name' => $value['name'],
                    'description' => $value['description'],
                    'cost' => $value['cost'],
                    'damage_cost' => $value['damage_cost'],
                    'additionals' => Additional::query()->whereIn('name', $value['additionals'])->pluck('id'),
                    'good_type_id' => $goodTypeId,
                    'discount_cost' => null,
                    'related_goods' => Good::query()->inRandomOrder()->limit(5)->pluck('id'),
                ]);

                if (! is_null($value['image'])) {
                    $file = new UploadedFile('resources/img/'.$value['image'], $value['image']);

                    $attachment = (new File($file))->load();

                    $good->attachment()->syncWithoutDetaching($attachment);
                }
            }
        }
    }

    public function goods(): array
    {
        return [
            GoodTypeEnum::CAMERAS->value => $this->cameras(),
            GoodTypeEnum::LENSES->value => $this->lenses(),
            GoodTypeEnum::LIGHT->value => $this->light(),
            GoodTypeEnum::SOUND->value => $this->sound(),
            GoodTypeEnum::STABILIZERS->value => $this->stabilizers(),
            GoodTypeEnum::BATTERIES->value => $this->batteries(),
            GoodTypeEnum::DRONES->value => $this->drones(),
            GoodTypeEnum::DATA_CARDS->value => $this->dataCards(),
            GoodTypeEnum::CAGES->value => $this->cages(),
            GoodTypeEnum::DISPLAYS->value => $this->displays(),
            GoodTypeEnum::MISCELLANEOUS->value => $this->miscellaneous(),
            GoodTypeEnum::SOFTBOXES->value => $this->softboxes(),
            GoodTypeEnum::FILTERS->value => $this->filters(),
            GoodTypeEnum::STANDS->value => $this->stands(),
            GoodTypeEnum::KITS->value => $this->kits(),
        ];
    }

    public function cameras(): array
    {
        return [
            GoodEnum::CINEMA_CAMERA_SONY_FX6->name => [
                'name' => GoodEnum::CINEMA_CAMERA_SONY_FX6->value,
                'cost' => 40000,
                'damage_cost' => 3000000,
                'description' => '-SONY FX6 (Fullframe)
                -Sony bp battery,
                -Ручка с монитором',
                'additionals' => [
                    'SmallRig 99wh v mount',
                    'SWIT BP 220WH',
                    'Tilta V mount',
                    'CF Tough 160gb',
                ],
                'image' => '5.png',
            ],
            GoodEnum::CINEMA_CAMERA_BLACKMAGIC_6K_PRO->name => [
                'name' => GoodEnum::CINEMA_CAMERA_BLACKMAGIC_6K_PRO->value,
                'cost' => 16500,
                'damage_cost' => 1350000,
                'description' => '-Blackmagic 6k pro (super 35)
-NP-F570',
                'additionals' => [
                    'SSD Samsung T7 1Tb',
                    'Объектив Sigma 18-35mm f1.8',
                    'Объектив Samyang VDSLR',
                    'Tilta + v mount',
                    'SmallRig 99wh',
                ],
                'image' => '18.png',
            ],
            GoodEnum::CINEMA_CAMERA_SONY_FX3->name => [
                'name' => GoodEnum::CINEMA_CAMERA_SONY_FX3->value,
                'cost' => 23000,
                'damage_cost' => 2000000,
                'description' => '-Sony FX3 (Fullframe)
-Аккумулятор NPF Z100',
                'additionals' => [
                    'CF Tough 80gb',
                    'Карта памяти 256gb sony 277mbs',
                    'Tilta advanced cage',
                    'Доп аккумулятор NPF Z100',
                ],
                'image' => '7.png',
            ],
            GoodEnum::CINEMA_CAMERA_SONY_FX30->name => [
                'name' => GoodEnum::CINEMA_CAMERA_SONY_FX30->value,
                'cost' => 11500,
                'damage_cost' => 1000000,
                'description' => '-Sony FX-30 (APC)
-Аккумулятор NPF Z100',
                'additionals' => [
                    'CF Tough 80gb',
                    'Карта памяти 256gb sony 277mbs',
                    'Tilta advanced cage',
                    'Доп аккумулятор NPF Z100',
                ],
                'image' => '8.png',

            ],
            GoodEnum::PHOTO_CAMERA_CANON_R7->name => [
                'name' => GoodEnum::PHOTO_CAMERA_CANON_R7->value,
                'cost' => 10000,
                'damage_cost' => 700000,
                'description' => '-Canon R7 (APC)
-Аккумулятор LP-E6N',
                'additionals' => [
                    'Переходник RF-EF',
                    'Карта памяти Sandisk 64gb 200mbs',
                    'Объектив Canon RF 24-105mm f4-7.1',
                    'Дополнительный аккумулятор',
                ],
                'image' => '15.png',

            ],
            GoodEnum::PHOTO_CAMERA_CANON_R->name => [
                'name' => GoodEnum::PHOTO_CAMERA_CANON_R->value,
                'cost' => 10000,
                'damage_cost' => 700000,
                'description' => '-Canon R (Fullframe)
-Аккумулятор LP-E6N',
                'additionals' => [
                    'Переходник RF-EF',
                    'Карта памяти Sandisk 64gb 200mbs',
                    'Объектив Canon RF 24-105mm f4-7.1',
                    'Дополнительный аккумулятор',
                ],
                'image' => '16.png',

            ],
            GoodEnum::PHOTO_CAMERA_SONY_A7_III->name => [
                'name' => GoodEnum::PHOTO_CAMERA_SONY_A7_III->value,
                'cost' => 10000,
                'damage_cost' => 750000,
                'description' => '-Sony A7 III (Fullframe)
-Аккумулятор NPF Z100',
                'additionals' => [
                    'Карта памяти Sandisk 64gb 200mbs',
                    'Kit объектив 28-70mm oss f3.5-5.6',
                    'Клетка A7 III с рукояткой UURig',
                    'Дополнительный аккумулятор',
                ],
                'image' => '4.png',
            ],
            GoodEnum::PHOTO_CAMERA_SONY_A7C->name => [
                'name' => GoodEnum::PHOTO_CAMERA_SONY_A7C->value,
                'cost' => 10000,
                'damage_cost' => 750000,
                'description' => '-Sony A7 С (Fullframe)
-Аккумулятор NPF Z100',
                'additionals' => [
                    'Карта памяти Sandisk 64gb 200mbs',
                    'Kit объектив 28-70mm oss f3.5-5.6',
                    'Клетка A7c',
                    'Дополнительный аккумулятор',
                ],
                'image' => '10.png',
            ],
            GoodEnum::PHOTO_CAMERA_SONY_A7_IV->name => [
                'name' => GoodEnum::PHOTO_CAMERA_SONY_A7_IV->value,
                'cost' => 12500,
                'damage_cost' => 120000,
                'description' => '-Sony A7 IV (Fullframe)
-Аккумулятор NPF Z100',
                'additionals' => [
                    'Карта памяти Sandisk 64gb 200mbs',
                    'Kit объектив 28-70mm oss f3.5-5.6',
                    'Клетка Sony a7 IV',
                    'Дополнительный аккумулятор',
                ],
                'image' => '9.png',
            ],
            GoodEnum::PHOTO_CAMERA_SONY_A6600->name => [
                'name' => GoodEnum::PHOTO_CAMERA_SONY_A6600->value,
                'cost' => 8000,
                'damage_cost' => 650000,
                'description' => '-Sony A6600 (APC)
-Аккумулятор NPF Z100',
                'additionals' => [
                    'Карта памяти Sandisk 64gb 200mbs',
                    'Kit объектив 18-135mm f3.5-5.6',
                    'Клетка a6600',
                    'Дополнительный аккумулятор',
                ],
                'image' => '12.png',
            ],
            GoodEnum::PHOTO_CAMERA_SONY_A6400->name => [
                'name' => GoodEnum::PHOTO_CAMERA_SONY_A6400->value,
                'cost' => 5500,
                'damage_cost' => 500000,
                'description' => '-Sony A6400 (APC)
-Аккумулятор NPF Z100',
                'additionals' => [
                    'Карта памяти Sandisk 64gb 200mbs',
                    'Kit объектив 18-135mm f3.5-5.6',
                    'Клетка a6400',
                    'Дополнительный аккумулятор',
                ],
                'image' => '11.png',
            ],
            GoodEnum::PHOTO_CAMERA_FUJIFILM_T4->name => [
                'name' => GoodEnum::PHOTO_CAMERA_FUJIFILM_T4->value,
                'cost' => 10000,
                'damage_cost' => 500000,
                'description' => '-Fujifilm T4 (APC)
-Аккумулятор NP-W235',
                'additionals' => [
                    'Карта памяти Sandisk 64gb 200mbs',
                    'Kit Fujifilm 18-55mm f2.8-4',
                    'Клетка Fujifilm T4',
                    'Дополнительный аккумулятор',
                ],
                'image' => '14.png',
            ],
            GoodEnum::PHOTO_CAMERA_FUJIFILM_T3->name => [
                'name' => GoodEnum::PHOTO_CAMERA_FUJIFILM_T3->value,
                'cost' => 6000,
                'damage_cost' => 600000,
                'description' => '-Fujifilm T3 (APC)
-Аккумулятор W126',
                'additionals' => [
                    'Карта памяти Sandisk 64gb 200mbs',
                    'Kit Fujifilm 18-55mm f2.8-4',
                    'Клетка Fujifilm T3',
                    'Дополнительный аккумулятор',
                ],
                'image' => '13.png',
            ],
            GoodEnum::ACTION_CAMERA_GO_PRO_11->name => [
                'name' => GoodEnum::ACTION_CAMERA_GO_PRO_11->value,
                'cost' => 9000,
                'damage_cost' => 200000,
                'description' => '-Go pro 11
-Аккумулятор go pro 10-11',
                'additionals' => [
                    'Карта памяти micro Sandisk 64gb 200mbs',
                    'Крепление на голову',
                    'Крепление на грудь',
                    'Крепление на машину',
                    'Аквабокс',
                    'Селфи палка',
                    'Дополнительный аккумулятор',
                ],
                'image' => '17.png',
            ],
        ];
    }

    public function lenses(): array
    {
        return [
            GoodEnum::OBJECTIVE_SONY_16_50MM_F3_5_5_6_OSS->name => [
                'name' => GoodEnum::OBJECTIVE_SONY_16_50MM_F3_5_5_6_OSS,
                'cost' => 2000,
                'damage_cost' => 100000,
                'description' => 'Размер матрицы APSC
Байонет Sony E
Фокусное расстояние, мм 16−50
Светосила 3.5−5.6
Мин. дистанция фокусировки, м 0.25−0.3
Стабилизация изображения есть',
                'additionals' => [],
                'image' => '36.png',
            ],
            GoodEnum::OBJECTIVE_SONY_28_70MM_F3_5_5_6_OSS->name => [
                'name' => GoodEnum::OBJECTIVE_SONY_28_70MM_F3_5_5_6_OSS->value,
                'cost' => 2000,
                'damage_cost' => 200000,
                'description' => 'Размер матрицы Full frame
Байонет Sony E
Фокусное расстояние, мм 28-70
Светосила 3.5-5.6
Мин. дистанция фокусировки, м 0.3-0.45
Стабилизация изображения есть',
                'additionals' => [],
                'image' => null,
            ],
            GoodEnum::OBJECTIVE_SONY_28_60MM_F4_5_6_OSS->name => [
                'name' => GoodEnum::OBJECTIVE_SONY_28_60MM_F4_5_6_OSS->value,
                'cost' => 2000,
                'damage_cost' => 200000,
                'description' => 'Размер матрицы Full frame
Байонет Sony E
Фокусное расстояние, мм 28-70
Светосила 3.5-5.6
Мин. дистанция фокусировки, м 0.3-0.45
Стабилизация изображения есть',
                'additionals' => [],
                'image' => '35.png',
            ],
            GoodEnum::OBJECTIVE_SONY_ZEISS_24_70MM_F4_OSS->name => [
                'name' => GoodEnum::OBJECTIVE_SONY_ZEISS_24_70MM_F4_OSS->value,
                'cost' => 3500,
                'damage_cost' => 300000,
                'description' => 'Размер матрицы Full frame
Байонет Sony E
Фокусное расстояние, мм 24−70
Светосила 4
Мин. дистанция фокусировки, м 0.38
Стабилизация изображения есть',
                'additionals' => [
                    'ND Filter 77mm',
                ],
                'image' => '34.png',
            ],
            GoodEnum::OBJECTIVE_SONY_85MM_GM_F1_4->name => [
                'name' => GoodEnum::OBJECTIVE_SONY_85MM_GM_F1_4->value,
                'cost' => 10000,
                'damage_cost' => 700000,
                'description' => 'Размер матрицы Full frame
Байонет Sony E
Фокусное расстояние, мм 85
Светосила 1.4
Мин. дистанция фокусировки, м 0.85
Стабилизация изображения нет',
                'additionals' => [
                    'ND Filter 77mm',
                ],
                'image' => '22.png',
            ],
            GoodEnum::OBJECTIVE_SONY_35MM_GM_F1_4->name => [
                'name' => GoodEnum::OBJECTIVE_SONY_35MM_GM_F1_4->value,
                'cost' => 10000,
                'damage_cost' => 650000,
                'description' => 'Размер матрицы Full frame
Байонет Sony E
Фокусное расстояние, мм35
Светосила f1.4
Мин. дистанция фокусировки, м 0.26
Стабилизация изображения нет',
                'additionals' => [
                    'ND Filter Freewell 67mm',
                    'Tiffent mist Filter 67mm',
                ],
                'image' => '23.png',
            ],
            GoodEnum::OBJECTIVE_SONY_70_200_MM_GM_II_F2_8->name => [
                'name' => GoodEnum::OBJECTIVE_SONY_70_200_MM_GM_II_F2_8,
                'cost' => 16500,
                'damage_cost' => 1200000,
                'description' => 'Размер матрицы Full frame
фокусное расстояние — 70−200 мм;
диафрагма — f/2,8-f/22;
минимальное расстояние фокусировки — 0,4 м;
число лепестков диафрагмы — 11;
длина — 200 мм;
масса — 1045 г.
',
                'additionals' => [
                    'ND Filter 77mm',
                ],
                'image' => '24.png',
            ],
            GoodEnum::OBJECTIVE_SONY_20MM_G_F1_8->name => [
                'name' => GoodEnum::OBJECTIVE_SONY_20MM_G_F1_8->value,
                'cost' => 6000,
                'damage_cost' => 450000,
                'description' => 'Размер матрицы Full frame
Байонет Sony E
Фокусное расстояние, мм 20
Светосила 1.8
Мин. дистанция фокусировки, м 0.18
Стабилизация изображения нет',
                'additionals' => [
                    'ND Filter Freewell 67mm',
                    'Tiffent mist Filter 67mm',
                ],
                'image' => '21.png',
            ],
            GoodEnum::OBJECTIVE_SONY_18_105MM_G_F4->name => [
                'name' => GoodEnum::OBJECTIVE_SONY_18_105MM_G_F4->value,
                'cost' => 4000,
                'damage_cost' => 300000,
                'description' => 'Размер матрицы APSC
Байонет Sony E
Фокусное расстояние, мм 18−105
Светосила 4
Мин. дистанция фокусировки, м 0.45−0.95',
                'additionals' => [
                    'ND Filter 77mm',
                ],
                'image' => '25.png',
            ],
            GoodEnum::OBJECTIVE_SONY_18_135MM_F3_5_5_6->name => [
                'name' => GoodEnum::OBJECTIVE_SONY_18_135MM_F3_5_5_6->value,
                'cost' => 3500,
                'damage_cost' => 200000,
                'description' => 'Размер матрицы — APSC
Светосила — f3.5−5.6
Мин. дистанция фокусировки, м 0.45
Стабилизация изображения — есть',
                'additionals' => [
                    'ND Filter Freewell 67mm',
                    'Tiffent mist Filter 67mm',
                ],
                'image' => '118.png',
            ],
            GoodEnum::OBJECTIVE_SONY_50MM_F1_8->name => [
                'name' => GoodEnum::OBJECTIVE_SONY_50MM_F1_8->value,
                'cost' => 2500,
                'damage_cost' => 160000,
                'description' => 'Размер матрицы Full frame
Байонет Sony E
Фокусное расстояние, мм 50
Светосила 1.8
Мин. дистанция фокусировки, м 0.45
Стабилизация изображения нет',
                'additionals' => [
                    'ND Filter Freewell 67mm',
                    'Tiffent mist Filter 67mm',
                ],
                'image' => '32.png',
            ],
            GoodEnum::OBJECTIVE_TAMRON_28_75MM_F2_8_RXD_SONY->name => [
                'name' => GoodEnum::OBJECTIVE_TAMRON_28_75MM_F2_8_RXD_SONY->value,
                'cost' => 6000,
                'damage_cost' => 400000,
                'description' => 'Размер матрицы Full frame
Байонет Sony E
Фокусное расстояние, мм 28-75
Светосила 2.8
Мин. дистанция фокусировки, м 0.34
Стабилизация изображения нет',
                'additionals' => [
                    'ND Filter Freewell 67mm',
                    'Tiffent mist Filter 67mm',
                ],
                'image' => '19.png',
            ],
            GoodEnum::OBJECTIVE_TAMRON_17_70MM_F2_8_RXD_SONY->name => [
                'name' => GoodEnum::OBJECTIVE_TAMRON_17_70MM_F2_8_RXD_SONY->value,
                'cost' => 6000,
                'damage_cost' => 400000,
                'description' => 'Размер матрицы APC
Байонет Sony E
Фокусное расстояние, мм 17−70
Светосила 2.8
Мин. дистанция фокусировки, м 0.19
Стабилизация изображения нет',
                'additionals' => [
                    'ND Filter Freewell 67mm',
                    'Tiffent mist Filter 67mm',
                ],
                'image' => '20.png',
            ],
            GoodEnum::OBJECTIVE_SIGMA_ART_24_70MM_F2_8_DG_DN_SONY->name => [
                'name' => GoodEnum::OBJECTIVE_SIGMA_ART_24_70MM_F2_8_DG_DN_SONY->value,
                'cost' => 8000,
                'damage_cost' => 500000,
                'description' => 'Размер матрицы Full frame
Байонет E mount
Светосила f2.8
Минимальное расстояние фокусировки, м 0.18
Стабилизация изображения нет',
                'additionals' => [],
                'image' => '33.png',
            ],
            GoodEnum::OBJECTIVE_SIGMA_70MM_F2_8_DG_MACRO_SONY->name => [
                'name' => GoodEnum::OBJECTIVE_SIGMA_70MM_F2_8_DG_MACRO_SONY->value,
                'cost' => 5500,
                'damage_cost' => 250000,
                'description' => 'Размер матрицы Full frame
Байонет Sony E mount
Фокусное расстояние, мм 70
Светосила 2.8
Мин. дистанция фокусировки, м 0.26
Стабилизация изображения нет
',
                'additionals' => [],
                'image' => '31.png',
            ],
            GoodEnum::OBJECTIVE_SIGMA_ART_16_28MM_F2_8_DG_DN_SONY->name => [
                'name' => GoodEnum::OBJECTIVE_SIGMA_ART_16_28MM_F2_8_DG_DN_SONY->value,
                'cost' => 6500,
                'damage_cost' => 400000,
                'description' => 'Размер матрицы Full frame
Байонет Sony E
Фокусное расстояние, мм 16−28
Светосила 2.8
Мин. дистанция фокусировки, м 0.25
Стабилизация изображения нет',
                'additionals' => [
                    'ND Filter 77mm',
                ],
                'image' => '29.png',
            ],
            GoodEnum::OBJECTIVE_SIGMA_56MM_F1_4_DC_DN_SONY->name => [
                'name' => GoodEnum::OBJECTIVE_SIGMA_56MM_F1_4_DC_DN_SONY->value,
                'cost' => 3000,
                'damage_cost' => 200000,
                'description' => 'Размер матрицы APSC
Байонет Sony E
Фокусное расстояние, мм 56
Светосила 1.4
Мин. дистанция фокусировки, м 0.5
Стабилизация изображения нет',
                'additionals' => [],
                'image' => '28.png',
            ],
            GoodEnum::OBJECTIVE_SIGMA_30MM_F1_4_DC_DN_SONY->name => [
                'name' => GoodEnum::OBJECTIVE_SIGMA_30MM_F1_4_DC_DN_SONY->value,
                'cost' => 3000,
                'damage_cost' => 200000,
                'description' => 'Размер матрицы APSC
Байонет Sony E
Фокусное расстояние, мм 30
Светосила 1.4
Мин. дистанция фокусировки, м 0.3
Стабилизация изображения нет',
                'additionals' => [],
                'image' => '27.png',
            ],
            GoodEnum::OBJECTIVE_SIGMA_16MM_F1_4_DC_DN_SONY->name => [
                'name' => GoodEnum::OBJECTIVE_SIGMA_16MM_F1_4_DC_DN_SONY->value,
                'cost' => 3500,
                'damage_cost' => 200000,
                'description' => 'Размер матрицы APSC
Байонет Sony E
Фокусное расстояние, мм 16
Светосила 1.4
Мин. дистанция фокусировки, м 0.25
Стабилизация изображения нет',
                'additionals' => [
                    'ND Filter Freewell 67mm',
                    'Tiffent mist Filter 67mm',
                ],
                'image' => '26.png',
            ],
            GoodEnum::OBJECTIVE_SIRUI_50MM_F1_8_ANAMORPHIC_SONY->name => [
                'name' => GoodEnum::OBJECTIVE_SIRUI_50MM_F1_8_ANAMORPHIC_SONY->value,
                'cost' => 5000,
                'damage_cost' => 250000,
                'description' => 'Размер матрицы — APSC
Байонет Sony E
Светосила — f1.8
Стабилизация изображения — нет
Анаморфотное искажение — 1.33',
                'additionals' => [],
                'image' => '115.png',
            ],
            GoodEnum::FUJINON_18_55MM->name => [
                'name' => GoodEnum::FUJINON_18_55MM->value,
                'cost' => 3500,
                'damage_cost' => 200000,
                'description' => 'Размер матрицы APSC
Байонет Fujifilm X
Фокусное расстояние, мм 18-55
Светосила 2.8-4..0
Мин. дистанция фокусировки, м 0.3
Стабилизация изображения есть',
                'additionals' => [
                    'ND Filter 77mm',
                ],
                'image' => '37.png',
            ],
            GoodEnum::CANON_RF_50MM_F1_8->name => [
                'name' => GoodEnum::CANON_RF_50MM_F1_8->value,
                'cost' => 2500,
                'damage_cost' => 100000,
                'description' => 'Размер матрицы Full frame
Байонет Canon RF
Фокусное расстояние, мм 50
Светосила 1.8
Мин. дистанция фокусировки, м 0.3
Стабилизация изображения нет',
                'additionals' => [],
                'image' => '85.png',
            ],
            GoodEnum::CANON_RF_24_105_MM_F4_7_1->name => [
                'name' => GoodEnum::CANON_RF_24_105_MM_F4_7_1->value,
                'cost' => 3000,
                'damage_cost' => 200000,
                'description' => 'Размер матрицы Full frame
Байонет Canon RF
Фокусное расстояние, мм 24−105
Светосила 4−7.1
Мин. дистанция фокусировки, м 0.34
Стабилизация изображения есть',
                'additionals' => [
                    'ND Filter Freewell 67mm',
                    'Tiffent mist Filter 67mm',
                ],
                'image' => '86.png',
            ],
            GoodEnum::SAMYANG_14MM_CANON->name => [
                'name' => GoodEnum::SAMYANG_14MM_CANON->value,
                'cost' => 5000,
                'damage_cost' => 250000,
                'description' => 'Размер матрицы Full frame
Байонет Canon EF
Фокусное расстояние, мм 14
Светосила 2.8
Мин. дистанция фокусировки, м 0.28
Стабилизация изображения нет',
                'additionals' => [],
                'image' => '78.png',
            ],
            GoodEnum::SAMYANG_24MM_CANON->name => [
                'name' => GoodEnum::SAMYANG_24MM_CANON->value,
                'cost' => 5000,
                'damage_cost' => 250000,
                'description' => 'Размер матрицы Full frame
Байонет Canon EF
Фокусное расстояние, мм 24
Светосила 1.5
Мин. дистанция фокусировки, м 0.25
Стабилизация изображения нет',
                'additionals' => [
                    'ND Filter 77mm',
                ],
                'image' => '77.png',
            ],
            GoodEnum::SAMYANG_135MM_CANON->name => [
                'name' => GoodEnum::SAMYANG_135MM_CANON->value,
                'cost' => 5000,
                'damage_cost' => 250000,
                'description' => 'Размер матрицы Full frame
Байонет Canon EF
Фокусное расстояние, мм 135
Светосила 2.2
Мин. дистанция фокусировки, м 0.8
Стабилизация изображения нет',
                'additionals' => [
                    'ND Filter 77mm',
                ],
                'image' => '79.png',
            ],
            GoodEnum::SAMYANG_85MM_CANON->name => [
                'name' => GoodEnum::SAMYANG_85MM_CANON->value,
                'cost' => 5000,
                'damage_cost' => 250000,
                'description' => 'Размер матрицы Full frame
Байонет Canon EF
Фокусное расстояние, мм 85
Светосила 1.4
Мин. дистанция фокусировки, м 1
Стабилизация изображения нет',
                'additionals' => [
                    'ND Filter 77mm',
                ],
                'image' => '76.png',
            ],
            GoodEnum::SAMYANG_35MM_CANON->name => [
                'name' => GoodEnum::SAMYANG_35MM_CANON->value,
                'cost' => 5000,
                'damage_cost' => 250000,
                'description' => 'Размер матрицы Full frame
Байонет Canon EF
Фокусное расстояние, мм 35
Светосила 1.5
Мин. дистанция фокусировки, м 0.3
Стабилизация изображения нет',
                'additionals' => [
                    'ND Filter 77mm',
                ],
                'image' => '81.png',
            ],
            GoodEnum::SIGMA_ART_18_35_MM_DC_CANON->name => [
                'name' => GoodEnum::SIGMA_ART_18_35_MM_DC_CANON->value,
                'cost' => 7000,
                'damage_cost' => 350000,
                'description' => 'Размер матрицы APSC
Байонет Canon EF-S
Фокусное расстояние, мм 18-35
Светосила 1.8
Мин. дистанция фокусировки, м 0.28
Стабилизация изображения есть',
                'additionals' => [
                    'ND Filter 77mm',
                ],
                'image' => '84.png',
            ],
            GoodEnum::SIGMA_ART_24_70MM_DG_CANON->name => [
                'name' => GoodEnum::SIGMA_ART_24_70MM_DG_CANON->value,
                'cost' => 10000,
                'damage_cost' => 600000,
                'description' => 'Размер матрицы Full frame
Байонет Canon EF
Фокусное расстояние, мм 24-70
Светосила 2.8
Мин. дистанция фокусировки, м 0.37
Стабилизация изображения есть',
                'additionals' => [],
                'image' => '30.png',
            ],
        ];
    }

    private function light(): array
    {
        return [
            GoodEnum::APUTURE_300X->name => [
                'name' => GoodEnum::APUTURE_300X->value,
                'cost' => 10000,
                'damage_cost' => 500000,
                'description' => 'Мощность 350 ват
Переменная CCT: от 2700 до 6500K',
                'additionals' => [
                    'Cтойка Godox 380',
                    'Софтбокс Lantern 90',
                    'Софтбокс Octadome 120',
                ],
                'image' => '106.png',

            ],
            GoodEnum::APUTURE_600X->name => [
                'name' => GoodEnum::APUTURE_600X->value,
                'cost' => 15000,
                'damage_cost' => 900000,
                'description' => 'Мощность 720 ват
Переменная CCT: от 2700 до 6500K',
                'additionals' => [
                    'С-Stand',
                    'Софтбокс dome 150',
                ],
                'image' => '105.png',

            ],
            GoodEnum::APUTURE_NOVA_P300_KIT->name => [
                'name' => GoodEnum::APUTURE_NOVA_P300_KIT->value,
                'cost' => 14000,
                'damage_cost' => 800000,
                'description' => 'Aputure Nova P300c — RGBWW.
Большая панель мощностью 360 ват.',
                'additionals' => [
                    'С-Stand',
                    'Cофтбокс P300',
                ],
                'image' => '110.png',

            ],
            GoodEnum::APUTURE_MC_RGBW_2->name => [
                'name' => GoodEnum::APUTURE_MC_RGBW_2->value,
                'cost' => 2500,
                'damage_cost' => 50000,
                'description' => 'Карманная панель RGBWW
Bi-color: 3200K-6500K
Мощность: 5 W
Время автономной работы: 2 часа (максимальная яркость), 15 часов (минимальная яркость)
Вес: 130 г
Толщина: 17 мм',
                'additionals' => [],
                'image' => '112.png',
            ],
            GoodEnum::AMARAN_150C->name => [
                'name' => GoodEnum::AMARAN_150C->value,
                'cost' => 6000,
                'damage_cost' => 200000,
                'description' => 'CCT от 2500 до 7500K
управление цветом HSI на 360°
Мощность 150 вт',
                'additionals' => [
                    'Софтбокс Lantern',
                    'Софтбокс Octadome 120',
                    'Стойка',
                ],
                'image' => '41.png',
            ],
            GoodEnum::GODOX_SL200III->name => [
                'name' => GoodEnum::GODOX_SL200III->value,
                'cost' => 7000,
                'damage_cost' => 175000,
                'description' => 'Мощный источник дневного света, мощностью 200 ват, который поможет вам отснять качественные видео на Ютуб, Тикток и многое другое.',
                'additionals' => [
                    'Стойка',
                    'Софтбокс godox 60x60',
                ],
                'image' => '74.png',

            ],
            GoodEnum::GODOX_SL100BI->name => [
                'name' => GoodEnum::GODOX_SL100BI->value,
                'cost' => 4500,
                'damage_cost' => 100000,
                'description' => 'Мощность 100 ват
Переменная CCT: от 2700 до 6500K',
                'additionals' => [
                    'Стойка',
                    'Софтбокс godox 60x60',
                ],
                'image' => '73.png',
            ],
            GoodEnum::GODOX_AD300PRO->name => [
                'name' => GoodEnum::GODOX_AD300PRO->value,
                'cost' => 6000,
                'damage_cost' => 250000,
                'description' => 'Мощный моноблок на 300 Дж
Встроенный приемник системы 2.4G X используется для дистанционного запуска и управления параметрами моноблока',
                'additionals' => [
                    'Стойка',
                    'Софтбокс godox 60x60',
                ],
                'image' => '75.png',

            ],
            GoodEnum::NANLITE_FORZA_60C->name => [
                'name' => GoodEnum::NANLITE_FORZA_60C->value,
                'cost' => 6500,
                'damage_cost' => 300000,
                'description' => 'Nanlite Forza 60C — прожектор RGBLAC
CCT: 1800К-20000К
Мощность: 88Вт
Софтбокс входит в стоимость',
                'additionals' => [
                    'Стойка godox',
                    '2 аккумулятора NPF 970 для беспроводной зарядки',
                ],
                'image' => '102.png',

            ],
            GoodEnum::APUTURE_100X->name => [
                'name' => GoodEnum::APUTURE_100X->value,
                'cost' => 5500,
                'damage_cost' => 150000,
                'description' => 'Мощность 100 ват
Переменная CCT: от 2700 до 6500K',
                'additionals' => [
                    'Стойка',
                    'Софтбокс godox 60x60',
                ],
                'image' => '104.png',

            ],
            GoodEnum::GODOX_TL60->name => [
                'name' => GoodEnum::GODOX_TL60->value,
                'cost' => 4000,
                'damage_cost' => 100000,
                'description' => 'RGB Джедайка
Регулировка цветовой температуры 2700К~6500К
Время работы от батареи при полной мощности около 2 часов
Длина 0.7 м',
                'additionals' => [
                    'Стойка',
                ],
                'image' => '68.png',
            ],
            GoodEnum::GODOX_V1_FLASH->name => [
                'name' => GoodEnum::GODOX_V1_FLASH->value,
                'cost' => 3500,
                'damage_cost' => 110000,
                'description' => 'Полная совместимость с Canon, а также совместима в мануальным режиме для камер Sony и Nikon',
                'additionals' => [
                    'Cофтбокс',
                    'Синхронизатор Godox X PRO',
                    'Монопод',
                ],
                'image' => '67.png',
            ],
            GoodEnum::GODOX_V860_FLASH->name => [
                'name' => GoodEnum::GODOX_V860_FLASH->value,
                'cost' => 3000,
                'damage_cost' => 100000,
                'description' => 'Полная совместимость с Sony',
                'additionals' => [
                    'Cофтбокс',
                    'Синхронизатор Godox X PRO',
                    'Монопод',
                ],
                'image' => '61.png',
            ],
            GoodEnum::NANLITE_DJEDAIKA_30CM->name => [
                'name' => GoodEnum::NANLITE_DJEDAIKA_30CM->value,
                'cost' => 3000,
                'damage_cost' => 50000,
                'description' => '"Мощность: 6 Вт
Цветовая температура: 2700−7500K
Вес: 260гр.
Время зарядки: 2,5ч
Время работы: 100% мощности :~65 минут;
Длина 0.3 м"',
                'additionals' => [],
                'image' => '43.png',
            ],
            GoodEnum::APUTURE_AMARAN_P60C->name => [
                'name' => GoodEnum::APUTURE_AMARAN_P60C->value,
                'cost' => 5000,
                'damage_cost' => 200000,
                'description' => '"Полная регулировка RGB
Цветовая температура, К2500 - 7500
Мощность диодов, Вт 60
В комплект входит софтбокс, соты"',
                'additionals' => [
                    'Стойка godox',
                    '2 аккумулятора NPF 970 для беспроводной зарядки',
                ],
                'image' => '39.png',
            ],
        ];
    }

    private function sound(): array
    {
        return [
            GoodEnum::DJI_MIC_DUO->name => [
                'name' => GoodEnum::DJI_MIC_DUO->value,
                'cost' => 5000,
                'damage_cost' => 160000,
                'description' => 'Диапазон эффективной передачи 250 м
2-канальная запись
Встроенное хранилище до 14 часов
Время работы батареи 15 часов',
                'additionals' => [],
                'image' => '88.png',
            ],
            GoodEnum::DJI_MIC_2_DUO->name => [
                'name' => GoodEnum::DJI_MIC_2_DUO->value,
                'cost' => 6000,
                'damage_cost' => 200000,
                'description' => 'Новинка 2024 года !
Диапазон эффективной передачи 250 м
2-канальная запись
32-битная запись
Встроенное хранилище до 14 часов
Время работы батареи 15 часов',
                'additionals' => [],
                'image' => '89.png',

            ],
            GoodEnum::HOLLYLAND_LARK_MAX->name => [
                'name' => GoodEnum::HOLLYLAND_LARK_MAX->value,
                'cost' => 5000,
                'damage_cost' => 160000,
                'description' => 'Диапазон эффективной передачи 250 м
2-канальная запись
Звук студийного качества
Встроенное хранилище до 14 часов
Время работы батареи 8 часов',
                'additionals' => [],
                'image' => '90.png',
            ],
            GoodEnum::RODE_GO_2->name => [
                'name' => GoodEnum::RODE_GO_2->value,
                'cost' => 4000,
                'damage_cost' => 150000,
                'description' => 'Диапазон эффективной передачи 200м
2-канальная запись
Встроенное хранилище до 24 часов
Время работы батареи 7 часов',
                'additionals' => ['Переходник на телефон'],
                'image' => '87.png',
            ],
            GoodEnum::BOYA_WM4_PRO_K2->name => [
                'name' => GoodEnum::BOYA_WM4_PRO_K2->value,
                'cost' => 2000,
                'damage_cost' => 80000,
                'description' => 'Двухканальный Беспроводной Приёмник
Цифровой 2,4ГГц Диапазон Частот
Всенаправленный петличный микрофон
Рабочий диапазон 60 м (без препятствий)
Питание от двух батареек типа ААА (в комплект не входит)',
                'additionals' => [],
                'image' => '60.png',
            ],
            GoodEnum::SARAMONIC_UWMIC9_TX_TX_RX->name => [
                'name' => GoodEnum::SARAMONIC_UWMIC9_TX_TX_RX->value,
                'cost' => 2000,
                'damage_cost' => 200000,
                'description' => 'Диапазон передачи: 514MHz - 596MHz
Группы каналов: A,B
Диапазон записи: 40 Гц-18 кГц (+/- 3 дБ)
Дальность действия: 100 м (без препятствий); до 60 м (в помещении)
Питание: Две батарейки типа AA (в комплект не входит)
Время работы 1-2 часа',
                'additionals' => [],
                'image' => '59.png',
            ],
            GoodEnum::MICROPHONE_RODE_VIDEOMIC_PRO->name => [
                'name' => GoodEnum::MICROPHONE_RODE_VIDEOMIC_PRO->value,
                'cost' => 2000,
                'damage_cost' => 100000,
                'description' => 'Конденсаторный микрофон телевещательного качества
Сверхлегкий (85 г), сверхкомпактный (15 см длиной)
Питание от 9В батарейки (свыше 70 часов)',
                'additionals' => [],
                'image' => '56.png',
            ],
            GoodEnum::WALKIE_TALKIE_LUITON_316->name => [
                'name' => GoodEnum::WALKIE_TALKIE_LUITON_316->value,
                'cost' => 1000,
                'damage_cost' => 20000,
                'description' => 'радиосвязь на расстоянии до 6 км!
Литиевая батарея емкостью 1500 мАч обеспечивает напряженную работу радиостанции в течение 8 часов.
Динамики повышенной мощности (1000 мВт) обеспечивают громкий и разборчивый звук.',
                'additionals' => [],
                'image' => null,

            ],
            GoodEnum::AUDIO_RECORDER_ZOOM_H6->name => [
                'name' => GoodEnum::AUDIO_RECORDER_ZOOM_H6->value,
                'cost' => 4500,
                'damage_cost' => 180000,
                'description' => 'Одновременная запись на шесть дорожек.
4 микрофонных/линейных входа с комбинированными разъемами XLR/TRS.
Прямая запись на SD, SDHC и SDXC карты емкостью до 128 ГБ.
Запись аудио качеством до 24-бит/96 кГц в BWF-совместимом формате WAV или в различных MP3-форматах.
Встроенные эффекты, включающие фильтр обрезки низких частот, компрессор и лимитер.
Работа от стандартных алкалиновых батареек типа AA или аккумуляторов NiMH.
Более 20 часов работы от четырех алкалиновых батареек.',
                'additionals' => [],
                'image' => '91.png',
            ],
        ];
    }

    private function stabilizers(): array
    {
        return [
            GoodEnum::RONIN_RS_2->name => [
                'name' => GoodEnum::RONIN_RS_2->value,
                'cost' => 10000,
                'damage_cost' => 450000,
                'description' => 'Cтабилизатор массой 1 кг можно установить 4,5 кг.
совместим с Black magic 6k pro
Возможность сьемки в вертикальном положении',
                'additionals' => [
                    'Raven eye' => 2000,
                    'Ручка' => 1000,
                    'Follow focus' => 1000,
                ],
                'image' => '116.png',
            ],
            GoodEnum::RONIN_SC->name => [
                'name' => GoodEnum::RONIN_SC->value,
                'cost' => 6000,
                'damage_cost' => 200000,
                'description' => '',
                'additionals' => [],
                'image' => '38.png',
            ],
            GoodEnum::OSMO_4->name => [
                'name' => GoodEnum::OSMO_4->value,
                'cost' => 3000,
                'damage_cost' => 100000,
                'description' => '',
                'additionals' => [],
                'image' => '117.png',
            ],
        ];
    }

    private function batteries(): array
    {
        return [
            GoodEnum::SONY_NP_FZ100->name => [
                'name' => GoodEnum::SONY_NP_FZ100->value,
                'cost' => 1000,
                'damage_cost' => 50000,
                'description' => '',
                'additionals' => [],
                'image' => '98.png',
            ],
            GoodEnum::SONY_NP_FW50->name => [
                'name' => GoodEnum::SONY_NP_FW50->value,
                'cost' => 1000,
                'damage_cost' => 35000,
                'description' => '',
                'additionals' => [],
                'image' => null,
            ],
            GoodEnum::FUJIFILM_NP_W126->name => [
                'name' => GoodEnum::FUJIFILM_NP_W126->value,
                'cost' => 1000,
                'damage_cost' => 40000,
                'description' => '',
                'additionals' => [],
                'image' => null,
            ],
            GoodEnum::FUJIFILM_NP_W235->name => [
                'name' => GoodEnum::FUJIFILM_NP_W235->value,
                'cost' => 1000,
                'damage_cost' => 40000,
                'description' => '',
                'additionals' => [],
                'image' => null,
            ],
            GoodEnum::CANON_LP_E6NH->name => [
                'name' => GoodEnum::CANON_LP_E6NH->value,
                'cost' => 1000,
                'damage_cost' => 50000,
                'description' => '',
                'additionals' => [],
                'image' => null,
            ],
            GoodEnum::FUJIFILM_NP_W235_DUMMY_BATTERY->name => [
                'name' => GoodEnum::FUJIFILM_NP_W235_DUMMY_BATTERY->value,
                'cost' => 1000,
                'damage_cost' => 30000,
                'description' => '',
                'additionals' => [],
                'image' => '101.png',
            ],
            GoodEnum::SONY_NP_FZ100_DUMMY_BATTERY->name => [
                'name' => GoodEnum::SONY_NP_FZ100_DUMMY_BATTERY->value,
                'cost' => 1000,
                'damage_cost' => 30000,
                'description' => '',
                'additionals' => [],
                'image' => '100.png',
            ],
            GoodEnum::BOYA_IPHONE_ADAPTER_CABLE->name => [
                'name' => GoodEnum::BOYA_IPHONE_ADAPTER_CABLE->value,
                'cost' => 500,
                'damage_cost' => 15000,
                'description' => '',
                'additionals' => [],
                'image' => null,
            ],
            GoodEnum::NP_FZ100_SONY_CHARGER->name => [
                'name' => GoodEnum::NP_FZ100_SONY_CHARGER->value,
                'cost' => 1000,
                'damage_cost' => 15000,
                'description' => '',
                'additionals' => [],
                'image' => null,
            ],
            GoodEnum::NP_FW50_SONY_CHARGER->name => [
                'name' => GoodEnum::NP_FW50_SONY_CHARGER->value,
                'cost' => 1000,
                'damage_cost' => 15000,
                'description' => '',
                'additionals' => [],
                'image' => null,
            ],
            GoodEnum::GOPRO_BATTERIES->name => [
                'name' => GoodEnum::GOPRO_BATTERIES->value,
                'cost' => 1000,
                'damage_cost' => 40000,
                'description' => '',
                'additionals' => [],
                'image' => null,
            ],
            GoodEnum::NPF_970_SET_OF_12->name => [
                'name' => GoodEnum::NPF_970_SET_OF_12->value,
                'cost' => 1500,
                'damage_cost' => 60000,
                'description' => '',
                'additionals' => [],
                'image' => '97.png',
            ],
            GoodEnum::NPF_750_SET_OF_1->name => [
                'name' => GoodEnum::NPF_750_SET_OF_1->value,
                'cost' => 1000,
                'damage_cost' => 40000,
                'description' => '',
                'additionals' => [],
                'image' => null,
            ],
            GoodEnum::SMALL_RIG_V_MOUNT_99WH->name => [
                'name' => GoodEnum::SMALL_RIG_V_MOUNT_99WH->value,
                'cost' => 2500,
                'damage_cost' => 100000,
                'description' => '',
                'additionals' => [],
                'image' => '99.png',
            ],
            GoodEnum::AIR_2_BATTERIES->name => [
                'name' => GoodEnum::AIR_2_BATTERIES->value,
                'cost' => 4000,
                'damage_cost' => 80000,
                'description' => '',
                'additionals' => [],
                'image' => null,
            ],
        ];
    }

    private function drones(): array
    {
        return [
            GoodEnum::DJI_AIR_2->name => [
                'name' => GoodEnum::DJI_AIR_2->value,
                'cost' => 16000,
                'damage_cost' => 600000,
                'description' => 'DJI Mavic Air 2 -  Дрон снабжён камерой с сенсором более высокого разрешения, фирменной технологией передачи сигнала OcuSync, обеспечивает длительность полёта до 34 минут, а также управляется с помощью нового контроллера.  Камера поддерживает видеосъёмку 4К с 60 кадров в секунду. Предусмотрена съёмка в формате HDR как для видео, так и для панорамных фотографий. Кол-во мегапикселей: 48 MP',
                'additionals' => [
                    'Доп. аккумулятор',
                ],
                'image' => '3.png',
            ],
        ];
    }

    private function dataCards(): array
    {
        return [
            GoodEnum::SANDISK_64GB->name => [
                'name' => GoodEnum::SANDISK_64GB->value,
                'cost' => 1000,
                'damage_cost' => 20000,
                'description' => '',
                'additionals' => [],
                'image' => '50.png',
            ],
            GoodEnum::SANDISK_128GB_170MB_S->name => [
                'name' => GoodEnum::SANDISK_128GB_170MB_S->value,
                'cost' => 1500,
                'damage_cost' => 30000,
                'description' => '',
                'additionals' => [],
                'image' => '49.png',
            ],
            GoodEnum::MICRO_SANDISK_64_GB->name => [
                'name' => GoodEnum::MICRO_SANDISK_64_GB->value,
                'cost' => 500,
                'damage_cost' => 18000,
                'description' => '',
                'additionals' => [],
                'image' => null,

            ],
            GoodEnum::SONY_256GB_UHS_2->name => [
                'name' => GoodEnum::SONY_256GB_UHS_2->value,
                'cost' => 2500,
                'damage_cost' => 100000,
                'description' => '',
                'additionals' => [],
                'image' => '48.png',
            ],
            GoodEnum::TOUGH_80GB_G_800_MBS->name => [
                'name' => GoodEnum::TOUGH_80GB_G_800_MBS->value,
                'cost' => 2500,
                'damage_cost' => 130000,
                'description' => '',
                'additionals' => [],
                'image' => '47.png',
            ],
            GoodEnum::SAMSUNG_EVO_PLUS_64GB->name => [
                'name' => GoodEnum::SAMSUNG_EVO_PLUS_64GB->value,
                'cost' => 500,
                'damage_cost' => 15000,
                'description' => '',
                'additionals' => [],
                'image' => '51.png',
            ],
            GoodEnum::SAMSUNG_EVO_PLUS_256GB->name => [
                'name' => GoodEnum::SAMSUNG_EVO_PLUS_256GB->value,
                'cost' => 1000,
                'damage_cost' => 25000,
                'description' => '',
                'additionals' => [],
                'image' => null,
            ],
            GoodEnum::MICRO_64GB_ADATA->name => [
                'name' => GoodEnum::MICRO_64GB_ADATA->value,
                'cost' => 500,
                'damage_cost' => 15000,
                'description' => '',
                'additionals' => [],
                'image' => null,
            ],
            GoodEnum::SAMSUNG_T7_1TB->name => [
                'name' => GoodEnum::SAMSUNG_T7_1TB->value,
                'cost' => 3000,
                'damage_cost' => 80000,
                'description' => '',
                'additionals' => [],
                'image' => '94.png',
            ],
        ];
    }

    private function cages(): array
    {
        return [
            GoodEnum::UURIG_HAND_FOR_SONY_A7_3->name => [
                'name' => GoodEnum::UURIG_HAND_FOR_SONY_A7_3->value,
                'cost' => 1500,
                'damage_cost' => 35000,
                'description' => '',
                'additionals' => [],
                'image' => null,
            ],
            GoodEnum::UURIG_FOR_FUJIFILM_T4->name => [
                'name' => GoodEnum::UURIG_FOR_FUJIFILM_T4->value,
                'cost' => 1000,
                'damage_cost' => 25000,
                'description' => '',
                'additionals' => [],
                'image' => '113.png',
            ],
            GoodEnum::SMALLRIG_FOR_A7C->name => [
                'name' => GoodEnum::SMALLRIG_FOR_A7C->value,
                'cost' => 1000,
                'damage_cost' => 25000,
                'description' => '',
                'additionals' => [],
                'image' => '113.png',
            ],
            GoodEnum::SMALLRIG_HAND_AND_HANDLE_A6600->name => [
                'name' => GoodEnum::SMALLRIG_HAND_AND_HANDLE_A6600->value,
                'cost' => 1000,
                'damage_cost' => 25000,
                'description' => '',
                'additionals' => [],
                'image' => null,
            ],
            GoodEnum::TILTA_ADVANCED_FX6->name => [
                'name' => GoodEnum::TILTA_ADVANCED_FX6->value,
                'cost' => 1500,
                'damage_cost' => 30000,
                'description' => '',
                'additionals' => [],
                'image' => null,
            ],
            GoodEnum::TILTA_ADVANCED_KIT_FX3->name => [
                'name' => GoodEnum::TILTA_ADVANCED_KIT_FX3->value,
                'cost' => 5000,
                'damage_cost' => 180000,
                'description' => '',
                'additionals' => [],
                'image' => null,
            ],
        ];
    }

    private function displays(): array
    {
        return [
            GoodEnum::FEELWORLD_LUT_7_4K_HDMI->name => [
                'name' => GoodEnum::FEELWORLD_LUT_7_4K_HDMI->value,
                'cost' => 3000,
                'damage_cost' => 135000,
                'description' => 'Яркий и контрастный экран позволяет эффективно работать в любых условиях освещенности: и в яркий солнечный день, и в затемненном помещении. Диагональ экрана 7" и качество изображения DCI 4K (максимум) позволяют увидеть все детали, попавшие в кадр. 2200 Nit. Возможность загрузки Lut',
                'additionals' => [
                    'Аккумулятор NPF 970',
                ],
                'image' => '57.png',
            ],
            GoodEnum::LILLIPUT_4K->name => [
                'name' => GoodEnum::LILLIPUT_4K->value,
                'cost' => 2500,
                'damage_cost' => 100000,
                'description' => 'Оцените все возможности своей камеры при помощи этого 4K монитора. Full HD с разрешением 1920х1200 пикселей и высокой контрастностью 1000:1 передают невероятно красочную и качественную картинку.',
                'additionals' => [
                    'Аккумулятор NPF 970',
                ],
                'image' => '58.png',
            ],
            GoodEnum::FEELWORLD_4K_ULTRA->name => [
                'name' => GoodEnum::FEELWORLD_4K_ULTRA->value,
                'cost' => 4000,
                'damage_cost' => 200000,
                'description' => 'Большой монитор с разрешением 4k c возможностью загрузки LUT. Отлично подойдет как Playback',
                'additionals' => [
                    'Аккумулятор NPF 970',
                ],
                'image' => null,
            ],
        ];
    }

    private function miscellaneous(): array
    {
        return [
            GoodEnum::VIDEOSENDERS_HOLLYLAND_MARS_400S_PRO->name => [
                'name' => GoodEnum::VIDEOSENDERS_HOLLYLAND_MARS_400S_PRO->value,
                'cost' => 7000,
                'damage_cost' => 250000,
                'description' => 'беспроводная передача AV-сигнала на расстояние до 120 метров с задержкой всего 0,08 с
Входы SDI и HDMI
Несколько режимов мониторинга',
                'additionals' => [],
                'image' => '93.png',
            ],
            GoodEnum::TELEPROMPTER_FEELWORLD_TP10->name => [
                'name' => GoodEnum::TELEPROMPTER_FEELWORLD_TP10->value,
                'cost' => 4000,
                'damage_cost' => 60000,
                'description' => 'FEELWORLD TP10 - это складной портативный телесуфлер, оснащенный 10-дюймовым стандартным светоделителем, который позволяет четко читать прокручиваемый текст, глядя прямо в камеру, что идеально подходит для видеоблога и прямой трансляции , онлайн-уроки, видеозапись, интервью, видеостудия, новости и презентации.',
                'additionals' => [],
                'image' => '92.png',
            ],
            GoodEnum::REFLECTOR->name => [
                'name' => GoodEnum::REFLECTOR->value,
                'cost' => 1500,
                'damage_cost' => 30000,
                'description' => 'Отражатель Selens 60х90 см 5 в 1 состоит из пяти отражающих поверхностей: белой, серебряной, золотой, черной, полупрозрачной. Оснащен тремя удобными ручками, что упрощает работу с отражателем.',
                'additionals' => [],
                'image' => '45.png',
            ],
            GoodEnum::CHROMAKEY_200X150->name => [
                'name' => GoodEnum::CHROMAKEY_200X150->value,
                'cost' => 1500,
                'damage_cost' => 30000,
                'description' => '',
                'additionals' => [],
                'image' => '46.png',
            ],
            GoodEnum::SYNCHRONIZER_GODOX_X_PRO->name => [
                'name' => GoodEnum::SYNCHRONIZER_GODOX_X_PRO->value,
                'cost' => 1500,
                'damage_cost' => 35000,
                'description' => 'синхронизатор Godox Xpro-C TTL с функцией Дистанционного управления вспышками',
                'additionals' => [],
                'image' => '55.png',
            ],
            GoodEnum::MONOPOD->name => [
                'name' => GoodEnum::MONOPOD->value,
                'cost' => 500,
                'damage_cost' => 15000,
                'description' => '',
                'additionals' => [],
                'image' => null,
            ],
            GoodEnum::COMPENDIUM_SMALLRIG->name => [
                'name' => GoodEnum::COMPENDIUM_SMALLRIG->value,
                'cost' => 1000,
                'damage_cost' => 40000,
                'description' => '',
                'additionals' => [],
                'image' => null,
            ],
            GoodEnum::SMOKE_MACHINE_900W->name => [
                'name' => GoodEnum::SMOKE_MACHINE_900W->value,
                'cost' => 4000,
                'damage_cost' => 40000,
                'description' => '',
                'additionals' => [],
                'image' => '95.png',
            ],
        ];
    }

    private function softboxes(): array
    {
        return [
            GoodEnum::SOFTBOX_LATERN_90->name => [
                'name' => GoodEnum::SOFTBOX_LATERN_90->value,
                'cost' => 3000,
                'damage_cost' => 70000,
                'description' => '',
                'additionals' => [],
                'image' => '109.png',
            ],
            GoodEnum::SOFTBOX_OCTADOME_120->name => [
                'name' => GoodEnum::SOFTBOX_OCTADOME_120->value,
                'cost' => 3000,
                'damage_cost' => 70000,
                'description' => '',
                'additionals' => [],
                'image' => '108.png',
            ],
            GoodEnum::SOFTBOX_LIGHT_DOME_150->name => [
                'name' => GoodEnum::SOFTBOX_LIGHT_DOME_150->value,
                'cost' => 3000,
                'damage_cost' => 75000,
                'description' => '',
                'additionals' => [],
                'image' => '107.png',
            ],
            GoodEnum::SOFTBOX_GODOX_60_60->name => [
                'name' => GoodEnum::SOFTBOX_GODOX_60_60->value,
                'cost' => 5000,
                'damage_cost' => 150000,
                'description' => '',
                'additionals' => [],
                'image' => null,
            ],
            GoodEnum::FLASH_SOFTBOX->name => [
                'name' => GoodEnum::FLASH_SOFTBOX->value,
                'cost' => 1000,
                'damage_cost' => 15000,
                'description' => '',
                'additionals' => [],
                'image' => null,
            ],
        ];
    }

    private function filters(): array
    {
        return [
            GoodEnum::ND_FREEWELL_67MM->name => [
                'name' => GoodEnum::ND_FREEWELL_67MM->value,
                'cost' => 2000,
                'damage_cost' => 100000,
                'description' => '',
                'additionals' => [],
                'image' => '123.png',
            ],
            GoodEnum::ND_77MM->name => [
                'name' => GoodEnum::ND_77MM->value,
                'cost' => 1000,
                'damage_cost' => 32000,
                'description' => '',
                'additionals' => [],
                'image' => '121.png',
            ],
            GoodEnum::ND_58MM->name => [
                'name' => GoodEnum::ND_58MM->value,
                'cost' => 1000,
                'damage_cost' => 32000,
                'description' => '',
                'additionals' => [],
                'image' => '122.png',
            ],
            GoodEnum::ND_72MM->name => [
                'name' => GoodEnum::ND_72MM->value,
                'cost' => 1000,
                'damage_cost' => 32000,
                'description' => '',
                'additionals' => [],
                'image' => '120.png',
            ],
            GoodEnum::TIFFEN_MIST_FILTER_67MM->name => [
                'name' => GoodEnum::TIFFEN_MIST_FILTER_67MM->value,
                'cost' => 2000,
                'damage_cost' => 50000,
                'description' => '',
                'additionals' => [],
                'image' => null,
            ],
            GoodEnum::POLARIZED_77MM->name => [
                'name' => GoodEnum::POLARIZED_77MM->value,
                'cost' => 1000,
                'damage_cost' => 32000,
                'description' => '',
                'additionals' => [],
                'image' => null,
            ],
        ];
    }

    private function stands(): array
    {
        return [
            GoodEnum::LIGHT_STAND_GODOX_213B->name => [
                'name' => GoodEnum::LIGHT_STAND_GODOX_213B->value,
                'cost' => 1000,
                'damage_cost' => 25000,
                'description' => 'Максимальная высота 213 см
Нагрузка 2кг',
                'additionals' => [],
                'image' => '62.png',
            ],
            GoodEnum::LIGHT_STAND_GODOX_380->name => [
                'name' => GoodEnum::LIGHT_STAND_GODOX_380->value,
                'cost' => 2000,
                'damage_cost' => 35000,
                'description' => 'Максимальная высота 380 см
Нагрузка 5кг',
                'additionals' => [],
                'image' => null,
            ],
            GoodEnum::LIGHT_STAND_GODOX_SL->name => [
                'name' => GoodEnum::LIGHT_STAND_GODOX_SL->value,
                'cost' => 1000,
                'damage_cost' => 25000,
                'description' => 'Максимальная высота 200 см
Нагрузка 2.5кг',
                'additionals' => [],
                'image' => null,
            ],
            GoodEnum::NO_NAME_LIGHT_STANDS->name => [
                'name' => GoodEnum::NO_NAME_LIGHT_STANDS->value,
                'cost' => 1000,
                'damage_cost' => 25000,
                'description' => 'Максимальная высота 300 см
Нагрузка 2.5кг',
                'additionals' => [],
                'image' => null,
            ],
            GoodEnum::LARGE_NO_NAME_LIGHT_STAND->name => [
                'name' => GoodEnum::LARGE_NO_NAME_LIGHT_STAND->value,
                'cost' => 1500,
                'damage_cost' => 30000,
                'description' => 'Максимальная высота 380см
Нагрузка 4кг',
                'additionals' => [],
                'image' => null,
            ],
            GoodEnum::C_STAND_K2_MEKING->name => [
                'name' => GoodEnum::C_STAND_K2_MEKING->value,
                'cost' => 2500,
                'damage_cost' => 75000,
                'description' => 'Сделаны из хромированной стали, Прочное покрытие делает стойки устойчивыми для любых погодных условий.
Минимальная высота: 1450мм/57
Максимальная высота: 3280мм/129
Длина в сложенном состоянии: 1450мм/57
Вес: 7.50kg/16.5lbs
Количество секций: 3
Диаметр секций: 25.30.35. 16
Диметр ног: 30
Максимальная нагрузка: 10kg/22lbs
Размах ног: 1080мм/43
Длина руки: 1200мм/47
Высота в Г-образном положении: 2200мм/87',
                'additionals' => [],
                'image' => '66.png',
            ],
            GoodEnum::TRIPOD_COMAN->name => [
                'name' => GoodEnum::TRIPOD_COMAN->value,
                'cost' => 2500,
                'damage_cost' => 60000,
                'description' => 'Профессиональный алюминиевый видео штатив от Coman
Минимальная высота - 56 см
Максимальная выоста - 180 см
Максимальная нагрузка 10 кг',
                'additionals' => [],
                'image' => '64.png',
            ],
            GoodEnum::ALUMINUM_TRIPOD->name => [
                'name' => GoodEnum::ALUMINUM_TRIPOD->value,
                'cost' => 1500,
                'damage_cost' => 35000,
                'description' => 'Фото штатив с возможностью вертикальной сьемки
Максимальная высота штатива 165см
Нагрузка 5кг',
                'additionals' => [],
                'image' => '65.png',
            ],
            GoodEnum::WEIFENG_TRIPOD->name => [
                'name' => GoodEnum::WEIFENG_TRIPOD->value,
                'cost' => 1000,
                'damage_cost' => 25000,
                'description' => 'Максимальная высота съемки, см  170
Максимальная нагрузка, кг 5
Чехол в комплекте',
                'additionals' => [],
                'image' => null,
            ],
            GoodEnum::CONTINENTAL_TRIPOD_DAMAGED->name => [
                'name' => GoodEnum::CONTINENTAL_TRIPOD_DAMAGED->value,
                'cost' => 500,
                'damage_cost' => 15000,
                'description' => 'Максимальная высота съемки, см  165
Максимальная нагрузка, кг  4.5',
                'additionals' => [],
                'image' => '63.png',
            ],
        ];
    }

    private function kits(): array
    {
        return [
            GoodEnum::SONY_FX6_V_MOUNT_SET->name => [
                'name' => GoodEnum::SONY_FX6_V_MOUNT_SET->value,
                'cost' => 49990,
                'damage_cost' => 3410000,
                'description' => '-Sony FX6
-Tilta V-mount kit
-Sony bp battery
-SWIT 220wh V mount / BP 99WH
-CFexpress Tough 160gb',
                'additionals' => [
                    'Доп Smallrig 99WH V mount',
                    'Доп Swit 220 WH V mount',
                    'Доп CF express Tough 160 gb',
                ],
                'image' => '6.png',

            ],
            GoodEnum::BLACKMAGIC_6K_PRO_FULL_SET->name => [
                'name' => GoodEnum::BLACKMAGIC_6K_PRO_FULL_SET->value,
                'cost' => 25000,
                'damage_cost' => 2130000,
                'description' => 'Полный сетап для Black magic 6k pro
в набор входит:
Blackmagic 6k pro
Объектив Sigma 18-35mm/samyang объектив
Small Rig Vmount 99wh + родной аккумулятор
Клетка Tilta advanced kit с рукояткой
Плата V mount/Tilta NPF
Терабайт памяти Samsung T7',
                'additionals' => [
                    'Доп Терабайт памяти samsung T7',
                    'Доп V mount 99wh аккумулятор',
                ],
                'image' => '119.png',

            ],
            GoodEnum::APUTURE_300X_LED_LIGHTS_SET->name => [
                'name' => GoodEnum::APUTURE_300X_LED_LIGHTS_SET->value,
                'cost' => 23000,
                'damage_cost' => 1100000,
                'description' => 'Два мощных источника света с мощностью 300 ват
2 софтбокса Lantern 90
2 Стойки Godox 380F',
                'additionals' => [],
                'image' => '72.png',
            ],
            GoodEnum::GODOX_SL200IIID_LED_LIGHTS_SET->name => [
                'name' => GoodEnum::GODOX_SL200IIID_LED_LIGHTS_SET->value,
                'cost' => 15000,
                'damage_cost' => 350000,
                'description' => 'Два мощных источника дневного света мощностью 200 ват. Отлично подойдет для сьемок средних масштабов

в комплекте два софтбокса, 2 стойки и два источника света с переносной сумкой.',
                'additionals' => [],
                'image' => '71.png',
            ],
            GoodEnum::GODOX_SL100BI_LED_LIGHTS_SET->name => [
                'name' => GoodEnum::GODOX_SL100BI_LED_LIGHTS_SET->value,
                'cost' => 9000,
                'damage_cost' => 200000,
                'description' => 'Два средне мощных источника света мощностью 100 ват и регулировкой температуры.

в комплекте два софтбокса, 2 стойки и два источника света с переносной сумкой.',
                'additionals' => [],
                'image' => '70.png',
            ],
            GoodEnum::NANLITE_FORZA_60C_LED_LIGHTS_SET->name => [
                'name' => GoodEnum::NANLITE_FORZA_60C_LED_LIGHTS_SET->value,
                'cost' => 20000,
                'damage_cost' => 900000,
                'description' => 'Комплект из Nanlite forza 60c идеально подойдет для сьемок кино и коммерции и предметной сьемки

В комплекте 3 источника света Forza 60c, 3 софтбокса и 3 стойки',
                'additionals' => [],
                'image' => '103.png',

            ],
            GoodEnum::APUTURE_AMARAN_P60C_LED_LIGHTS_SET->name => [
                'name' => GoodEnum::APUTURE_AMARAN_P60C_LED_LIGHTS_SET->value,
                'cost' => 15000,
                'damage_cost' => 450000,
                'description' => 'Комплект из  трех панелей Amaran p60c

В комплекте 3 панели, 3 софтбокса и 3 стойки',
                'additionals' => [],
                'image' => '40.png',
            ],
            GoodEnum::GODOX_TL60_JEDI_LIGHTS_SET->name => [
                'name' => GoodEnum::GODOX_TL60_JEDI_LIGHTS_SET->value,
                'cost' => 7000,
                'damage_cost' => 200000,
                'description' => 'Комплект из двукх Джедаек Godox TL60',
                'additionals' => [],
                'image' => '82.png',
            ],
            GoodEnum::NANLITE_30CM_JEDI_LIGHTS_SET->name => [
                'name' => GoodEnum::NANLITE_30CM_JEDI_LIGHTS_SET->value,
                'cost' => 5000,
                'damage_cost' => 100000,
                'description' => 'Комплект из двух маленьких Nanlite джедаек',
                'additionals' => [],
                'image' => '44.png',
            ],
        ];
    }
}
