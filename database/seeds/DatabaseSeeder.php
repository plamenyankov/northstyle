<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		Model::unguard();

		$this->call(UserTableSeeder::class);
		$this->call(PageTableSeeder::class);
		$this->call(PostTableSeeder::class);
		$this->call(ArticlesTableSeeder::class);
		$this->call(CategoryTableSeeder::class);
		$this->call(AttributeRepresentationTableSeeder::class);

		Model::reguard();
    }
}
