<?php
require_once('controllers/base_controller.php');
require_once('models/khoahoc.php');
require_once('models/lophoc.php');

class LopHocController extends BaseController
{
    function __construct()
    {
        $this->folder = 'lophoc';
    }
    public function index()
    {
        $lophoc = LopHoc::all();
        $data = $lophoc;
        $this->render('index', $data);
    }
    public function showLopHoc()
    {
        $lophoc = LopHoc::find($_GET['id_lop_hoc']);
        $data = $lophoc;
        $this->render('show', $data);
    }

    public function showAddLopHoc()
    {
        $khoahoc = KhoaHoc::all();
        $data = $khoahoc;
        $this->render('create', $data);
    }
    // coi lại
    public function showUpdateLopHoc()
    {
        $khoahoc = KhoaHoc::all();
        $lophoc = LopHoc::find($_GET['id_lop_hoc']);
        $data = array(
            'khoahoc' => $khoahoc,
            'lophoc' => $lophoc
        );
        $this->render('update', $data);
    }

    public function checkMaLopHoc()
    {
        if (isset($_GET['ma_lop_hoc'])) {
            $ma_lop_hoc = $_GET['ma_lop_hoc'];

            // Check if ma_lop_hoc already exists in db
            $db = DB::getInstance();
            $sql = 'SELECT COUNT(*) FROM lop_hoc WHERE ma_lop_hoc = :ma_lop_hoc';
            $req = $db->prepare($sql);
            $req->execute(['ma_lop_hoc' => $ma_lop_hoc]);
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

    public function addLopHoc()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ma_lop_hoc = $_POST['ma_lop_hoc'];
            $ten_lop_hoc = $_POST['ten_lop_hoc'];
            $start_time_lop = $_POST['start_time_lop'];
            $end_time_lop = $_POST['end_time_lop'];
            $status_id = $_POST['status_id'];
            $id_khoa_hoc  = $_POST['id_khoa_hoc'];

            $newLopHoc = new LopHoc();
            $newLopHoc->ma_lop_hoc = $ma_lop_hoc;
            $newLopHoc->ten_lop_hoc = $ten_lop_hoc;
            $newLopHoc->start_time_lop = $start_time_lop;
            $newLopHoc->end_time_lop = $end_time_lop;
            $newLopHoc->status_id = $status_id;
            $newLopHoc->id_khoa_hoc = $id_khoa_hoc;

            $newLopHoc->saveOrUpdate();

            header('Location: index.php?controller=lophoc&action=index&status=insert-success');
        } else {
            $this->render('create');
        }
    }

    public function updateLopHoc()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_lop_hoc = $_POST['id_lop_hoc'];
            $lophoc = LopHoc::find($id_lop_hoc);

            if ($lophoc) {
                $newLopHoc = new LopHoc();
                $newLopHoc->id_lop_hoc = $_POST['id_lop_hoc'];

                $newLopHoc->ma_lop_hoc = $_POST['ma_lop_hoc'];
                $newLopHoc->ten_lop_hoc = $_POST['ten_lop_hoc'];
                $newLopHoc->start_time_lop = $_POST['start_time_lop'];
                $newLopHoc->end_time_lop = $_POST['end_time_lop'];
                $newLopHoc->status_id = $_POST['status_id'];
                $newLopHoc->id_khoa_hoc = $_POST['id_khoa_hoc'];

                $newLopHoc->saveOrUpdate();

                header('Location: index.php?controller=lophoc&action=index&status=update-success');
                exit();
            } else {
                echo "Class not found.";
            }
        } else {
            $id_lop_hoc = $_GET['id_lop_hoc'];
            $lophoc = LopHoc::find($id_lop_hoc);

            if ($lophoc) {
                $data = $lophoc;
                $this->render('update', $data);
            } else {
                echo "Class not found.";
            }
        }
    }

    public function removeLopHoc()
    {
        if (isset($_GET['id_lop_hoc'])) {
            $id_lop_hoc = $_GET['id_lop_hoc'];

            $lophoc = LopHoc::find($id_lop_hoc);

            if ($lophoc) {
                $lophocToDelete = new LopHoc();
                $lophocToDelete->id_lop_hoc = $id_lop_hoc;

                if ($lophocToDelete->remove()) {
                    header('Location: index.php?controller=lophoc&action=index&status=delete-success');
                    exit();
                } else {
                    echo "Failed to delete class.";
                }
            } else {
                echo "Class not found.";
            }
        } else {
            echo "No class ID specified.";
        }
    }
}
