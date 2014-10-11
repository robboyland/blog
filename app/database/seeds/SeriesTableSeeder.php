<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class SeriesTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

        $user_ids = DB::table('users')->lists('id');

		foreach(range(1, 20) as $index)
		{
            $title = implode(' ', $faker->words(6));

			Series::create([
                'title' => $title,
                'user_id' => $faker->randomElement($user_ids)
			]);
		}
	}

}