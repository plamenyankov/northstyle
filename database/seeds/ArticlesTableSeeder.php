<?php

use Illuminate\Database\Seeder;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('articles')->truncate();
        DB::table('articles')->insert([
            [
                'author_id'=>1,
                'title'=>'Article 1',
                'content'=>'this is an example post.',
                'published_at'=>date('Y-m-d H:i:s',strtotime('now'))
            ],
            [
                'author_id'=>1,
                'title'=>'Article 2',
                'content'=>'this is an example post.',
                'published_at'=>date('Y-m-d H:i:s',strtotime('now'))
            ],
            [
                'author_id'=>1,
                'title'=>'Article 3',
                'content'=>'this is an example post.',
                'published_at'=>date('Y-m-d H:i:s',strtotime('now'))
            ]
        ]);
    }
}
