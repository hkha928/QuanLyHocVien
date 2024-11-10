<?php
// echo '<pre>';
// var_dump($hocvien);
// echo date("Y-m-d", strtotime($hocvien->ngay_sinh));
?>
<h2>Update Course</h2>
<form action="index.php?controller=khoahoc&action=updateKhoaHoc" method="POST">
    <input type="hidden" name="id_khoa_hoc" value="<?php echo $data['id_khoa_hoc']; ?> ">

    <div class="mb-3">
        <label for="ma_khoa_hoc" class="form-label">Course Code</label>
        <input type="text" class="form-control" id="ma_khoa_hoc" name="ma_khoa_hoc" value="<?php echo $data['ma_khoa_hoc']; ?> " readonly>
    </div>

    <div class="mb-3">
        <label for="ten_khoa_hoc" class="form-label">Name</label>
        <input type="text" class="form-control" id="ten_khoa_hoc" name="ten_khoa_hoc" value="<?php echo $data['ten_khoa_hoc']; ?>" required>
    </div>

    <div class="mb-3">
        <label for="ngay_bat_dau_kh" class="form-label">Start Date</label>
        <input type="date" class="form-control" id="ngay_bat_dau_kh" name="ngay_bat_dau_kh" value="<?php echo date("Y-m-d", strtotime($data['ngay_bat_dau_kh'])) ?>" required>
    </div>

    <div class="mb-3">
        <label for="ngay_ket_thuc_kh" class="form-label">End Date</label>
        <input type="date" class="form-control" id="ngay_ket_thuc_kh" name="ngay_ket_thuc_kh" value="<?php echo date("Y-m-d", strtotime($data['ngay_ket_thuc_kh'])) ?>" required>
    </div>

    <div class="mb-3">
        <label for="status_id" class="form-label">Status</label>
        <select class="form-select" id="status_id" name="status_id">
            <option value="1" <?php echo $data['status_id'] == 1 ? 'selected' : ''; ?>>Active</option>
            <option value="0" <?php echo $data['status_id'] == 0 ? 'selected' : ''; ?>>Inactive</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Update Course</button>
    <a href="index.php?controller=khoahoc&action=index" class="btn btn-secondary">Cancel</a>

</form>