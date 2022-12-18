<?php

namespace Database\Seeders;
use App\Models\BloodType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BloodTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected $types = [
        [
            'id' => 1,
            'name' => 'A'
        ],
        [
            'id' => 2,
            'name' => 'B'
        ],
        [
            'id' => 3,
            'name' => 'AB'
        ],
        [
            'id' => 4,
            'name' => 'O'
        ]
    ];

    public function run()
    {
        foreach($this->types as $type){
            BloodType::create($type);
        }
    }
}
