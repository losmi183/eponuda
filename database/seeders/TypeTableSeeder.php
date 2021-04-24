<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Seeder;

class TypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Type::create([
            'id' => 1,
            'name' => 'Bela tehnika',
            'slug' => 'bela-tehnika',
        ]);
        Type::create([
            'id' => 2,
            'name' => 'Tv Audio Video',
            'slug' => 'tv-audio-video',
        ]);
    }
}
