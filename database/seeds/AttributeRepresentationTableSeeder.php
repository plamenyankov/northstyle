<?php

use Illuminate\Database\Seeder;

class AttributeRepresentationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('attribute_representations')->truncate();
        \DB::table('attribute_representations')->insert([
            [
                'name' => 'textbox',
                'class' => 'Northstyle\Module\Shop\Model\AttributeRepresentation\Textbox'
            ],
			[
                'name' => 'dropdown',
                'class' => 'Northstyle\Module\Shop\Model\AttributeRepresentation\Dropdown'
            ],
			[
                'name' => 'textarea',
                'class' => 'Northstyle\Module\Shop\Model\AttributeRepresentation\Textarea'
            ],
        ]);
    }
}
