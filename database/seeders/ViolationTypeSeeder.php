<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ViolationType;

class ViolationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $violationTypes = [
            [
                'name' => 'Đến muộn/Đi sớm',
                'description' => 'Sinh viên đến muộn hoặc về sớm hơn giờ quy định',
                'penalty' => '50.000 VND'
            ],
            [
                'name' => 'Đánh nhau',
                'description' => 'Sinh viên gây gổ, đánh nhau trong khu ký túc xá',
                'penalty' => '200.000 VND'
            ],
            [
                'name' => 'Đánh thức người khác',
                'description' => 'Sinh viên đánh thức người khác sau 23h hoặc trước 6h',
                'penalty' => '100.000 VND'
            ],
            [
                'name' => 'Đem thức ăn vào phòng',
                'description' => 'Sinh viên mang thức ăn vào phòng gây mùi, ảnh hưởng đến người khác',
                'penalty' => '50.000 VND'
            ],
            [
                'name' => 'Để rác bừa bãi',
                'description' => 'Sinh viên vứt rác không đúng nơi quy định',
                'penalty' => '50.000 VND'
            ],
            [
                'name' => 'Để nước rò rỉ',
                'description' => 'Sinh viên để nước rò rỉ gây lãng phí',
                'penalty' => '100.000 VND'
            ],
            [
                'name' => 'Để điện sáng',
                'description' => 'Sinh viên để đèn sáng sau 23h',
                'penalty' => '50.000 VND'
            ],
            [
                'name' => 'Để cửa mở',
                'description' => 'Sinh viên để cửa phòng mở sau 22h',
                'penalty' => '50.000 VND'
            ],
            [
                'name' => 'Để người lạ vào',
                'description' => 'Sinh viên cho người không phải sinh viên ký túc xá vào phòng',
                'penalty' => '200.000 VND'
            ],
            [
                'name' => 'Để động vật',
                'description' => 'Sinh viên nuôi hoặc mang động vật vào ký túc xá',
                'penalty' => '200.000 VND'
            ]
        ];

        foreach ($violationTypes as $type) {
            ViolationType::create($type);
        }
    }
}
