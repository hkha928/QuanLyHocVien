<h2>List Courses</h2>
<table class="table table-striped table-responsive" id="tableId" style="width: 100%;">
    <thead>
        <tr>
            <th>Id</th>
            <th>Course Name</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $item): ?>
            <tr>
                <td><?php echo htmlspecialchars($item['ma_khoa_hoc']); ?></td>
                <td><?php echo htmlspecialchars($item['ten_khoa_hoc']); ?></td>
                <td><?php echo htmlspecialchars($item['ngay_bat_dau_kh']); ?></td>
                <td><?php echo htmlspecialchars($item['ngay_ket_thuc_kh']); ?></td>
                <td><?php
                    if ($item['status_id'] == 1) {
                        echo "Active";
                    } else if ($item['status_id'] == 0) {
                        echo "Inactive";
                    } else
                        echo htmlspecialchars($item['status_id']); ?></td>
                <td>
                    <a class="text-decoration-none" href="index.php?controller=khoahoc&action=showUpdateKhoaHoc&id_khoa_hoc=<?php echo $item['id_khoa_hoc']; ?>">
                        <i class="bi bi-pencil-square" style="color: #0d6efd;"></i>
                    </a>
                    <a class="text-decoration-none" style="margin-left: 5px;" href="index.php?controller=khoahoc&action=removeKhoaHoc&id_khoa_hoc=<?php echo $item['id_khoa_hoc']; ?>"
                        onclick="return confirm('Bạn có chắc chắn muốn xóa <?php echo $item['ten_khoa_hoc'] ?> không?');">
                        <i class="bi bi-trash-fill" style="color: #dc3545;"></i>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>