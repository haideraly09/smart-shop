<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\{Category, Brand, Supplier, Product};


use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
  public function run(): void
{
    User::updateOrCreate(
        ['email' => 'admin@demo.com'],
        [
            'name' => 'Admin',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]
    );
    // use App\Models\{Category, Brand, Supplier, Product};  (file ke upar)

$categories = collect(['Electronics', 'Grocery', 'Clothing', 'Stationery', 'Home & Kitchen'])
    ->map(fn ($name) => Category::firstOrCreate(['name' => $name]));

$brands = collect(['Samsung', 'Nestle', 'Nike', 'Dawlance', 'Faber-Castell'])
    ->map(fn ($name) => Brand::firstOrCreate(['name' => $name]));

$suppliers = Supplier::factory()->count(5)->create();

Product::factory()->count(100)->make()->each(function ($product) use ($categories, $brands, $suppliers) {
    $product->category_id = $categories->random()->id;
    $product->brand_id    = $brands->random()->id;
    $product->supplier_id = $suppliers->random()->id;
    $product->save();
});

    User::updateOrCreate(
        ['email' => 'staff@demo.com'],
        [
            'name' => 'Staff',
            'password' => Hash::make('password'),
            'role' => 'staff',
        ]
    );
}
}
