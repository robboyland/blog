<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class PostTagTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

        $post_ids = Post::lists('id');
        $tag_ids  = Tag::lists('id');

        DB::table('post_tag')->truncate();

        foreach(range(1, 10) as $index)
        {
            Db::table('post_tag')->insert([
                'post_id' => $faker->randomElement($post_ids),
                'tag_id'  => $faker->randomElement($tag_ids)
            ]);
        }
    }

}