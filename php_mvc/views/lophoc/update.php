<h2>Update Class</h2>
<form action="index.php?controller=lophoc&action=updateLopHoc" method="POST">
    <input type="hidden" name="id_lop_hoc" value="<?php echo $data['lophoc']['id_lop_hoc']; ?> ">

    <div class="mb-3">
        <label for="ma_lop_hoc" class="form-label">Class Code</label>
        <input type="text" class="form-control" id="ma_lop_hoc" name="ma_lop_hoc" value="<?php echo $data['lophoc']['ma_lop_hoc']; ?> " readonly>
    </div>

    <div class="mb-3">
        <label for="ten_lop_hoc" class="form-label">Name</label>
        <input type="text" class="form-control" id="ten_lop_hoc" name="ten_lop_hoc" value="<?php echo $data['lophoc']['ten_lop_hoc']; ?>" required>
    </div>

    <div class="mb-3">
        <label for="start_time_lop" class="form-label">Start Time</label>
        <input type="date" class="form-control" id="start_time_lop" name="start_time_lop" value="<?php echo date("Y-m-d", strtotime($data['lophoc']['start_time_lop'])) ?>" required>
    </div>

    <div class="mb-3">
        <label for="end_time_lop" class="form-label">End Time</label>
        <input type="date" class="form-control" id="end_time_lop" name="end_time_lop" value="<?php echo date("Y-m-d", strtotime($data['lophoc']['end_time_lop'])) ?>" required>
    </div>

    <div class="mb-3">
        <label for="status_id" class="form-label">Status</label>
        <select class="form-select" id="status_id" name="status_id">
            <option value="1" <?php echo $data['lophoc']['status_id'] == 1 ? 'selected' : ''; ?>>Active</option>
            <option value="0" <?php echo $data['lophoc']['status_id'] == 0 ? 'selected' : ''; ?>>Inactive</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="id_khoa_hoc" class="form-label">Course</label>
        <select class="form-select" id="id_khoa_hoc" name="id_khoa_hoc" required>
            <option value="">Select a course</option>
            <?php if (isset($data['khoahoc'])): ?>
                <?php foreach ($data['khoahoc'] as $item): ?>
                    <option value="<?php echo $item['id_khoa_hoc']; ?>"
                        <?php echo (isset($data['lophoc']) && $data['lophoc']['id_khoa_hoc'] == $item['id_khoa_hoc']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($item['ten_khoa_hoc']); ?>
                    </option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Update Class</button>
    <a href="index.php?controller=lophoc&action=index" class="btn btn-secondary">Cancel</a>

</form>