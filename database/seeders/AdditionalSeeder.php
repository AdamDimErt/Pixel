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
        foreach ($this->additionals() as $additionalName => $additionalCost) {
            Additional::factory()->create([
                'name' => $additionalName,
                'cost' => $additionalCost,
            ]);
        }
    }

    public function additionals(): array
    {
        return [
            'SmallRig 99wh v mount' => 2000,
            'SWIT BP 220WH' => 3000,
            'Tilta V mount' => 3000,
            'CF Tough 160gb' => 3000,
            'SSD Samsung T7 1Tb' => 2000,
            'Объектив Sigma 18-35mm f1.8' => 6000,
            'Объектив Samyang VDSLR' => 3500,
            'Tilta + v mount' => 3000,
            'SmallRig 99wh' => 2000,
            'CF Tough 80gb' => 3000,
            'Карта памяти 256gb sony 277mbs' => 2500,
            'Tilta advanced cage' => 2500,
            'Доп аккумулятор NPF Z100' => 500,
            'Переходник RF-EF' => 500,
            'Объектив Canon RF 24-105mm f4-7.1' => 2000,
            'Клетка A7 III с рукояткой UURig' => 1500,
            'Дополнительный аккумулятор' => 500,
            'Карта памяти Sandisk 64gb 200mbs' => 1000,
            'Kit объектив 28-70mm oss f3.5-5.6' => 1000,
            'Клетка A7c' => 1000,
            'Клетка Sony a7 IV' => 1000,
            'Kit объектив 18-135mm f3.5-5.6' => 1500,
            'Клетка a6600' => 1000,
            'Клетка a6400' => 1000,
            'Kit Fujifilm 18-55mm f2.8-4' => 1500,
            'Клетка Fujifilm T4' => 1000,
            'Клетка Fujifilm T3' => 1000,
            'Карта памяти micro Sandisk 64gb 200mbs' => 1000,
            'Крепление на голову' => 1000,
            'Крепление на грудь' => 1000,
            'Крепление на машину' => 1000,
            'Аквабокс' => 1500,
            'Селфи палка' => 500,
            "ND Filter 77mm" => 1000,
            "Tiffent mist Filter 67mm" => 2000,
            'Cтойка Godox 380' => 1000,
            'Софтбокс Lantern 90' => 1500,
            'Софтбокс Octadome 120' => 1500,
            'С-Stand' => 2500,
            'Софтбокс dome 150' => 2500,
            'Софтбокс Lantern' => 2000,
            'Стойка' => 1000,
            'Софтбокс godox 60x60' => 1000,
            'Cофтбокс' => 1000,
            'Синхронизатор Godox X PRO' => 1000,
            'Монопод' => 500,
            'Стойка godox' => 1000,
            '2 аккумулятора NPF 970 для беспроводной зарядки' => 3000,
            'Переходник на телефон' => 0,
            'Raven eye' => 2000,
            'Ручка' => 1000,
            'Follow focus' => 1000,
            'Доп. аккумулятор' => 1000,
            'Аккумулятор NPF 970' => 1500,
            'Доп Smallrig 99WH V mount' => 2000,
            'Доп Swit 220 WH V mount' => 3000,
            'Доп CF express Tough 160 gb' => 5000,
            'Доп Терабайт памяти samsung T7' => 3000,
            'Доп V mount 99wh аккумулятор' => 3000,
        ];
    }
}
