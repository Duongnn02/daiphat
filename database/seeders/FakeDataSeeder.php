<?php

namespace Database\Seeders;

use App\Models\FakeData;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class FakeDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [3, 8, 9];
        $fakeData = new FakeData();
        for ($i = 0; $i < 500; $i++) {
            $item = [
                'phone' => 0 . Arr::random($data) . rand(0, 9) . '***' . rand(0, 9) . rand(0, 9) . rand(0, 9),
                'money' => rand(1, 9) . rand(0, 9) . '.000' . '.0000' . '₫',
            ];

            $fakeData->insert($item);
        }
    }
}
