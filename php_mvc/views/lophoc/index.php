<h2>List Classes</h2>
<table class="table table-striped table-responsive" id="tableId" style="width: 100%;">
    <thead>
        <tr>
            <th>Class Id</th>
            <th>Class Name</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Status</th>
            <th>Id Course</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $item): ?>
            <tr>
                <td><?php echo htmlspecialchars($item['ma_lop_hoc']); ?></td>
                <td><?php echo htmlspecialchars($item['ten_lop_hoc']); ?></td>
                <td><?php echo htmlspecialchars($item['start_time_lop']); ?></td>
                <td><?php echo htmlspecialchars($item['end_time_lop']); ?></td>
                <td><?php
                    if ($item['status_id'] == 1) {
                        echo "Active";
                    } else if ($item['status_id'] == 0) {
                        echo "Inactive";
                    } else
                        echo htmlspecialchars($item['status_id']); ?></td>

                <td><?php echo htmlspecialchars($item['id_khoa_hoc']); ?></td>
                <td>
                    <a class="text-decoration-none" href="index.php?controller=lophoc&action=showUpdateLopHoc&id_lop_hoc=<?php echo $item['id_lop_hoc']; ?>">
                        <i class="bi bi-pencil-square" style="color: #0d6efd;"></i>
                    </a>
                    <a class="text-decoration-none" style="margin-left: 5px;" href="index.php?controller=lophoc&action=removeLopHoc&id_lop_hoc=<?php echo $item['id_lop_hoc']; ?>"
                        onclick="return confirm('Bạn có chắc chắn muốn xóa lớp <?php echo $item['ten_lop_hoc'] ?> không?');">
                        <i class="bi bi-trash-fill" style="color: #dc3545;"></i>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>