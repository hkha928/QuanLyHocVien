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
        $data = LopHoc::all();
        $this->render('index', $data);
    }
    public function showLopHoc()
    {
        $data = LopHoc::find($_GET['id_lop_hoc']);
        $this->render('show', $data);
    }

    public function showAddLopHoc()
    {
        $data = KhoaHoc::all();
        $this->render('create', $data);
    }
    // coi lại
    public function showUpdateLopHoc()
    {
        $data = array(
            'khoahoc' => KhoaHoc::all(),
            'lophoc' => LopHoc::find($_GET['id_lop_hoc'])
        );
        $this->render('update', $data);
    }

    public function checkMaLopHoc()
    {
        if (isset($_GET['ma_lop_hoc'])) {
            if (LopHoc::checkId() > 0) {
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
            $newLopHoc = new LopHoc();

            $newLopHoc->saveOrUpdate([
                'ma_lop_hoc' => $_POST['ma_lop_hoc'],
                'ten_lop_hoc' => $_POST['ten_lop_hoc'],
                'start_time_lop' => $_POST['start_time_lop'],
                'end_time_lop' => $_POST['end_time_lop'],
                'status_id' => $_POST['status_id'],
                'id_khoa_hoc' => $_POST['id_khoa_hoc']
            ]);

            header('Location: index.php?controller=lophoc&action=index&status=insert-success');
        } else {
            $this->render('create');
        }
    }

    public function updateLopHoc()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (LopHoc::find($_POST['id_lop_hoc'])) {
                $newLopHoc = new LopHoc();

                $newLopHoc->saveOrUpdate([
                    'id_lop_hoc' => $_POST['id_lop_hoc'],
                    'ma_lop_hoc' => $_POST['ma_lop_hoc'],
                    'ten_lop_hoc' => $_POST['ten_lop_hoc'],
                    'start_time_lop' => $_POST['start_time_lop'],
                    'end_time_lop' => $_POST['end_time_lop'],
                    'status_id' => $_POST['status_id'],
                    'id_khoa_hoc' => $_POST['id_khoa_hoc']
                ]);

                header('Location: index.php?controller=lophoc&action=index&status=update-success');
                exit();
            } else {
                echo "Class not found.";
            }
        } else {
            $data = LopHoc::find($_GET['id_lop_hoc']);

            if ($data) {
                $this->render('update', $data);
            } else {
                echo "Class not found.";
            }
        }
    }

    public function removeLopHoc()
    {
        if (isset($_GET['id_lop_hoc'])) {
            if (LopHoc::find($_GET['id_lop_hoc'])) {
                $lophocToDelete = new LopHoc();

                if ($lophocToDelete->remove([
                    'id_lop_hoc' => $_GET['id_lop_hoc']
                ])) {
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
