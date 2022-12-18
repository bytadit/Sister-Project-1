<?php

namespace Database\Seeders;
use App\Models\Sex;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SexSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected $sexes = [
        [
            'id' => 1,
            'name' => 'Pria'
        ],
        [
            'id' => 2,
            'name' => 'Wanita'
        ]
    ];

    public function run()
    {
        foreach($this->sexes as $sex){
            Sex::create($sex);
        }
    }
}
