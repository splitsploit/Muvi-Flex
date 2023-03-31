<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Package::create([
        //     [
        //         'name' => 'standard',
        //         'price' => '380000',
        //         'max_days' => 30,
        //         'max_users' => 2,
        //         'is_download' => 1,
        //         'is_4k' => 0,
        //     ],
        //     [
        //         'name' => 'gold',
        //         'price' => '699000',
        //         'max_days' => 60,
        //         'max_users' => 7,
        //         'is_download' => 1,
        //         'is_4k' => 1,
        //     ],
        // ]);

        $package = [
            [
                'name' => 'standard',
                'price' => '380000',
                'max_days' => 30,
                'max_users' => 2,
                'is_download' => 1,
                'is_4k' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'), 
            ],
            [
                'name' => 'gold',
                'price' => '699000',
                'max_days' => 60,
                'max_users' => 7,
                'is_download' => 1,
                'is_4k' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ];

        Package::insert($package);
    }
}
