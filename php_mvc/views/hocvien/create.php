<div class="container mt-5">
    <h2>Add New Student</h2>
    <form action="index.php?controller=hocvien&action=addHocVien" method="POST">
        <div class="mb-3">
            <label for="ma_hoc_vien" class="form-label">Student ID</label>
            <input type="text" class="form-control" id="ma_hoc_vien" name="ma_hoc_vien" required>
        </div>
        <div class="mb-3">
            <label for="ten_hoc_vien" class="form-label">Name</label>
            <input type="text" class="form-control" id="ten_hoc_vien" name="ten_hoc_vien" required>
        </div>
        <div class="mb-3">
            <label for="ngay_sinh" class="form-label">Date of Birth</label>
            <input type="date" class="form-control" id="ngay_sinh" name="ngay_sinh" required>
        </div>
        <div class="mb-3">
            <label for="sdt" class="form-label">Phone Number</label>
            <input type="text" class="form-control" id="sdt" name="sdt" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="status_id" class="form-label">Status</label>
            <select class="form-select" id="status_id" name="status_id" required>
                <option value="">Select status</option>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Add Student</button>
        <a href="index.php?controller=hocvien&action=index" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    // AJAX check if ma_hoc_vien exists
    $('#ma_hoc_vien').blur(function() {
        var maHocVien = $(this).val();

        // Check if the ma_hoc_vien is not empty
        if (maHocVien) {
            $.ajax({
                url: 'index.php?controller=hocvien&action=checkMaHocVien',
                method: 'GET',
                data: {
                    ma_hoc_vien: maHocVien
                },
                success: function(response) {
                    if (response === 'exists') {
                        alert('Student ID already exists!');
                        $('#ma_hoc_vien').val('');
                    }
                },
                error: function() {
                    alert('An error occurred while checking the student ID.');
                }
            });
        }
    });
</script>