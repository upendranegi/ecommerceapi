<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\user;

class userseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        for($i=0;$i<5; $i++){

        
        user::create([
  'name'=>fake()->name(),
  'email'=>fake()->email(),
  'age'=>21+$i,
  'city'=>fake()->city()
        ]);
    }
    }
}
