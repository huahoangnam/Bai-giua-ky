<div class="input-group">
    <label for="ma_hp">Mã học phần</label>
    <input type="text" id="ma_hp" name="ma_hp" value="{{ old('ma_hp', $subject['ma_hp'] ?? '') }}">
</div>
<div class="input-group">
    <label for="ten_hp">Tên học phần</label>
    <input type="text" id="ten_hp" name="ten_hp" value="{{ old('ten_hp', $subject['ten_hp'] ?? '') }}">
</div>
<div class="input-group">
    <label for="so_tin_chi">Số tín chỉ</label>
    <input type="number" id="so_tin_chi" name="so_tin_chi" value="{{ old('so_tin_chi', $subject['so_tin_chi'] ?? '') }}">
</div>
<div class="input-group">
    <label for="so_tiet_ly_thuyet">Số tiết lý thuyết</label>
    <input type="number" id="so_tiet_ly_thuyet" name="so_tiet_ly_thuyet" value="{{ old('so_tiet_ly_thuyet', $subject['so_tiet_ly_thuyet'] ?? '') }}">
</div>
<div class="input-group">
    <label for="so_tiet_thuc_hanh">Số tiết thực hành</label>
    <input type="number" id="so_tiet_thuc_hanh" name="so_tiet_thuc_hanh" value="{{ old('so_tiet_thuc_hanh', $subject['so_tiet_thuc_hanh'] ?? '') }}">
</div>
<div class="input-group">
    <label for="hoc_ky">Học kỳ</label>
    <input type="number" id="hoc_ky" name="hoc_ky" value="{{ old('hoc_ky', $subject['hoc_ky'] ?? '') }}">
</div>
<div class="input-group">
    <label for="nam_hoc">Năm học</label>
    <input type="text" id="nam_hoc" name="nam_hoc" value="{{ old('nam_hoc', $subject['nam_hoc'] ?? '') }}">
</div>
<div class="input-group">
    <label for="khoa_phu_trach">Khoa phụ trách</label>
    <input type="text" id="khoa_phu_trach" name="khoa_phu_trach" value="{{ old('khoa_phu_trach', $subject['khoa_phu_trach'] ?? '') }}">
</div>
<div class="input-group">
    <label for="nganh_ap_dung">Ngành áp dụng</label>
    <input type="text" id="nganh_ap_dung" name="nganh_ap_dung" value="{{ old('nganh_ap_dung', $subject['nganh_ap_dung'] ?? '') }}">
</div>
<div class="input-group">
    <label for="loai_hoc_phan">Loại học phần</label>
    <input type="text" id="loai_hoc_phan" name="loai_hoc_phan" value="{{ old('loai_hoc_phan', $subject['loai_hoc_phan'] ?? '') }}">
</div>
<div class="input-group">
    <label for="tien_quyet">Tiền quyết</label>
    <input type="text" id="tien_quyet" name="tien_quyet" value="{{ old('tien_quyet', $subject['tien_quyet'] ?? '') }}">
</div>
<div class="input-group">
    <label for="song_hanh">Song hành</label>
    <input type="text" id="song_hanh" name="song_hanh" value="{{ old('song_hanh', $subject['song_hanh'] ?? '') }}">
</div>
<div class="input-group">
    <label for="mo_ta">Mô tả</label>
    <textarea id="mo_ta" name="mo_ta" rows="3">{{ old('mo_ta', $subject['mo_ta'] ?? '') }}</textarea>
</div>
<div class="input-group">
    <label for="ghi_chu">Ghi chú</label>
    <textarea id="ghi_chu" name="ghi_chu" rows="2">{{ old('ghi_chu', $subject['ghi_chu'] ?? '') }}</textarea>
</div>
