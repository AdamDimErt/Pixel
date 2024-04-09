<?php

namespace Database\Seeders;

use App\Models\Additional;
use Illuminate\Database\Seeder;

class AdditionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Additional::query()->delete();
        foreach ($this->additionals() as $additionalData) {
            Additional::factory()->create(
                [...$additionalData]
            );
        }
    }

    public function additionals(): array
    {
        return [
            [
                'name_ru' => 'SmallRig 99wh v mount',
                'name_en' => 'SmallRig 99wh v mount',
                 'cost' => 2000
            ],
            [
                'name_ru' => 'SWIT BP 220WH',
                'name_en' => 'SWIT BP 220WH',
                 'cost' => 3000
            ],
            [
                'name_ru' => 'Tilta V mount',
                'name_en' => 'Tilta V mount',
                 'cost' => 3000
            ],
            [
                'name_ru' => 'CF Tough 160gb',
                'name_en' => 'CF Tough 160gb',
                 'cost' => 3000
            ],
            [
                'name_ru' => 'SSD Samsung T7 1Tb',
                'name_en' => 'SSD Samsung T7 1Tb',
                 'cost' => 2000
            ],
            [
                'name_ru' => 'Объектив Sigma 18-35mm f1.8',
                'name_en' => 'Lens Sigma 18-35mm f1.8',
                 'cost' => 6000
            ],
            [
                'name_ru' => 'Объектив Samyang VDSLR',
                'name_en' => 'Lens Samyang VDSLR',
                 'cost' => 3500
            ],
            [
                'name_ru' => 'Tilta + v mount',
                'name_en' => 'Tilta + v mount',
                 'cost' => 3000
            ],
            [
                'name_ru' => 'SmallRig 99wh',
                'name_en' => 'SmallRig 99wh',
                 'cost' => 2000
            ],
            [
                'name_ru' => 'CF Tough 80gb',
                'name_en' => 'CF Tough 80gb',
                 'cost' => 3000
            ],
            [
                'name_ru' => 'Карта памяти 256gb sony 277mbs',
                'name_en' => 'Data card 256gb sony 277mbs',
                 'cost' => 2500
            ],
            [
                'name_ru' => 'Tilta advanced cage',
                'name_en' => 'Tilta advanced cage',
                 'cost' => 2500
            ],
            [
                'name_ru' => 'Доп аккумулятор NPF Z100',
                'name_en' => 'Additional battery NPF Z100',
                 'cost' => 500
            ],
            [
                'name_ru' => 'Переходник RF-EF',
                'name_en' => 'Transfer cord RF-EF',
                 'cost' => 500
            ],
            [
                'name_ru' => 'Объектив Canon RF 24-105mm f4-7.1',
                'name_en' => 'Lens Canon RF 24-105mm f4-7.1',
                 'cost' => 2000
            ],
            [
                'name_ru' => 'Клетка A7 III с рукояткой UURig',
                'name_en' => 'Cage A7 III with handle UURig',
                 'cost' => 1500
            ],
            [
                'name_ru' => 'Дополнительный аккумулятор',
                'name_en' => 'Additional battery',
                 'cost' => 500
            ],
            [
                'name_ru' => 'Карта памяти Sandisk 64gb 200mbs',
                'name_en' => 'Data card Sandisk 64gb 200mbs',
                 'cost' => 1000
            ],
            [
                'name_ru' => 'Kit объектив 28-70mm oss f3.5-5.6',
                'name_en' => 'Kit lens 28-70mm oss f3.5-5.6',
                 'cost' => 1000
            ],
            [
                'name_ru' => 'Клетка A7c',
                'name_en' => 'Cage A7c',
                 'cost' => 1000
            ],
            [
                'name_ru' => 'Клетка Sony a7 IV',
                'name_en' => 'Cage Sony a7 IV',
                 'cost' => 1000
            ],
            [
                'name_ru' => 'Kit объектив 18-135mm f3.5-5.6',
                'name_en' => 'Kit lens 18-135mm f3.5-5.6',
                 'cost' => 1500
            ],
            [
                'name_ru' => 'Клетка a6600',
                'name_en' => 'Cage a6600',
                 'cost' => 1000
            ],
            [
                'name_ru' => 'Клетка a6400',
                'name_en' => 'Cage a6400',
                 'cost' => 1000
            ],
            [
                'name_ru' => 'Kit Fujifilm 18-55mm f2.8-4',
                'name_en' => 'Kit Fujifilm 18-55mm f2.8-4',
                 'cost' => 1500
            ],
            [
                'name_ru' => 'Клетка Fujifilm T4',
                'name_en' => 'Cage Fujifilm T4',
                 'cost' => 1000
            ],
            [
                'name_ru' => 'Клетка Fujifilm T3',
                'name_en' => 'Cage Fujifilm T3',
                 'cost' => 1000
            ],
            [
                'name_ru' => 'Карта памяти micro Sandisk 64gb 200mbs',
                'name_en' => 'Data card micro Sandisk 64gb 200mbs',
                 'cost' => 1000
            ],
            [
                'name_ru' => 'Крепление на голову',
                'name_en' => 'Head mount',
                 'cost' => 1000
            ],
            [
                'name_ru' => 'Крепление на грудь',
                'name_en' => 'Chest mount',
                 'cost' => 1000
            ],
            [
                'name_ru' => 'Крепление на машину',
                'name_en' => 'Car mount',
                 'cost' => 1000
            ],
            [
                'name_ru' => 'Аквабокс',
                'name_en' => 'Aquabox',
                 'cost' => 1500
            ],
            [
                'name_ru' => 'Селфи палка',
                'name_en' => 'Selfie-stick',
                 'cost' => 500
            ],
            [
                'name_ru' => 'ND Filter 77mm',
                'name_en' => 'ND Filter 77mm',
                 'cost' => 1000
            ],
            [
                'name_ru' => 'Tiffent mist Filter 67mm',
                'name_en' => 'Tiffent mist Filter 67mm',
                 'cost' => 2000
            ],
            [
                'name_ru' => 'Cтойка Godox 380',
                'name_en' => 'Stand Godox 380',
                 'cost' => 1000
            ],
            [
                'name_ru' => 'Софтбокс Lantern 90',
                'name_en' => 'Softbox Lantern 90',
                 'cost' => 1500
            ],
            [
                'name_ru' => 'Софтбокс Octadome 120',
                'name_en' => 'Softbox Octadome 120',
                 'cost' => 1500
            ],
            [
                'name_ru' => 'С-Stand',
                'name_en' => 'С-Stand',
                 'cost' => 2500
            ],
            [
                'name_ru' => 'Софтбокс dome 150',
                'name_en' => 'Softbox dome 150',
                 'cost' => 2500
            ],
            [
                'name_ru' => 'Софтбокс Lantern',
                'name_en' => 'Softbox Lantern',
                 'cost' => 2000
            ],
            [
                'name_ru' => 'Стойка',
                'name_en' => 'Stand',
                 'cost' => 1000
            ],
            [
                'name_ru' => 'Софтбокс godox 60x60',
                'name_en' => 'Softbox godox 60x60',
                 'cost' => 1000
            ],
            [
                'name_ru' => 'Cофтбокс',
                'name_en' => 'Softbox',
                 'cost' => 1000
            ],
            [
                'name_ru' => 'Синхронизатор Godox X PRO',
                'name_en' => 'Synchronizer Godox X PRO',
                 'cost' => 1000
            ],
            [
                'name_ru' => 'Монопод',
                'name_en' => 'Monopode',
                 'cost' => 500
            ],
            [
                'name_ru' => 'Стойка godox',
                'name_en' => 'Stand godox',
                 'cost' => 1000
            ],
            [
                'name_ru' => '2 аккумулятора NPF 970 для беспроводной зарядки',
                'name_en' => '2 batteries NPF 970 for wireless charging',
                 'cost' => 3000
            ],
            [
                'name_ru' => 'Переходник на телефон',
                'name_en' => 'Mobile transfer cord',
                 'cost' => 0
            ],
            [
                'name_ru' => 'Raven eye',
                'name_en' => 'Raven eye',
                 'cost' => 2000
            ],
            [
                'name_ru' => 'Ручка',
                'name_en' => 'Handle',
                 'cost' => 1000
            ],
            [
                'name_ru' => 'Follow focus',
                'name_en' => 'Follow focus',
                 'cost' => 1000
            ],
            [
                'name_ru' => 'Доп. аккумулятор',
                'name_en' => 'Additional battery',
                 'cost' => 1000
            ],
            [
                'name_ru' => 'Аккумулятор NPF 970',
                'name_en' => 'Battery NPF 970',
                 'cost' => 1500
            ],
            [
                'name_ru' => 'Доп Smallrig 99WH V mount',
                'name_en' => 'Additional Smallrig 99WH V mount',
                 'cost' => 2000
            ],
            [
                'name_ru' => 'Доп Swit 220 WH V mount',
                'name_en' => 'Additional Swit 220 WH V mount',
                 'cost' => 3000
            ],
            [
                'name_ru' => 'Доп CF express Tough 160 gb',
                'name_en' => 'Additional CF express Tough 160 gb',
                 'cost' => 5000
            ],
            [
                'name_ru' => 'Доп Терабайт памяти samsung T7',
                'name_en' => 'Additional TB of memory T7',
                 'cost' => 3000
            ],
            [
                'name_ru' => 'Доп V mount 99wh аккумулятор',
                'name_en' => 'Additional V mount 99wh battery',
                 'cost' => 3000
            ],
        ];
    }
}
