<h2>List of Students</h2>
<!-- btn show list all -->
<?php if (isset($_GET['search']) && !empty($_GET['search'])): ?>
    <a href="index.php?controller=hocvien&action=index" class="btn btn-primary">List All</a>
<?php endif; ?>
<!-- Search Form -->
<form action="index.php" method="get" class="d-inline">
    <input type="hidden" name="controller" value="hocvien">
    <input type="hidden" name="action" value="index">

    <div class="input-group rounded" style="width: 400px; float: right; margin-bottom: 20px;">
        <input type="text" class="form-control rounded" placeholder="Search" aria-label="Search" name="search"
            value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>" />
        <button class="btn btn-primary rounded" type="submit">
            <i class="bi bi-search"></i> Search
        </button>
    </div>
</form>

<!-- Students Table -->
<table class="table table-striped table-responsive" id="tableId" style="width: 100%;">
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($data)) : ?>
            <?php foreach ($data as $item) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['ma_hoc_vien']); ?></td>
                    <td><?php echo htmlspecialchars($item['ten_hoc_vien']); ?></td>
                    <td><?php echo htmlspecialchars($item['email']); ?></td>
                    <td><?php echo htmlspecialchars($item['sdt']); ?></td>
                    <td>
                        <?php echo $item['status_id'] == 1 ? 'Active' : 'Inactive'; ?>
                    </td>
                    <td>
                        <!-- Edit and Delete Actions -->
                        <a class="text-decoration-none" href="index.php?controller=hocvien&action=showUpdateHocVien&id_hoc_vien=<?php echo $item['id_hoc_vien']; ?>">
                            <i class="bi bi-pencil-square" style="color: #0d6efd;"></i>
                        </a>
                        <a class="text-decoration-none" style="margin-left: 5px;" href="index.php?controller=hocvien&action=removeHocVien&id_hoc_vien=<?php echo $item['id_hoc_vien']; ?>"
                            onclick="return confirm('Are you sure you want to delete <?php echo htmlspecialchars($item['ten_hoc_vien']); ?>?');">
                            <i class="bi bi-trash-fill" style="color: #dc3545;"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="6" style="text-align: center;">No students found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>