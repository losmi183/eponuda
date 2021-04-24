<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Frizideri',
            'slug' => 'frizideri',
            'type_slug' => 'bela-tehnika'
        ]);
        Category::create([
            'name' => 'Veš masine',
            'slug' => 'ves-masine',
            'type_slug' => 'bela-tehnika'
        ]);
        Category::create([
            'name' => 'Šporeti ploce i rerne',
            'slug' => 'sporeti-ploce-i-rerne',
            'type_slug' => 'bela-tehnika'
        ]);

        Category::create([
            'name' => 'Televizori',
            'slug' => 'televizori',
            'type_slug' => 'tv-audio-video'
        ]);
        Category::create([
            'name' => 'Dodatna oprema za tv',
            'slug' => 'dodatna-oprema-za-tv',
            'type_slug' => 'tv-audio-video'
        ]);
        Category::create([
            'name' => 'Av oprema',
            'slug' => 'av-oprema',
            'type_slug' => 'tv-audio-video'
        ]);
    }
}
