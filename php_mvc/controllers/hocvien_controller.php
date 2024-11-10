<?php
require_once('controllers/base_controller.php');
require_once('models/hocvien.php');

class HocVienController extends BaseController
{
    function __construct()
    {
        $this->folder = 'hocvien';
    }
    public function listStudents()
    {
        $db = DB::getInstance();

        $query = "SELECT * FROM hoc_vien";
        $params = [];

        // Check if a search value is provided
        if (isset($_GET['search']) && !empty($_GET['search'])) {
            $searchValue = $_GET['search'];
            $query .= " WHERE ma_hoc_vien LIKE :search OR ten_hoc_vien LIKE :search OR sdt LIKE :search OR email LIKE :search";
            $params = [':search' => "%$searchValue%"];
        }

        try {
            // Prepare and execute the query
            $req = $db->prepare($query);
            $req->execute($params);

            // Fetch results as an associative array
            $hocvien = $req->fetchAll();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            $hocvien = [];
        }

        // Pass data to the view
        $this->render('index', $hocvien);
    }

    // Main index function that either displays all students or redirects to listStudents
    public function index()
    {
        if (isset($_GET['search']) && !empty($_GET['search'])) {
            $this->listStudents(); // Call listStudents to apply the search
        } else {
            // Get all students if no search is provided
            $hocvien = HocVien::all();
            $data = $hocvien;
            $this->render('index', $data);
        }
    }
    /*public function index()
    {
        $hocvien = HocVien::all();
        $data = $hocvien;
        $this->render('index', $data);
    }*/

    public function showHocVien()
    {
        $hocvien = HocVien::find($_GET['id_hoc_vien']);
        $data = $hocvien;
        $this->render('show', $data);
    }

    public function showAddHocVien()
    {
        $this->render('create');
    }

    public function showUpdateHocVien()
    {
        $hocvien = HocVien::find($_GET['id_hoc_vien']);
        $data = array('hocvien' => $hocvien);
        $this->render('update', $data);
    }

    public function checkMaHocVien()
    {
        if (isset($_GET['ma_hoc_vien'])) {
            $ma_hoc_vien = $_GET['ma_hoc_vien'];

            // Check if ma_hoc_vien already exists in db
            $db = DB::getInstance();
            $sql = 'SELECT COUNT(*) FROM hoc_vien WHERE ma_hoc_vien = :ma_hoc_vien';
            $req = $db->prepare($sql);
            $req->execute(['ma_hoc_vien' => $ma_hoc_vien]);
            $count = $req->fetchColumn();

            if ($count > 0) {
                echo 'exists'; // Student ID already exists
            } else {
                echo 'available'; // Student ID is available
            }
        } else {
            echo 'error'; // Error handling if no student ID is provided
        }
    }

    public function addHocVien()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get data from the POST request
            $ma_hoc_vien = $_POST['ma_hoc_vien'];
            $ten_hoc_vien = $_POST['ten_hoc_vien'];
            $ngay_sinh = $_POST['ngay_sinh'];
            $sdt = $_POST['sdt'];
            $email = $_POST['email'];
            $status_id = $_POST['status_id'];

            // Create a new HocVien object and save it
            $newHocVien = new HocVien();
            $newHocVien->ma_hoc_vien = $ma_hoc_vien;
            $newHocVien->ten_hoc_vien = $ten_hoc_vien;
            $newHocVien->ngay_sinh = $ngay_sinh;
            $newHocVien->sdt = $sdt;
            $newHocVien->email = $email;
            $newHocVien->status_id = $status_id;

            // Save to the database
            $newHocVien->saveOrUpdate();

            // Redirect to the list of students
            header('Location: index.php?controller=hocvien&action=index&status=insert-success');
        } else {
            // If not a POST request, just render the add form
            $this->render('create');
        }
    }

    public function updateHocVien()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get the ID of the student to be updated
            $id_hoc_vien = $_POST['id_hoc_vien'];
            // Find the existing HocVien object by ID
            $hocvien = HocVien::find($id_hoc_vien);

            if ($hocvien) {
                $newHocVien = new HocVien();
                $newHocVien->id_hoc_vien = $_POST['id_hoc_vien'];
                // Update the HocVien properties with new data from the form
                $newHocVien->ma_hoc_vien = $_POST['ma_hoc_vien'];
                $newHocVien->ten_hoc_vien = $_POST['ten_hoc_vien'];
                $newHocVien->ngay_sinh = $_POST['ngay_sinh'];
                $newHocVien->sdt = $_POST['sdt'];
                $newHocVien->email = $_POST['email'];
                $newHocVien->status_id = $_POST['status_id'];
                // Save the updated details to the database
                $newHocVien->saveOrUpdate();
                // Redirect to the list of students after updating
                header('Location: index.php?controller=hocvien&action=index&status=update-success');
                exit();
            } else {
                echo "Student not found.";
            }
        } else {
            // For a GET request, display the update form with the current student details
            $id_hoc_vien = $_GET['id_hoc_vien'];
            $hocvien = HocVien::find($id_hoc_vien);

            if ($hocvien) {
                $data = $hocvien;
                $this->render('update', $data);
            } else {
                echo "Student not found.";
            }
        }
    }

    public function removeHocVien()
    {
        if (isset($_GET['id_hoc_vien'])) {
            // Get the ID of the student to be removed
            $id_hoc_vien = $_GET['id_hoc_vien'];

            // Find the HocVien object by ID
            $hocvien = HocVien::find($id_hoc_vien);

            if ($hocvien) {
                // Create a HocVien instance to call remove method
                $hocvienToDelete = new HocVien();
                $hocvienToDelete->id_hoc_vien = $id_hoc_vien;

                // Attempt to delete the student from the database
                if ($hocvienToDelete->remove()) {
                    // Redirect to the list of students with success status
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
