<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'id',
        'ma_phong',
        'ten_phong',
        'toà_nha',
        'tang',
        'suc_chua',
        'loai_phong',
        'trang_bi',
        'ghi_chu',
    ];

    public static function mockData(): array
    {
        return [
            [
                'id' => 1,
                'ma_phong' => 'A101',
                'ten_phong' => 'Phòng học A101',
                'toà_nha' => 'Tòa A',
                'tang' => 1,
                'suc_chua' => 35,
                'loai_phong' => 'Phòng lý thuyết',
                'trang_bi' => 'Bảng, Projector, Computer',
                'ghi_chu' => 'Phòng chuẩn',
            ],
            [
                'id' => 2,
                'ma_phong' => 'A102',
                'ten_phong' => 'Phòng học A102',
                'toà_nha' => 'Tòa A',
                'tang' => 1,
                'suc_chua' => 30,
                'loai_phong' => 'Phòng lý thuyết',
                'trang_bi' => 'Bảng, Projector',
                'ghi_chu' => 'Có điều hòa',
            ],
            [
                'id' => 3,
                'ma_phong' => 'B201',
                'ten_phong' => 'Phòng thực hành B201',
                'toà_nha' => 'Tòa B',
                'tang' => 2,
                'suc_chua' => 25,
                'loai_phong' => 'Phòng thực hành',
                'trang_bi' => '20 Máy tính, Projector, Bảng',
                'ghi_chu' => 'Phòng máy 1',
            ],
            [
                'id' => 4,
                'ma_phong' => 'B202',
                'ten_phong' => 'Phòng thực hành B202',
                'toà_nha' => 'Tòa B',
                'tang' => 2,
                'suc_chua' => 25,
                'loai_phong' => 'Phòng thực hành',
                'trang_bi' => '20 Máy tính, Projector',
                'ghi_chu' => 'Phòng máy 2',
            ],
            [
                'id' => 5,
                'ma_phong' => 'C301',
                'ten_phong' => 'Phòng seminar C301',
                'toà_nha' => 'Tòa C',
                'tang' => 3,
                'suc_chua' => 40,
                'loai_phong' => 'Phòng hội thảo',
                'trang_bi' => 'Bàn tròn, Projector, Sound system',
                'ghi_chu' => 'Dùng cho hội thảo',
            ],
        ];
    }
}
