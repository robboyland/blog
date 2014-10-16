<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
        DB::statement("SET foreign_key_checks = 0");

		Eloquent::unguard();

        $this->call('UsersTableSeeder');
        $this->call('CategoriesTableSeeder');
        $this->call('SeriesTableSeeder');
        $this->call('TagsTableSeeder');
        $this->call('PostsTableSeeder');
        $this->call('PostTagTableSeeder');
        $this->call('CommentsTableSeeder');

	}

}
