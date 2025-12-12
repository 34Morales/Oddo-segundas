<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use DB;

class CategoriesProductsSeeder extends Seeder {
    public function run(){
        DB::table('categories')->insert([
            ['name'=>'Electrónica','description'=>'','created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Papelería','description'=>'','created_at'=>now(),'updated_at'=>now()],
        ]);

        DB::table('products')->insert([
            ['sku'=>'ELEC001','name'=>'Multímetro','category_id'=>1,'stock'=>10,'price'=>350.00,'created_at'=>now(),'updated_at'=>now()],
            ['sku'=>'PAPE001','name'=>'Cuaderno A4','category_id'=>2,'stock'=>100,'price'=>20.50,'created_at'=>now(),'updated_at'=>now()],
        ]);
    }
}
