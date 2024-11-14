<?php
require_once('controllers/base_controller.php');
require_once('models/khoahoc.php');

class KhoaHocController extends BaseController
{
    function __construct()
    {
        $this->folder = 'khoahoc';
    }
    public function index()
    {
        $khoahoc = KhoaHoc::all();
        $this->render('index', $khoahoc);
    }
    public function showKhoaHoc()
    {
        $data = KhoaHoc::find($_GET['id_khoa_hoc']);
        $this->render('show', $data);
    }
    public function showAddKhoaHoc()
    {
        $this->render('create');
    }
    public function showUpdateKhoaHoc()
    {
        $data = KhoaHoc::find($_GET['id_khoa_hoc']);
        $this->render('update', $data);
    }
    public function checkMaKhoaHoc()
    {
        if (isset($_GET['ma_khoa_hoc'])) {
            if (KhoaHoc::checkId() > 0) {
                echo 'exists';
            } else {
                echo 'available';
            }
        } else {
            echo 'error';
        }
    }
    public function addKhoaHoc()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $newKhoaHoc = new KhoaHoc();

            $newKhoaHoc->saveOrUpdate([
                'ma_khoa_hoc' => $_POST['ma_khoa_hoc'],
                'ten_khoa_hoc' => $_POST['ten_khoa_hoc'],
                'ngay_bat_dau_kh' => $_POST['ngay_bat_dau_kh'],
                'ngay_ket_thuc_kh' => $_POST['ngay_ket_thuc_kh'],
                'status_id' => $_POST['status_id']
            ]);

            header('Location: index.php?controller=khoahoc&action=index&status=insert-success');
        } else {
            $this->render('create');
        }
    }

    public function updateKhoaHoc()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $khoahoc = KhoaHoc::find($_POST['id_khoa_hoc']);

            if ($khoahoc) {
                $newKhoaHoc = new KhoaHoc();

                $newKhoaHoc->saveOrUpdate([
                    'id_khoa_hoc' => $_POST['id_khoa_hoc'],
                    'ma_khoa_hoc' => $_POST['ma_khoa_hoc'],
                    'ten_khoa_hoc' => $_POST['ten_khoa_hoc'],
                    'ngay_bat_dau_kh' => $_POST['ngay_bat_dau_kh'],
                    'ngay_ket_thuc_kh' => $_POST['ngay_ket_thuc_kh'],
                    'status_id' => $_POST['status_id']
                ]);
                header("Location: index.php?controller=khoahoc&action=index&status=update-success");
                exit();
            } else {
                echo "Course not found.";
            }
        } else {
            $data = KhoaHoc::find($_GET['id_khoa_hoc']);
            if ($data) {
                $this->render('update', $data);
            } else {
                echo "Course not found.";
            }
        }
    }

    public function removeKhoaHoc()
    {
        if (isset($_GET['id_khoa_hoc'])) {
            if (KhoaHoc::find($_GET['id_khoa_hoc'])) {
                $khoahocToDelete = new KhoaHoc();

                if ($khoahocToDelete->remove([
                    'id_khoa_hoc' => $_GET['id_khoa_hoc']
                ])) {
                    header('Location: index.php?controller=khoahoc&action=index&status=delete-success');
                    exit();
                } else {
                    echo "Failed to delete course.";
                }
            } else {
                echo "Course not found.";
            }
        } else {
            echo "No course ID specified.";
        }
    }
}
