<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class PostsTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

        Post::truncate();

        $user_ids = DB::table('users')->lists('id');
        $cat_ids  = DB::table('categories')->lists('id');

        foreach(range(1, 20) as $index)
        {
            Post::create([
                'title' => $faker->sentence(6),
                'body'  => $faker->text(1200),
                'user_id' => $faker->randomElement($user_ids),
                'category_id' => $faker->randomElement($cat_ids)
            ]);
        }
    }

}