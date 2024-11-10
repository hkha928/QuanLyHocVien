<?php
// echo '<pre>';
// var_dump($hocvien);
// echo date("Y-m-d", strtotime($hocvien->ngay_sinh));
?>
<h2>Update Student</h2>
<form action="index.php?controller=hocvien&action=updateHocVien" method="POST">
    <input type="hidden" name="id_hoc_vien" value="<?php echo $hocvien['id_hoc_vien']; ?> ">

    <div class="mb-3">
        <label for="ma_hoc_vien" class="form-label">Student Code</label>
        <input type="text" class="form-control" id="ma_hoc_vien" name="ma_hoc_vien" value="<?php echo $hocvien['ma_hoc_vien']; ?> " readonly>
    </div>

    <div class="mb-3">
        <label for="ten_hoc_vien" class="form-label">Name</label>
        <input type="text" class="form-control" id="ten_hoc_vien" name="ten_hoc_vien" value="<?php echo $hocvien['ten_hoc_vien']; ?>" required>
    </div>

    <div class="mb-3">
        <label for="ngay_sinh" class="form-label">Date of Birth</label>
        <input type="date" class="form-control" id="ngay_sinh" name="ngay_sinh" value="<?php echo date("Y-m-d", strtotime($hocvien['ngay_sinh'])) ?>" required>
    </div>

    <div class="mb-3">
        <label for="sdt" class="form-label">Phone Number</label>
        <input type="text" class="form-control" id="sdt" name="sdt" value="<?php echo $hocvien['sdt']; ?>" required>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="<?php echo $hocvien['email']; ?>" required>
    </div>

    <div class="mb-3">
        <label for="status_id" class="form-label">Status</label>
        <select class="form-select" id="status_id" name="status_id">
            <option value="1" <?php echo $hocvien['status_id'] == 1 ? 'selected' : ''; ?>>Active</option>
            <option value="0" <?php echo $hocvien['status_id'] == 0 ? 'selected' : ''; ?>>Inactive</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Update Student</button>
    <a href="index.php?controller=hocvien&action=index" class="btn btn-secondary">Cancel</a>
</form>