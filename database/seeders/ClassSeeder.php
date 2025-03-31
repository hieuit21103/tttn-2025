<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ClassModel;

class ClassSeeder extends Seeder
{
    public function run()
    {
        $classes = [
            [
                'code' => 'IT101',
                'name' => 'Lớp Công nghệ thông tin 101'
            ],
            [
                'code' => 'IT102',
                'name' => 'Lớp Công nghệ thông tin 102'
            ],
            [
                'code' => 'IT103',
                'name' => 'Lớp Công nghệ thông tin 103'
            ],
            [
                'code' => 'IT104',
                'name' => 'Lớp Công nghệ thông tin 104'
            ],
            [
                'code' => 'IT105',
                'name' => 'Lớp Công nghệ thông tin 105'
            ],
            [
                'code' => 'IT201',
                'name' => 'Lớp Công nghệ thông tin 201'
            ],
            [
                'code' => 'IT202',
                'name' => 'Lớp Công nghệ thông tin 202'
            ],
            [
                'code' => 'IT203',
                'name' => 'Lớp Công nghệ thông tin 203'
            ],
            [
                'code' => 'IT204',
                'name' => 'Lớp Công nghệ thông tin 204'
            ],
            [
                'code' => 'IT205',
                'name' => 'Lớp Công nghệ thông tin 205'
            ]
        ];

        foreach ($classes as $class) {
            ClassModel::create($class);
        }
    }
}
