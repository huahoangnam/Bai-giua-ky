<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Subject extends Model
{
    protected $fillable = [
        'subject_name',
    ];

    /**
     * Get all students registered for this subject
     * @return BelongsToMany
     */
    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'student_subject')
                    ->withPivot(['score', 'registered_at']);
    }

    /**
     * Mock data for testing (session-based)
     */
    public static function mockData(): array
    {
        return [
            [
                'id' => 1,
                'ma_hp' => 'IT3243',
                'ten_hp' => 'Xử lý ảnh và thị giác máy tính',
                'so_tin_chi' => 3,
                'so_tiet_ly_thuyet' => 30,
                'so_tiet_thuc_hanh' => 30,
                'hoc_ky' => 1,
                'nam_hoc' => '2025-2026',
                'khoa_phu_trach' => 'Công nghệ thông tin',
                'nganh_ap_dung' => 'Toàn khoa CNTT',
                'loai_hoc_phan' => 'Bắt buộc',
                'tien_quyet' => 'Lập trình Python',
                'song_hanh' => null,
                'mo_ta' => 'Cung cấp kiến thức cơ bản về XLA & TGMT',
                'ghi_chu' => 'Học phần dành cho sinh viên năm cuối',
            ],
            [
                'id' => 2,
                'ma_hp' => 'IT2101',
                'ten_hp' => 'Cơ sở dữ liệu nâng cao',
                'so_tin_chi' => 4,
                'so_tiet_ly_thuyet' => 45,
                'so_tiet_thuc_hanh' => 30,
                'hoc_ky' => 2,
                'nam_hoc' => '2025-2026',
                'khoa_phu_trach' => 'Công nghệ thông tin',
                'nganh_ap_dung' => 'Hệ thống thông tin',
                'loai_hoc_phan' => 'Bắt buộc',
                'tien_quyet' => 'Cấu trúc dữ liệu',
                'song_hanh' => 'Lập trình cơ sở dữ liệu',
                'mo_ta' => 'Khái niệm và ứng dụng cơ sở dữ liệu quan hệ và noSQL.',
                'ghi_chu' => 'Thi theo học kỳ',
            ],
            [
                'id' => 3,
                'ma_hp' => 'IT2020',
                'ten_hp' => 'Mạng máy tính',
                'so_tin_chi' => 3,
                'so_tiet_ly_thuyet' => 30,
                'so_tiet_thuc_hanh' => 15,
                'hoc_ky' => 1,
                'nam_hoc' => '2025-2026',
                'khoa_phu_trach' => 'Công nghệ thông tin',
                'nganh_ap_dung' => 'An toàn thông tin',
                'loai_hoc_phan' => 'Tự chọn',
                'tien_quyet' => 'Tin học đại cương',
                'song_hanh' => null,
                'mo_ta' => 'Giới thiệu kiến trúc mạng và giao thức truyền thông.',
                'ghi_chu' => 'Học phần cần thiết cho lập trình mạng',
            ],
            [
                'id' => 4,
                'ma_hp' => 'IT3335',
                'ten_hp' => 'Thị giác máy tính',
                'so_tin_chi' => 3,
                'so_tiet_ly_thuyet' => 30,
                'so_tiet_thuc_hanh' => 30,
                'hoc_ky' => 2,
                'nam_hoc' => '2025-2026',
                'khoa_phu_trach' => 'Công nghệ thông tin',
                'nganh_ap_dung' => 'Trí tuệ nhân tạo',
                'loai_hoc_phan' => 'Tự chọn',
                'tien_quyet' => 'Xử lý ảnh và thị giác máy tính',
                'song_hanh' => 'Machine Learning',
                'mo_ta' => 'Nâng cao thuật toán xử lý ảnh và nhận dạng đối tượng.',
                'ghi_chu' => 'Yêu cầu biết Python cơ bản',
            ],
            [
                'id' => 5,
                'ma_hp' => 'IT1102',
                'ten_hp' => 'Kiến trúc máy tính',
                'so_tin_chi' => 3,
                'so_tiet_ly_thuyet' => 45,
                'so_tiet_thuc_hanh' => 15,
                'hoc_ky' => 1,
                'nam_hoc' => '2025-2026',
                'khoa_phu_trach' => 'Công nghệ thông tin',
                'nganh_ap_dung' => 'Kỹ thuật phần mềm',
                'loai_hoc_phan' => 'Bắt buộc',
                'tien_quyet' => 'Điện tử cơ bản',
                'song_hanh' => null,
                'mo_ta' => 'Giới thiệu cấu trúc và thiết kế của CPU, bộ nhớ và I/O.',
                'ghi_chu' => 'Nắm vững lý thuyết để học môn nâng cao',
            ],
        ];
    }
}
