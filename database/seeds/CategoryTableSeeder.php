<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category')->truncate();
        DB::table('category')->insert([
            [
                'title'=>'Мека мебел',

                'content'=>'Мека мебел описание',
                'parent_id'=>null,
                'lft'=>1,
                'rgt'=>4,
                'depth'=>0
            ],
            [
                'title'=>'Модерни Дивани',
                'content'=>'Подкатегория на мека мебел',
                'parent_id'=>1,
                'lft'=>2,
                'rgt'=>3,
                'depth'=>1
            ],
            [
                'title'=>'Мебели за Спалня',
                'content'=>'Подкатегория на мека мебел',
                'parent_id'=>null,
                'lft'=>5,
                'rgt'=>10,
                'depth'=>0
            ],
            [
                'title'=>'Спални',
                'content'=>'Подкатегория на мека мебел',
                'parent_id'=>3,
                'lft'=>6,
                'rgt'=>9,
                'depth'=>1
            ],
            [
                'title'=>'Модерен Дизайн',
                'content'=>'Подкатегория на мека мебел',
                'parent_id'=>4,
                'lft'=>7,
                'rgt'=>8,
                'depth'=>2
            ]]);
    }
}
