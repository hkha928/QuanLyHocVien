<?php
class LopHoc
{
    static $tableName = 'lop_hoc';
    public $id_lop_hoc;
    public $ma_lop_hoc;
    public $ten_lop_hoc;
    public $start_time_lop;
    public $end_time_lop;
    public $status_id;
    public $id_khoa_hoc;

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
        $sql = 'SELECT COUNT(*) FROM lop_hoc WHERE ma_lop_hoc = :ma_lop_hoc';
        $req = $db->prepare($sql);
        $req->execute(['ma_lop_hoc' => $_GET['ma_lop_hoc']]);
        return $req->fetchColumn();
    }

    public static function find($id_lop_hoc)
    {
        $db = DB::getInstance();
        $sql = 'SELECT * FROM ' . self::$tableName . ' WHERE id_lop_hoc = :id_lop_hoc';
        $req = $db->prepare($sql);
        $req->setFetchMode(PDO::FETCH_ASSOC);
        $req->execute(array('id_lop_hoc' => $id_lop_hoc));

        $item = $req->fetch();

        if (isset($item['id_lop_hoc'])) {
            return $item;
        }
        return null;
    }

    public function saveOrUpdate($params = array())
    {
        try {
            $db = DB::getInstance();

            if (isset($params['id_lop_hoc'])) {
                $sql = 'UPDATE ' . self::$tableName . ' SET 
                            ma_lop_hoc = :ma_lop_hoc, 
                            ten_lop_hoc = :ten_lop_hoc, 
                            start_time_lop = :start_time_lop, 
                            end_time_lop = :end_time_lop,
                            status_id = :status_id,
                            id_khoa_hoc = :id_khoa_hoc
                        WHERE id_lop_hoc = :id_lop_hoc';

                $req = $db->prepare($sql);

                $req->execute(array(
                    'ma_lop_hoc' => $params['ma_lop_hoc'],
                    'ten_lop_hoc' => $params['ten_lop_hoc'],
                    'start_time_lop' => $params['start_time_lop'],
                    'end_time_lop' => $params['end_time_lop'],
                    'status_id' => $params['status_id'],
                    'id_khoa_hoc' => $params['id_khoa_hoc'],
                    'id_lop_hoc' => $params['id_lop_hoc']
                ));
            } else {
                $sql = 'INSERT INTO ' . self::$tableName . ' (ma_lop_hoc, ten_lop_hoc, start_time_lop, end_time_lop, status_id, id_khoa_hoc) 
                                VALUES (:ma_lop_hoc, :ten_lop_hoc, :start_time_lop, :end_time_lop, :status_id, :id_khoa_hoc)';
                $req = $db->prepare($sql);

                $req->execute(array(
                    'ma_lop_hoc' => $params['ma_lop_hoc'],
                    'ten_lop_hoc' => $params['ten_lop_hoc'],
                    'start_time_lop' => $params['start_time_lop'],
                    'end_time_lop' => $params['end_time_lop'],
                    'status_id' => $params['status_id'],
                    'id_khoa_hoc' => $params['id_khoa_hoc']
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
        if (!isset($params['id_lop_hoc'])) {
            return false;
        }

        try {
            $db = DB::getInstance();
            $sql = 'DELETE FROM ' . self::$tableName . ' WHERE id_lop_hoc = :id_lop_hoc';
            $req = $db->prepare($sql);
            $req->execute(array('id_lop_hoc' => $params['id_lop_hoc']));

            return $req->rowCount() > 0;
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            return false;
        }
    }
}
