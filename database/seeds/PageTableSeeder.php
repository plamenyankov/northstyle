<?php

use Illuminate\Database\Seeder;

class PageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pages')->truncate();
        DB::table('pages')->insert([
            [
            'title'=>'About',
            'uri'=>'about',
            'content'=>'This is about page'
        ],
            [
                'title'=>'Contact',
                'uri'=>'contact',
                'content'=>'This is contact page'
            ],
            [
                'title'=>'FAQ',
                'uri'=>'faq',
                'content'=>'This is about page'
            ],
            [
                'title'=>'Media',
                'uri'=>'media',
                'content'=>'This is about page'
            ]
            ]
            );
    }
}
