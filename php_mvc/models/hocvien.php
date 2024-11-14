<?php
class HocVien
{
    static $tableName = 'hoc_vien';
    public $id_hoc_vien;
    public $ma_hoc_vien;
    public $ten_hoc_vien;
    public $ngay_sinh;
    public $sdt;
    public $email;
    public $status_id;

    function __construct() {}

    static function all($params = array())
    {
        // dd($params);
        $db = DB::getInstance();
        $sql = 'SELECT * FROM ' . self::$tableName;
        if (isset($params['search'])) {
            $searchValue = $params['search'];
            $sql .= " WHERE ma_hoc_vien LIKE :search OR ten_hoc_vien LIKE :search OR sdt LIKE :search OR email LIKE :search";
            $params = [':search' => "%$searchValue%"];
            $req = $db->prepare($sql);
            $req->execute($params);
        } else {
            $req = $db->prepare($sql);
            $req->execute();
        }

        return $req->fetchAll();
    }

    public static function checkId()
    {
        $db = DB::getInstance();
        $sql = 'SELECT COUNT(*) FROM hoc_vien WHERE ma_hoc_vien = :ma_hoc_vien';
        $req = $db->prepare($sql);
        $req->execute(['ma_hoc_vien' => $_GET['ma_hoc_vien']]);
        return $req->fetchColumn();
    }

    public static function find($id_hoc_vien)
    {
        $db = DB::getInstance();
        $sql = 'SELECT * FROM ' . self::$tableName . ' WHERE id_hoc_vien = :id_hoc_vien';
        $req = $db->prepare($sql);
        $req->setFetchMode(PDO::FETCH_ASSOC);
        $req->execute(array('id_hoc_vien' => $id_hoc_vien));

        $item = $req->fetch();

        if (isset($item['id_hoc_vien'])) {
            return $item;
        }
        return null;
    }

    public function saveOrUpdate($params = array())
    {
        try {
            $db = DB::getInstance();

            if (isset($params['id_hoc_vien'])) {
                $sql = 'UPDATE ' . self::$tableName . ' SET 
                            ma_hoc_vien = :ma_hoc_vien, 
                            ten_hoc_vien = :ten_hoc_vien, 
                            ngay_sinh = :ngay_sinh, 
                            sdt = :sdt, 
                            email = :email, 
                            status_id = :status_id 
                        WHERE id_hoc_vien = :id_hoc_vien';

                $req = $db->prepare($sql);

                $req->execute(array(
                    'ma_hoc_vien' => $params['ma_hoc_vien'],
                    'ten_hoc_vien' => $params['ten_hoc_vien'],
                    'ngay_sinh' => $params['ngay_sinh'],
                    'sdt' => $params['sdt'],
                    'email' => $params['email'],
                    'status_id' => $params['status_id'],
                    'id_hoc_vien' => $params['id_hoc_vien']
                ));
            } else {
                $sql = 'INSERT INTO ' . self::$tableName . '(ma_hoc_vien, ten_hoc_vien, ngay_sinh, sdt, email, status_id) 
                                VALUES (:ma_hoc_vien, :ten_hoc_vien, :ngay_sinh, :sdt, :email, :status_id)';

                $req = $db->prepare($sql);

                $req->execute(array(
                    'ma_hoc_vien' => $params['ma_hoc_vien'],
                    'ten_hoc_vien' => $params['ten_hoc_vien'],
                    'ngay_sinh' => $params['ngay_sinh'],
                    'sdt' => $params['sdt'],
                    'email' => $params['email'],
                    'status_id' => $params['status_id']
                ));
            }
            return $req->rowCount() > 0;
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            return false;
        }
    }
    public function remove($params = array())
    {
        if (!isset($params['id_hoc_vien'])) {
            return false;
        }

        try {
            $db = DB::getInstance();
            $sql = 'DELETE FROM ' . self::$tableName . ' WHERE id_hoc_vien = :id_hoc_vien';
            $req = $db->prepare($sql);
            $req->execute(array('id_hoc_vien' => $params['id_hoc_vien']));

            return $req->rowCount() > 0;
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            return false;
        }
    }
}
