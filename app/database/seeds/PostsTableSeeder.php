<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class PostsTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
			Post::create([
                'title' => $faker->sentence($nbWords = 6),
                'body'  => $faker->text($maxNbChars = 1200),
                'user_id' => 1
			]);
		}
	}

}