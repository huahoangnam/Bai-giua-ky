<div class="input-group">
    <label for="ma_sv">Mã sinh viên</label>
    <input type="text" id="ma_sv" name="ma_sv" value="{{ old('ma_sv', $student['ma_sv'] ?? '') }}">
</div>
<div class="input-group">
    <label for="ho_ten">Họ tên</label>
    <input type="text" id="ho_ten" name="ho_ten" value="{{ old('ho_ten', $student['ho_ten'] ?? '') }}">
</div>
<div class="input-group">
    <label for="nam_sinh">Năm sinh</label>
    <input type="number" id="nam_sinh" name="nam_sinh" value="{{ old('nam_sinh', $student['nam_sinh'] ?? '') }}">
</div>
<div class="input-group">
    <label for="so_dt">Số điện thoại</label>
    <input type="text" id="so_dt" name="so_dt" value="{{ old('so_dt', $student['so_dt'] ?? '') }}">
</div>
<div class="input-group">
    <label for="email">Email</label>
    <input type="email" id="email" name="email" value="{{ old('email', $student['email'] ?? '') }}">
</div>
<div class="input-group">
    <label for="dia_chi">Địa chỉ</label>
    <input type="text" id="dia_chi" name="dia_chi" value="{{ old('dia_chi', $student['dia_chi'] ?? '') }}">
</div>
<div class="input-group">
    <label for="que_quan">Quê quán</label>
    <input type="text" id="que_quan" name="que_quan" value="{{ old('que_quan', $student['que_quan'] ?? '') }}">
</div>
<div class="input-group">
    <label for="lop">Lớp</label>
    <input type="text" id="lop" name="lop" value="{{ old('lop', $student['lop'] ?? '') }}">
</div>
<div class="input-group">
    <label for="nganh">Ngành</label>
    <input type="text" id="nganh" name="nganh" value="{{ old('nganh', $student['nganh'] ?? '') }}">
</div>
<div class="input-group">
    <label for="khoa">Khoa</label>
    <input type="text" id="khoa" name="khoa" value="{{ old('khoa', $student['khoa'] ?? '') }}">
</div>
<div class="input-group">
    <label for="ghi_chu">Ghi chú</label>
    <textarea id="ghi_chu" name="ghi_chu" rows="3">{{ old('ghi_chu', $student['ghi_chu'] ?? '') }}</textarea>
</div>
