<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $faker = Faker::create('id_ID');
        $faker->seed(123);

        for ($i = 0; $i < 4; $i++) {
            Author::create([
                "nama" => $faker->firstName . " " . $faker->lastName,
                "kota" => $faker->city,
                "negara" => $faker->country
            ]);
        }

        for ($i = 0; $i < 10; $i++) {
            Book::create(
                [
                    'judul' => $faker->sentence,
                    'halaman' => $faker->randomNumber(3),
                    'kategori' => $faker->sentence,
                    'penerbit' => $faker->sentence,
                    'author_id' => $faker->numberBetween(1, 4)
                ]
            );
        }
    }

}
