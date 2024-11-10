<div class="container mt-5">
    <h2>Add New Course</h2>
    <form action="index.php?controller=khoahoc&action=addKhoaHoc" method="POST">
        <div class="mb-3">
            <label for="ma_khoa_hoc" class="form-label">Course ID</label>
            <input type="text" class="form-control" id="ma_khoa_hoc" name="ma_khoa_hoc" required>
        </div>
        <div class="mb-3">
            <label for="ten_khoa_hoc" class="form-label">Name</label>
            <input type="text" class="form-control" id="ten_khoa_hoc" name="ten_khoa_hoc" required>
        </div>
        <div class="mb-3">
            <label for="ngay_bat_dau_kh" class="form-label">Start Date</label>
            <input type="date" class="form-control" id="ngay_bat_dau_kh" name="ngay_bat_dau_kh" required>
        </div>
        <div class="mb-3">
            <label for="ngay_ket_thuc_kh" class="form-label">End Date</label>
            <input type="date" class="form-control" id="ngay_ket_thuc_kh" name="ngay_ket_thuc_kh" required>
        </div>
        <div class="mb-3">
            <label for="status_id" class="form-label">Status</label>
            <select class="form-select" id="status_id" name="status_id" required>
                <option value="">Select status</option>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Add Course</button>
        <a href="index.php?controller=khoahoc&action=index" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $('#ma_khoa_hoc').blur(function() {
        var maKhoaHoc = $(this).val();

        if (maKhoaHoc) {
            $.ajax({
                url: 'index.php?controller=khoahoc&action=checkMaKhoaHoc',
                method: 'GET',
                data: {
                    ma_khoa_hoc: maKhoaHoc
                },
                success: function(response) {
                    if (response === 'exists') {
                        alert('Course ID already exists!');
                        $('#ma_khoa_hoc').val('');
                    }
                },
                error: function() {
                    alert('An error occurred while checking the Course ID.');
                }
            });
        }
    });
</script>