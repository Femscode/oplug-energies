<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User
        $admin = User::updateOrCreate(
            ['email' => 'admin@oplug.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'phone' => '+1234567890',
                'address' => '123 Admin Street, Admin City'
            ]
        );

        // Create Regular Users
        $user1 = User::updateOrCreate(
            ['email' => 'john@example.com'],
            [
                'name' => 'John Doe',
                'password' => Hash::make('password'),
                'role' => 'user',
                'phone' => '+1987654321',
                'address' => '456 User Avenue, User City'
            ]
        );

        $user2 = User::updateOrCreate(
            ['email' => 'jane@example.com'],
            [
                'name' => 'Jane Smith',
                'password' => Hash::make('password'),
                'role' => 'user',
                'phone' => '+1122334455',
                'address' => '789 Customer Lane, Customer Town'
            ]
        );

        // Create Product Categories
        $categories = [
            ['name' => 'Solar Panels', 'slug' => 'solar-panels', 'description' => 'High-efficiency solar panels for residential and commercial use', 'is_active' => true],
            ['name' => 'Inverters', 'slug' => 'inverters', 'description' => 'Power inverters for solar energy systems', 'is_active' => true],
            ['name' => 'Batteries', 'slug' => 'batteries', 'description' => 'Energy storage solutions and backup batteries', 'is_active' => true],
            ['name' => 'Accessories', 'slug' => 'accessories', 'description' => 'Cables, connectors, and mounting equipment', 'is_active' => true],
        ];

        foreach ($categories as $categoryData) {
            ProductCategory::updateOrCreate(
                ['slug' => $categoryData['slug']],
                $categoryData
            );
        }

        // Create Products
        $products = [
            [
                'name' => 'Monocrystalline Solar Panel 400W',
                'slug' => 'monocrystalline-solar-panel-400w',
                'description' => 'High-efficiency monocrystalline solar panel with 400W output capacity. Perfect for residential installations.',
                'price' => 299.99,
                'stock_quantity' => 50,
                'product_category_id' => 1,
                'tags' => ['solar', 'panel', '400w', 'monocrystalline', 'residential'],
                'image' => 'solar-panel-400w.jpg',
                'is_active' => true
            ],
            [
                'name' => 'String Inverter 5kW',
                'slug' => 'string-inverter-5kw',
                'description' => 'Reliable string inverter with 5kW capacity for medium-sized solar installations.',
                'price' => 899.99,
                'stock_quantity' => 25,
                'product_category_id' => 2,
                'tags' => ['inverter', '5kw', 'string', 'solar', 'power'],
                'image' => 'string-inverter-5kw.jpg',
                'is_active' => true
            ],
            [
                'name' => 'Lithium Battery 10kWh',
                'slug' => 'lithium-battery-10kwh',
                'description' => 'High-capacity lithium battery for energy storage with 10kWh capacity.',
                'price' => 4999.99,
                'stock_quantity' => 15,
                'product_category_id' => 3,
                'tags' => ['battery', 'lithium', '10kwh', 'storage', 'backup'],
                'image' => 'lithium-battery-10kwh.jpg',
                'is_active' => true
            ],
            [
                'name' => 'MC4 Connector Set',
                'slug' => 'mc4-connector-set',
                'description' => 'Professional MC4 connector set for solar panel connections. Pack of 10 pairs.',
                'price' => 29.99,
                'stock_quantity' => 100,
                'product_category_id' => 4,
                'tags' => ['connector', 'mc4', 'solar', 'cable', 'accessories'],
                'image' => 'mc4-connector-set.jpg',
                'is_active' => true
            ],
            [
                'name' => 'Polycrystalline Solar Panel 300W',
                'slug' => 'polycrystalline-solar-panel-300w',
                'description' => 'Cost-effective polycrystalline solar panel with 300W output capacity.',
                'price' => 199.99,
                'stock_quantity' => 75,
                'product_category_id' => 1,
                'tags' => ['solar', 'panel', '300w', 'polycrystalline', 'budget'],
                'image' => 'solar-panel-300w.jpg',
                'is_active' => true
            ]
        ];

        foreach ($products as $productData) {
            Product::updateOrCreate(
                ['slug' => $productData['slug']],
                $productData
            );
        }

        // Create Sample Orders
        $order1 = Order::updateOrCreate(
            ['order_number' => 'ORD-001'],
            [
                'user_id' => $user1->id,
                'order_number' => 'ORD-001',
                'total_amount' => 1199.97,
                'status' => 'pending',
                'shipping_address' => [
                    'name' => 'John Doe',
                    'address' => '456 User Avenue',
                    'city' => 'User City',
                    'postal_code' => '12345',
                    'country' => 'USA'
                ],
                'billing_address' => [
                    'name' => 'John Doe',
                    'address' => '456 User Avenue',
                    'city' => 'User City',
                    'postal_code' => '12345',
                    'country' => 'USA'
                ],
                'payment_method' => 'credit_card',
                'payment_status' => 'paid'
            ]
        );

        // Order Items for Order 1
        OrderItem::updateOrCreate(
            ['order_id' => $order1->id, 'product_id' => 1],
            [
                'quantity' => 2,
                'price' => 299.99
            ]
        );

        OrderItem::updateOrCreate(
            ['order_id' => $order1->id, 'product_id' => 4],
            [
                'quantity' => 20,
                'price' => 29.99
            ]
        );

        $order2 = Order::updateOrCreate(
            ['order_number' => 'ORD-002'],
            [
                'user_id' => $user2->id,
                'order_number' => 'ORD-002',
                'total_amount' => 5899.98,
                'status' => 'shipped',
                'shipping_address' => [
                    'name' => 'Jane Smith',
                    'address' => '789 Customer Lane',
                    'city' => 'Customer Town',
                    'postal_code' => '67890',
                    'country' => 'USA'
                ],
                'billing_address' => [
                    'name' => 'Jane Smith',
                    'address' => '789 Customer Lane',
                    'city' => 'Customer Town',
                    'postal_code' => '67890',
                    'country' => 'USA'
                ],
                'payment_method' => 'bank_transfer',
                'payment_status' => 'paid',
                'shipped_at' => now()->subDays(2)
            ]
        );

        // Order Items for Order 2
        OrderItem::updateOrCreate(
            ['order_id' => $order2->id, 'product_id' => 2],
            [
                'quantity' => 1,
                'price' => 899.99
            ]
        );

        OrderItem::updateOrCreate(
            ['order_id' => $order2->id, 'product_id' => 3],
            [
                'quantity' => 1,
                'price' => 4999.99
            ]
        );
    }
}
