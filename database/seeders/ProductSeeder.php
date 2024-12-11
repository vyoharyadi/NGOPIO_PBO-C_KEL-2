<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'name' => 'Americano',
                'price' => '18000',
                'detail' => 'The aroma of our Americano brewed with premium roasted coffee grounds and hot water. It has a velvety body, caramel-like aroma with an earthy flavour and bittersweet finish.',
                'image' => 'https://storage.googleapis.com/a1aa/image/W5wKzWhcPabIKtQbiCXEa7G1CGYtQ45VumjFqPCXQGiDM39E.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cappuccino',
                'price' => '20000',
                'detail' => 'With the richness and intensity of espresso, complemented by the creamy and velvety texture of steamed milk, offering a combination of strong coffee notes, subtle sweetness, and a touch of bitterness.',
                'image' => 'https://storage.googleapis.com/a1aa/image/Sisj5yqNBKrtOF9fIfWlVDSFA115jBKxnIfeBVrd9lZ3AzdPB.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Log Cake',
                'price' => '25000',
                'detail' => 'Taste a combination of sweet and rich flavours of our thin sheet of sponge cake filled with a creamy filling, chocolate ganache, buttercream and a cherry on top as a garnish.',
                'image' => 'https://storage.googleapis.com/a1aa/image/tgd7ZeCOSdStcKWsZeKGdlr2PAiQkOqvxVFQwJFOHRAPwc3TA.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
