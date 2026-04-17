<?php

namespace App\Models;

use App\Models\Scopes\SortByNameScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Student extends Model
{
    protected $fillable = [
        'student_name',
        'class_id',
        'is_active',
    ];

    /**
     * The "booted" method of the model.
     * Apply global scopes
     */
    protected static function booted()
    {
        static::addGlobalScope(new SortByNameScope());
    }

    /**
     * Get the classroom that the student belongs to
     * @return BelongsTo
     */
    public function classroom(): BelongsTo
    {
        return $this->belongsTo(Classroom::class, 'class_id');
    }

    /**
     * Get all subjects the student is registered for
     * @return BelongsToMany
     */
    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class, 'student_subject')
                    ->withPivot(['score', 'registered_at']);
    }

    /**
     * Local scope: Get only active students
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Mock data for testing (session-based)
     */
    public static function mockData(): array
    {
        return [
            [
                'id' => 1,
                'ma_sv' => 'SV001',
                'ho_ten' => 'Nguyễn Văn A',
                'nam_sinh' => 2003,
                'so_dt' => '0987123456',
                'email' => 'nguyenvana@example.com',
                'dia_chi' => 'Số 12 Lê Lợi, Hà Nội',
                'que_quan' => 'Thái Bình',
                'lop' => 'DHKTMP1',
                'nganh' => 'Kỹ thuật phần mềm',
                'khoa' => 'Công nghệ thông tin',
                'ghi_chu' => 'Email đã xác thực',
            ],
            [
                'id' => 2,
                'ma_sv' => 'SV002',
                'ho_ten' => 'Trần Thị B',
                'nam_sinh' => 2004,
                'so_dt' => '0912345678',
                'email' => 'tranthib@example.com',
                'dia_chi' => '247 Nguyễn Trãi, Hà Nội',
                'que_quan' => 'Hòa Bình',
                'lop' => 'DHKTMP1',
                'nganh' => 'Kỹ thuật phần mềm',
                'khoa' => 'Công nghệ thông tin',
                'ghi_chu' => 'Đã nộp hồ sơ',
            ],
            [
                'id' => 3,
                'ma_sv' => 'SV003',
                'ho_ten' => 'Lê Thị C',
                'nam_sinh' => 2002,
                'so_dt' => '0901234567',
                'email' => 'lethic@example.com',
                'dia_chi' => '35 Trần Phú, Hà Nội',
                'que_quan' => 'Nam Định',
                'lop' => 'DHKTMP2',
                'nganh' => 'Mạng máy tính',
                'khoa' => 'Công nghệ thông tin',
                'ghi_chu' => 'Học bổng',
            ],
            [
                'id' => 4,
                'ma_sv' => 'SV004',
                'ho_ten' => 'Phạm Văn D',
                'nam_sinh' => 2003,
                'so_dt' => '0987654321',
                'email' => 'phamvand@example.com',
                'dia_chi' => '68 Xuân Thủy, Hà Nội',
                'que_quan' => 'Hà Nam',
                'lop' => 'DHKTMP2',
                'nganh' => 'Công nghệ phần mềm',
                'khoa' => 'Công nghệ thông tin',
                'ghi_chu' => 'Chưa có giấy tờ',
            ],
            [
                'id' => 5,
                'ma_sv' => 'SV005',
                'ho_ten' => 'Đỗ Minh E',
                'nam_sinh' => 2004,
                'so_dt' => '0978123456',
                'email' => 'dohmien@example.com',
                'dia_chi' => '11A Hoàng Hoa Thám, Hà Nội',
                'que_quan' => 'Bắc Ninh',
                'lop' => 'DHKTMP3',
                'nganh' => 'Kỹ thuật phần mềm',
                'khoa' => 'Công nghệ thông tin',
                'ghi_chu' => 'Hoàn thành kiểm tra',
            ],
        ];
    }
}
