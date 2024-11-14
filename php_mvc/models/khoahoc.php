<?php
class KhoaHoc
{
    static $tableName = 'khoa_hoc';
    public $id_khoa_hoc;
    public $ma_khoa_hoc;
    public $ten_khoa_hoc;
    public $ngay_bat_dau_kh;
    public $ngay_ket_thuc_kh;
    public $status_id;

    function __construct() {}

    static function all($params = array())
    {
        $db = DB::getInstance();
        $sql = 'SELECT * FROM ' . self::$tableName;
        $req = $db->query($sql);
        $list = $req->fetchAll();
        return $list;
    }
    static function checkId()
    {
        $db = DB::getInstance();
        $sql = 'SELECT COUNT(*) FROM khoa_hoc WHERE ma_khoa_hoc = :ma_khoa_hoc';
        $req = $db->prepare($sql);
        $req->execute(['ma_khoa_hoc' => $_GET['ma_khoa_hoc']]);
        return $req->fetchColumn();
    }

    static function find($id_khoa_hoc)
    {
        $db = DB::getInstance();
        $sql = 'SELECT * FROM ' . self::$tableName . ' WHERE id_khoa_hoc = :id_khoa_hoc';
        $req = $db->prepare($sql);
        $req->setFetchMode(PDO::FETCH_ASSOC);
        $req->execute(array('id_khoa_hoc' => $id_khoa_hoc));

        $item = $req->fetch();

        if (isset($item['id_khoa_hoc'])) {
            return $item;
        }
        return null;
    }
    public function saveOrUpdate($params = array())
    {
        try {
            $db = DB::getInstance();
            if (isset($params['id_khoa_hoc'])) {
                $sql = 'UPDATE ' . self::$tableName . ' SET
                            ma_khoa_hoc = :ma_khoa_hoc,
                            ten_khoa_hoc = :ten_khoa_hoc,
                            ngay_bat_dau_kh = :ngay_bat_dau_kh,
                            ngay_ket_thuc_kh = :ngay_ket_thuc_kh,
                            status_id = :status_id
                        WHERE id_khoa_hoc = :id_khoa_hoc';
                $req = $db->prepare($sql);

                $req->execute(array(
                    'ma_khoa_hoc' => $params['ma_khoa_hoc'],
                    'ten_khoa_hoc' => $params['ten_khoa_hoc'],
                    'ngay_bat_dau_kh' => $params['ngay_bat_dau_kh'],
                    'ngay_ket_thuc_kh' => $params['ngay_ket_thuc_kh'],
                    'status_id' => $params['status_id'],
                    'id_khoa_hoc' => $params['id_khoa_hoc']
                ));
            } else {
                $sql = 'INSERT INTO ' . self::$tableName . '(ma_khoa_hoc, ten_khoa_hoc, ngay_bat_dau_kh, ngay_ket_thuc_kh, status_id)
                                VALUES (:ma_khoa_hoc, :ten_khoa_hoc, :ngay_bat_dau_kh, :ngay_ket_thuc_kh, :status_id)';
                $req = $db->prepare($sql);

                $req->execute(array(
                    'ma_khoa_hoc' => $params['ma_khoa_hoc'],
                    'ten_khoa_hoc' => $params['ten_khoa_hoc'],
                    'ngay_bat_dau_kh' => $params['ngay_bat_dau_kh'],
                    'ngay_ket_thuc_kh' => $params['ngay_ket_thuc_kh'],
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
        if (!isset($params['id_khoa_hoc'])) {
            return false;
        }
        try {
            $db = DB::getInstance();
            $sql = 'DELETE FROM ' . self::$tableName . ' WHERE id_khoa_hoc = :id_khoa_hoc';
            $req = $db->prepare($sql);
            $req->execute(array('id_khoa_hoc' => $params['id_khoa_hoc']));

            return $req->rowCount() > 0;
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            return false;
        }
    }
}
