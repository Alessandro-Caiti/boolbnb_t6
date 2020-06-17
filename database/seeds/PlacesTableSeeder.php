<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Place;
use App\User;
use App\Amenity;

class PlacesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
      for ($i = 0; $i <= 23; $i++) {
          $user =  User::inRandomOrder()->first();
          $place = new Place;
          $place->user_id = $user->id;
          $place->summary = $faker->sentence(2, true);
          $place->slug = Str::slug($place->summary , '-') . rand(1, 1000);
          $place->price = rand(10, 100);
          $place->address = $faker->streetAddress();
          $place->lat = $faker->latitude(-90, 90);
          $place->long = $faker->longitude(-180, 180);
          $place->city = $faker->city();
          $place->save();
          $amenities = Amenity::inRandomOrder()->limit(2)->get();
          $place->amenities()->attach($amenities);
        }
    }
}
