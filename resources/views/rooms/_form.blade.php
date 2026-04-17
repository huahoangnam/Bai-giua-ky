<div class="input-group">
    <label for="ma_phong">Mã phòng</label>
    <input type="text" id="ma_phong" name="ma_phong" value="{{ old('ma_phong', $room['ma_phong'] ?? '') }}">
</div>
<div class="input-group">
    <label for="ten_phong">Tên phòng</label>
    <input type="text" id="ten_phong" name="ten_phong" value="{{ old('ten_phong', $room['ten_phong'] ?? '') }}">
</div>
<div class="input-group">
    <label for="toà_nha">Tòa nhà</label>
    <input type="text" id="toà_nha" name="toà_nha" value="{{ old('toà_nha', $room['toà_nha'] ?? '') }}">
</div>
<div class="input-group">
    <label for="tang">Tầng</label>
    <input type="number" id="tang" name="tang" value="{{ old('tang', $room['tang'] ?? '') }}">
</div>
<div class="input-group">
    <label for="suc_chua">Sức chứa</label>
    <input type="number" id="suc_chua" name="suc_chua" value="{{ old('suc_chua', $room['suc_chua'] ?? '') }}">
</div>
<div class="input-group">
    <label for="loai_phong">Loại phòng</label>
    <input type="text" id="loai_phong" name="loai_phong" value="{{ old('loai_phong', $room['loai_phong'] ?? '') }}">
</div>
<div class="input-group">
    <label for="trang_bi">Trang bị</label>
    <textarea id="trang_bi" name="trang_bi" rows="3">{{ old('trang_bi', $room['trang_bi'] ?? '') }}</textarea>
</div>
<div class="input-group">
    <label for="ghi_chu">Ghi chú</label>
    <textarea id="ghi_chu" name="ghi_chu" rows="3">{{ old('ghi_chu', $room['ghi_chu'] ?? '') }}</textarea>
</div>
