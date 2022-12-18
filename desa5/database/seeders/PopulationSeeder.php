<?php

namespace Database\Seeders;

// use App\Models\Population;
// use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PopulationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        for($i=1; $i <= 500; $i++){
            DB::table('populations')->insert([
                'name' => $faker->name,
                'nik' => $faker->unique()->numerify('################'),
                'kk_id' => $faker->numberBetween(1, 150),
                'dusun_id'=>$faker->numberBetween(1, 10),
                'sex_id'=>$faker->randomElement([1, 2]),
                'tanggal_lahir'=>$faker->date,
                'citizen_id'=>$faker->randomElement([1, 2, 3]),
                'blood_type_id'=>$faker->randomElement([1, 2, 3, 4]),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
