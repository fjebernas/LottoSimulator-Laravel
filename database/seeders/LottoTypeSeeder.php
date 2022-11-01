<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\LottoType;

class LottoTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lotto_types')->insert([
            [
                'name' => 'Lotto 6/42',
                'combination_count' => 6,
                'digits_range' => json_encode(array('min' => 1, 'max' => 42)),
                'color_theme' => '#198754'
            ],
            [
                'name' => 'Swertres 3/10',
                'combination_count' => 3,
                'digits_range' => json_encode(array('min' => 0, 'max' => 9)),
                'color_theme' => '#fd7e14'
            ],
            [
                'name' => 'Mega Lotto 6/45',
                'combination_count' => 6,
                'digits_range' => json_encode(array('min' => 1, 'max' => 45)),
                'color_theme' => '#dc3545'
            ],
            [
                'name' => 'Ultra Lotto 6/58',
                'combination_count' => 6,
                'digits_range' => json_encode(array('min' => 1, 'max' => 58)),
                'color_theme' => '#6f42c1'
            ],
        ]);
    }
}
