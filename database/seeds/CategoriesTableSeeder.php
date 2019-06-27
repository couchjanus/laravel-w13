<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('categories')->insert([
        //     'name' => str_random(10),
        //     'description' => str_random(100)
        //     ]);
        $categoriesData = array(
            array('name' => 'artisan'),
            array('name' => 'php'),
            array('name' => 'laravel'),
        );

        // Удаляем предыдущие данные

        DB::table('categories')->delete();

        foreach ($categoriesData as $cat) {
            DB::table('categories')->insert([
                  'name' => $cat['name'],
                  'description' => str_random(100)
            ]);
        }
 
    }
}
