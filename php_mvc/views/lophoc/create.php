<div class="container mt-5">
    <h2>Add New Class</h2>
    <form action="index.php?controller=lophoc&action=addLopHoc" method="POST">
        <div class="mb-3">
            <label for="ma_lop_hoc" class="form-label">Class ID</label>
            <input type="text" class="form-control" id="ma_lop_hoc" name="ma_lop_hoc" required>
        </div>
        <div class="mb-3">
            <label for="ten_lop_hoc" class="form-label">Name</label>
            <input type="text" class="form-control" id="ten_lop_hoc" name="ten_lop_hoc" required>
        </div>
        <div class="mb-3">
            <label for="start_time_lop" class="form-label">Start Time Class</label>
            <input type="date" class="form-control" id="start_time_lop" name="start_time_lop" required>
        </div>
        <div class="mb-3">
            <label for="end_time_lop" class="form-label">End Time Class</label>
            <input type="date" class="form-control" id="end_time_lop" name="end_time_lop" required>
        </div>
        <div class="mb-3">
            <label for="status_id" class="form-label">Status</label>
            <select class="form-select" id="status_id" name="status_id" required>
                <option value="">Select status</option>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="id_khoa_hoc" class="form-label">Course</label>
            <select class="form-select" id="id_khoa_hoc" name="id_khoa_hoc" required>
                <option value="">Select a course</option>
                <?php foreach ($data as $item): ?>
                    <option value="<?php echo $item['id_khoa_hoc']; ?>">
                        <?php echo htmlspecialchars($item['ten_khoa_hoc']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Add Class</button>
        <a href="index.php?controller=lophoc&action=index" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    // AJAX check if ma_lop_hoc exists
    $('#ma_lop_hoc').blur(function() {
        var maLopHoc = $(this).val();

        // Check if the ma_lop_hoc is not empty
        if (maLopHoc) {
            $.ajax({
                url: 'index.php?controller=lophoc&action=checkMaLopHoc',
                method: 'GET',
                data: {
                    ma_lop_hoc: maLopHoc
                },
                success: function(response) {
                    if (response === 'exists') {
                        alert('Class ID already exists!');
                        $('#ma_lop_hoc').val('');
                    }
                },
                error: function() {
                    alert('An error occurred while checking the class ID.');
                }
            });
        }
    });
</script>