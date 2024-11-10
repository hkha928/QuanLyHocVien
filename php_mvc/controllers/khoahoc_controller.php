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
        $data = $khoahoc;
        $this->render('index', $khoahoc);
    }
    public function showKhoaHoc()
    {
        $khoahoc = KhoaHoc::find($_GET['id_khoa_hoc']);
        $data = $khoahoc;
        $this->render('show', $data);
    }
    public function showAddKhoaHoc()
    {
        $this->render('create');
    }
    public function showUpdateKhoaHoc()
    {
        $khoahoc = KhoaHoc::find($_GET['id_khoa_hoc']);
        $data = $khoahoc;
        $this->render('update', $data);
    }
    public function checkMaKhoaHoc()
    {
        if (isset($_GET['ma_khoa_hoc'])) {
            $ma_khoa_hoc = $_GET['ma_khoa_hoc'];

            $db = DB::getInstance();
            $sql = 'SELECT COUNT(*) FROM khoa_hoc WHERE ma_khoa_hoc = :ma_khoa_hoc';
            $req = $db->prepare($sql);
            $req->execute(['ma_khoa_hoc' => $ma_khoa_hoc]);
            $count = $req->fetchColumn();

            if ($count > 0) {
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
            $ma_khoa_hoc = $_POST['ma_khoa_hoc'];
            $ten_khoa_hoc = $_POST['ten_khoa_hoc'];
            $ngay_bat_dau_kh = $_POST['ngay_bat_dau_kh'];
            $ngay_ket_thuc_kh = $_POST['ngay_ket_thuc_kh'];
            $status_id = $_POST['status_id'];

            $newKhoaHoc = new KhoaHoc();
            $newKhoaHoc->ma_khoa_hoc = $ma_khoa_hoc;
            $newKhoaHoc->ten_khoa_hoc = $ten_khoa_hoc;
            $newKhoaHoc->ngay_bat_dau_kh = $ngay_bat_dau_kh;
            $newKhoaHoc->ngay_ket_thuc_kh = $ngay_ket_thuc_kh;
            $newKhoaHoc->status_id = $status_id;

            $newKhoaHoc->saveOrUpdate();

            header('Location: index.php?controller=khoahoc&action=index&status=insert-success');
        } else {
            $this->render('create');
        }
    }

    public function updateKhoaHoc()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_khoa_hoc = $_POST['id_khoa_hoc'];
            $khoahoc = KhoaHoc::find($id_khoa_hoc);

            if ($khoahoc) {
                $newKhoaHoc = new KhoaHoc();
                $newKhoaHoc->id_khoa_hoc = $_POST['id_khoa_hoc'];
                $newKhoaHoc->ma_khoa_hoc = $_POST['ma_khoa_hoc'];
                $newKhoaHoc->ten_khoa_hoc = $_POST['ten_khoa_hoc'];
                $newKhoaHoc->ngay_bat_dau_kh = $_POST['ngay_bat_dau_kh'];
                $newKhoaHoc->ngay_ket_thuc_kh = $_POST['ngay_ket_thuc_kh'];
                $newKhoaHoc->status_id = $_POST['status_id'];

                $newKhoaHoc->saveOrUpdate();
                header("Location: index.php?controller=khoahoc&action=index&status=update-success");
                exit();
            } else {
                echo "Course not found.";
            }
        } else {
            $id_khoa_hoc = $_GET['id_khoa_hoc'];
            $khoahoc = KhoaHoc::find($id_khoa_hoc);

            if ($khoahoc) {
                $data = $khoahoc;
                $this->render('update', $data);
            } else {
                echo "Course not found.";
            }
        }
    }

    public function removeKhoaHoc()
    {
        if (isset($_GET['id_khoa_hoc'])) {

            $id_khoa_hoc = $_GET['id_khoa_hoc'];


            $khoahoc = KhoaHoc::find($id_khoa_hoc);

            if ($khoahoc) {
                $khoahocToDelete = new KhoaHoc();
                $khoahocToDelete->id_khoa_hoc = $id_khoa_hoc;

                if ($khoahocToDelete->remove()) {
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
