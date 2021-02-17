<?php

use bheller\ImagesGenerator\ImagesGeneratorProvider;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Modules\Item\Dao\Models\Product;
use Modules\Item\Dao\Models\ProductDetail;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker\Factory::create();
        for ($i = 0; $i <= 15; $i++) {

            $name = $faker->name;
            $slug = $faker->slug;

            $faker->addProvider(new ImagesGeneratorProvider($faker));
            $image = $faker->imageGenerator('public/files/product', 300, 400, 'jpg', false, $name, $faker->hexcolor, $faker->hexcolor);
            $save = Product::create([
                'item_product_slug' => $slug,
                'item_product_min_stock' => 1,
                'item_product_max_stock' => 1,
                'item_product_sku' => $faker->numberBetween(10000, 20000),
                'item_product_buy' => $faker->numberBetween(10000, 20000),
                'item_product_sell' => $faker->numberBetween(10000, 20000),
                'item_product_discount' => $faker->numberBetween(10000, 20000),
                'item_product_price' => $faker->numberBetween(100000, 700000),
                'item_product_stroke' => $faker->numberBetween(600000, 900000),
                'item_product_image' => $image,
                'item_product_item_sub_category_id' => null,
                'item_product_item_category_id' => $faker->randomElement(['1', '2', '3', '4', '5', '6']),
                'item_product_item_brand_id' => $faker->randomElement(['1', '2', '3']),
                'item_product_item_tag_json' => json_encode($faker->randomElements([
                    'sepatu',
                    'tshirt',
                    'snickers',
                    'bantal',
                    'kasur',
                    'komputer',
                    'mainan',
                    'motor',
                    'meja',
                    'galon',
                    'sofa',
                    'kabel',
                    'usb',
                    'handphone',
                    'android',
                    'iphone',
                ], 4)),
                'item_product_name' => $name,
                'item_product_description' => $faker->text(600),
                'item_product_updated_at' => $faker->date('Y-m-d H:i:s'),
                'item_product_created_at' => $faker->date('Y-m-d H:i:s'),
                'item_product_deleted_at' => null,
                'item_product_updated_by' => 'faker',
                'item_product_created_by' => 'faker',
                'item_product_counter' => $faker->randomDigit,
                'item_product_status' => 1,
                'item_product_weight' => $faker->numberBetween(100, 900),
                'item_product_display' => 1,
                'item_product_stock' => $faker->numberBetween(100, 500),
                'item_product_min_order' => $faker->numberBetween(1, 10),
                'item_product_max_order' => 0,
                'item_product_flag_name' => $faker->word,
                'item_product_flag_color' => $faker->colorName,
                'item_product_flag_background' => $faker->colorName,
                'item_product_page_content_1' => $faker->text(1000),
                'item_product_page_content_2' => $faker->text(1000),
                'item_product_page_content_3' => $faker->text(1000),
                'item_product_page_name_1' => $faker->sentence(1),
                'item_product_page_name_2' => $faker->sentence(1),
                'item_product_page_name_3' => $faker->sentence(1),
                'item_product_page_active_3' => 1,
                'item_product_page_active_2' => 1,
                'item_product_page_active_1' => 1,
                'item_product_page_seo' => $faker->sentence(10),
                'item_product_sold' => $faker->numberBetween(50, 100),
                'item_product_is_variant' => 0,
            ]);

            $product_id = $save->item_product_id;
            $product_name = $save->item_product_name;
            $product_image = $save->item_detail_product_image;
            $product_slug = $save->item_detail_product_slug;

            $random_variant = $faker->randomElement(['1', '2']);
            $variant_name = $random_variant == 1 ? '30cm' : '40cm';

            $random_branch = $faker->randomElement(['1', '2', '3', '4']);
            if ($random_branch == 1) {
                $location = 5;
                $branch = 'Labways Indohitek';
                $address = 'Bekasi';
            } elseif ($random_branch == 2) {

                $location = 6;
                $branch = 'Indo Inovasi Prima';
                $address = 'Jakarta Timur';
            } elseif ($random_branch == 3) {

                $location = 7;
                $branch = 'Benline Optima';
                $address = 'Tangerang';
            } elseif ($random_branch == 4) {

                $location = 8;
                $branch = 'Mitrais';
                $address = 'Yogyakarta';
            } else {

                $location = 1;
                $branch = 'Maju Mundur';
                $address = 'Planet Namex';
            }

            $random_color = $faker->randomElement(['1','2', '3', '4', '5']);
            if($random_color == 1){
                $color = 'BLUE';
            }
            elseif($random_color == 2){
                $color = 'GREEN';
            }
            elseif($random_color == 3){
                $color = 'RED';
            }
            elseif($random_color == 4){
                $color = 'YELLOW';
            }
            elseif($random_color == 5){
                $color = 'WHITE';
            }

            $size = 'Default';
            $random_size = $faker->randomElement(['S','M', 'L', 'XL', 'XXL']);
            if($random_color == 'S'){
                $size = 'Small';
            }
            elseif($random_size == 'M'){
                $size = 'Medium';
            }
            elseif($random_size == 'L'){
                $size = 'Large';
            }
            elseif($random_size == 'XL'){
                $size = 'Extra Large';
            }

            for ($x = 0; $x <= 5; $x++) {
                // ProductDetail::create([
                //     'item_detail_name' => $product_name,
                //     'item_detail_price' => $faker->numberBetween(10000, 20000),
                //     'item_detail_product_id' => $product_id,
                //     'item_detail_product_name' => $product_name,
                //     'item_detail_product_image' => $product_image,
                //     'item_detail_product_slug' => $product_slug,
                //     'item_detail_variant_id' => $random_variant,
                //     'item_detail_variant_name' => $variant_name,
                //     'item_detail_branch_id' => $random_branch,
                //     'item_detail_branch_name' => $branch,
                //     'item_detail_branch_address' => $address,
                //     'item_detail_branch_location' => $location,
                // ]);

                // ProductDetail::create([
                //     'item_detail_name' => $product_name,
                //     'item_detail_price' => $faker->numberBetween(10000, 20000),
                //     'item_detail_product_id' => $product_id,
                //     'item_detail_product_name' => $product_name,
                //     'item_detail_product_image' => $product_image,
                //     'item_detail_product_slug' => $product_slug,
                //     'item_detail_color_id' => $random_color,
                //     'item_detail_color_name' => $color,
                //     'item_detail_size_id' => $random_size,
                //     'item_detail_size_name' => $size,
                //     'item_detail_branch_id' => $random_branch,
                //     'item_detail_branch_name' => $branch,
                //     'item_detail_branch_address' => $address,
                //     'item_detail_branch_location' => $location,
                // ]);

                ProductDetail::create([
                    'item_detail_name' => $product_name,
                    'item_detail_price' => $faker->numberBetween(10000, 20000),
                    'item_detail_product_id' => $product_id,
                    'item_detail_product_name' => $product_name,
                    'item_detail_product_image' => $product_image,
                    'item_detail_product_slug' => $product_slug,
                    'item_detail_branch_id' => $random_branch,
                    'item_detail_branch_name' => $branch,
                    'item_detail_branch_address' => $address,
                    'item_detail_branch_location' => $location,
                ]);
            }

        }

        // factory(Product::class, 500)->create();
    }
}
