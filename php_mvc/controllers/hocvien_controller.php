<?php
require_once('controllers/base_controller.php');
require_once('models/hocvien.php');

class HocVienController extends BaseController
{
    function __construct()
    {
        $this->folder = 'hocvien';
    }

    public function index()
    {
        if (isset($_GET['search']) && $_GET['search'] != "") {
            $search = array('search' => $_GET['search']);
            $data = HocVien::all($search);
        } else {
            $data = HocVien::all();
        }
        $this->render('index', $data);
    }

    public function showHocVien()
    {
        $data = HocVien::find($_GET['id_hoc_vien']);
        $this->render('show', $data);
    }

    public function showAddHocVien()
    {
        $this->render('create');
    }

    public function showUpdateHocVien()
    {
        $hocvien = HocVien::find($_GET['id_hoc_vien']);
        $this->render('update', array('hocvien' => $hocvien));
    }

    public function checkMaHocVien()
    {
        if (isset($_GET['ma_hoc_vien'])) {
            if (HocVien::checkId() > 0) {
                echo 'exists'; // Student ID already exists
            } else {
                echo 'available'; // Student ID is available
            }
        } else {
            echo 'error';
        }
    }

    public function addHocVien()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $newHocVien = new HocVien();

            $newHocVien->saveOrUpdate([
                'ma_hoc_vien' => $_POST['ma_hoc_vien'],
                'ten_hoc_vien' => $_POST['ten_hoc_vien'],
                'ngay_sinh' => $_POST['ngay_sinh'],
                'sdt' => $_POST['sdt'],
                'email' => $_POST['email'],
                'status_id' => $_POST['status_id']
            ]);

            header('Location: index.php?controller=hocvien&action=index&status=insert-success');
        } else {
            $this->render('create');
        }
    }

    public function updateHocVien()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (HocVien::find($_POST['id_hoc_vien'])) {
                $newHocVien = new HocVien();

                $newHocVien->saveOrUpdate([
                    'id_hoc_vien' => $_POST['id_hoc_vien'],
                    'ma_hoc_vien' => $_POST['ma_hoc_vien'],
                    'ten_hoc_vien' => $_POST['ten_hoc_vien'],
                    'ngay_sinh' => $_POST['ngay_sinh'],
                    'sdt' => $_POST['sdt'],
                    'email' => $_POST['email'],
                    'status_id' => $_POST['status_id']
                ]);


                header('Location: index.php?controller=hocvien&action=index&status=update-success');
                exit();
            } else {
                echo "Student not found.";
            }
        } else {
            $data = HocVien::find($_GET['id_hoc_vien']);
            if ($data) {
                $this->render('update', $data);
            } else {
                echo "Student not found.";
            }
        }
    }

    public function removeHocVien()
    {
        if (isset($_GET['id_hoc_vien'])) {
            if (HocVien::find($_GET['id_hoc_vien'])) {
                $hocvienToDelete = new HocVien();

                if ($hocvienToDelete->remove([
                    'id_hoc_vien' => $_GET['id_hoc_vien']
                ])) {
                    header('Location: index.php?controller=hocvien&action=index&status=delete-success');
                    exit();
                } else {
                    echo "Failed to delete student.";
                }
            } else {
                echo "Student not found.";
            }
        } else {
            echo "No student ID specified.";
        }
    }
}
