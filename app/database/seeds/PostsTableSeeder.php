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

        // function dashes($string) {
        //     //Lower case everything
        //     $string = strtolower($string);
        //     //Make alphanumeric (removes all other characters)
        //     $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
        //     //Clean up multiple dashes or whitespaces
        //     $string = preg_replace("/[\s-]+/", " ", $string);
        //     //Convert whitespaces and underscore to dash
        //     $string = preg_replace("/[\s_]/", "-", $string);
        //     return $string;
        // }

        foreach(range(1, 20) as $index)
        {
            $title = implode(' ', $faker->words(6));
            $slug  = str_replace(' ', '-', $title);

            Post::create([
                'title' => $title,
                'slug'  => $slug,
                'body'  => $faker->text(1200),
                'user_id' => $faker->randomElement($user_ids),
                'category_id' => $faker->randomElement($cat_ids)
            ]);
        }
    }

}