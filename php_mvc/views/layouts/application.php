<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Document</title>
    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- bootstrap icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                        <li class="nav-item">
                            <a href="index.php" class="nav-link px-0 align-middle text-white">
                                <i class="fs-4 bi bi-house-fill"></i> <span class="d-none d-sm-inline">Student System</span>
                            </a>
                        </li>
                        <li>
                            <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                                <i class="fs-5 bi bi-people-fill"></i> <span class="ms-1 d-none d-sm-inline">Students</span>
                            </a>
                            <ul class="collapse nav flex-column" id="submenu1">
                                <li class="w-100">
                                    <a href="index.php?controller=hocvien&action=index" class="nav-link px-0"><span class="d-none d-sm-inline">List students</span></a>
                                </li>
                                <li class="w-100">
                                    <a href="index.php?controller=hocvien&action=showAddHocVien" class="nav-link px-0"><span class="d-none d-sm-inline">Add new student</span></a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#submenu2" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                                <i class="fs-5 bi bi-journal-code"></i> <span class="ms-1 d-none d-sm-inline">Classes</span>
                            </a>
                            <ul class="collapse nav flex-column" id="submenu2">
                                <li class="w-100">
                                    <a href="index.php?controller=lophoc&action=index" class="nav-link px-0"><span class="d-none d-sm-inline">List classes</span></a>
                                </li>
                                <li class="w-100">
                                    <a href="index.php?controller=lophoc&action=showAddLopHoc" class="nav-link px-0"><span class="d-none d-sm-inline">Add new class</span></a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#submenu3" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                                <i class="fs-5 bi bi-journals"></i> <span class="ms-1 d-none d-sm-inline">Courses</span>
                            </a>
                            <ul class="collapse nav flex-column" id="submenu3">
                                <li class="w-100">
                                    <a href="index.php?controller=khoahoc&action=index" class="nav-link px-0"><span class="d-none d-sm-inline">List courses</span></a>
                                </li>
                                <li class="w-100">
                                    <a href="index.php?controller=khoahoc&action=showAddKhoaHoc" class="nav-link px-0"><span class="d-none d-sm-inline">Add new course</span></a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <hr>
                    <div class="dropdown pb-4">
                        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle" style="font-size: 26px"></i>
                            <span class="d-none d-sm-inline mx-1">hkha</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                            <li><a href="#" class="dropdown-item">Profile</a></li>
                            <li><a href="#" class="dropdown-item">Settings</a></li>
                            <li>
                                <hr class="dorpdown-divider">
                            </li>
                            <li><a href="#" class="dropdown-item">Sign out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col py-3">
                <?= @$content ?>
            </div>
        </div>
    </div>
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Notification</strong>
                <small>Just now</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body" id="toastMessage">
                <!-- Dynamic message will be inserted here -->
            </div>
        </div>
    </div>

    <script>
        const toastLiveExample = document.getElementById('liveToast');
        const toastMessage = document.getElementById('toastMessage');
        const btnClose = document.getElementsByClassName('btn-close');

        document.addEventListener("DOMContentLoaded", () => {
            // Check for the 'status' URL parameter
            const urlParams = new URLSearchParams(window.location.search);
            const status = urlParams.get('status');

            // Set the message based on the status parameter
            if (status === 'update-success') {
                toastMessage.textContent = "Update successful!";
                const bgSuccess = toastLiveExample.classList.add('text-bg-success');
                const toastShow = new bootstrap.Toast(toastLiveExample).show();
            } else if (status === 'insert-success') {
                toastMessage.textContent = "Insert successful!";
                const bgSuccess = toastLiveExample.classList.add('text-bg-success');
                const toastShow = new bootstrap.Toast(toastLiveExample).show();

            } else if (status === 'delete-success') {
                toastMessage.textContent = "Delete successful!";
                const bgSuccess = toastLiveExample.classList.add('text-bg-success');
                const toastShow = new bootstrap.Toast(toastLiveExample).show();

            } else if (status === 'duplicate-error') {
                toastMessage.textContent = "Duplicate database!";
                const bgDanger = toastLiveExample.classList.add('text-bg-danger');
                const toastShow = new bootstrap.Toast(toastLiveExample).show();
            }
        });
    </script>


    <!-- bootstrap js bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>