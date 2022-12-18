<?php

namespace Database\Seeders;
use App\Models\Citizen;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitizenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected $citizens = [
        [
            'id' => 1,
            'name' => 'WNI'
        ],
        [
            'id' => 2,
            'name' => 'WNA'
        ],
        [
            'id' => 3,
            'name' => 'Bipatride'
        ]
    ];

    public function run()
    {
        foreach($this->citizens as $citizen){
            Citizen::create($citizen);
        }
    }
}
