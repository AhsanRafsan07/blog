<?php

use Illuminate\Database\Seeder;

class productsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = 
        [
        	[
        		'product_name' => 'casual shirt',
        		'product_price' => '1250',
        		'product_sku' => '00DW10',
        		'product_image' => 'pro_image_1.png',
        		'product_description' => 'this a test description'
        	],
        	[
        		'product_name' => 'jeans denim',
        		'product_price' => '2500',
        		'product_sku' => '00JD11',
        		'product_image' => 'pro_image_2.png',
        		'product_description' => 'this a test description'	
        	],
        ];

        foreach ($products as $key => $value) {
        	DB::table('products')->insert([
        		$key => $value
        	]);
        }
    }
}
