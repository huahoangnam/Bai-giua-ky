<div class="input-group">
    <label for="ma_lop">Mã lớp</label>
    <input type="text" id="ma_lop" name="ma_lop" value="{{ old('ma_lop', $classroom['ma_lop'] ?? '') }}">
</div>
<div class="input-group">
    <label for="ten_lop">Tên lớp</label>
    <input type="text" id="ten_lop" name="ten_lop" value="{{ old('ten_lop', $classroom['ten_lop'] ?? '') }}">
</div>
<div class="input-group">
    <label for="si_so">Sĩ số</label>
    <input type="number" id="si_so" name="si_so" value="{{ old('si_so', $classroom['si_so'] ?? '') }}">
</div>
<div class="input-group">
    <label for="khoa_hoc">Khóa học</label>
    <input type="text" id="khoa_hoc" name="khoa_hoc" value="{{ old('khoa_hoc', $classroom['khoa_hoc'] ?? '') }}">
</div>
<div class="input-group">
    <label for="nganh">Ngành</label>
    <input type="text" id="nganh" name="nganh" value="{{ old('nganh', $classroom['nganh'] ?? '') }}">
</div>
<div class="input-group">
    <label for="giao_vien">Giáo viên</label>
    <input type="text" id="giao_vien" name="giao_vien" value="{{ old('giao_vien', $classroom['giao_vien'] ?? '') }}">
</div>
<div class="input-group">
    <label for="phong_hoc">Phòng học</label>
    <select id="phong_hoc" name="phong_hoc">
        <option value="">-- Chọn phòng học --</option>
        @foreach($rooms ?? [] as $room)
            <option value="{{ $room['ma_phong'] }}" {{ old('phong_hoc', $classroom['phong_hoc'] ?? '') === $room['ma_phong'] ? 'selected' : '' }}>
                {{ $room['ma_phong'] }} - {{ $room['ten_phong'] }}
            </option>
        @endforeach
    </select>
</div>
<div class="input-group">
    <label for="ghi_chu">Ghi chú</label>
    <textarea id="ghi_chu" name="ghi_chu" rows="3">{{ old('ghi_chu', $classroom['ghi_chu'] ?? '') }}</textarea>
</div>
