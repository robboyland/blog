<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class CommentsTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

        Comment::truncate();

        $post_ids = DB::table('posts')->lists('id');
        $user_ids = DB::table('users')->lists('id');

		foreach(range(1, 40) as $index)
		{
			Comment::create([
                'user_id' => $faker->randomElement($user_ids),
                'post_id' => $faker->randomElement($post_ids),
                'body'    => $faker->paragraph(1)
			]);
		}
	}

}