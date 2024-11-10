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
        $db = DB::getInstance();
        $sql = 'SELECT * FROM ' . self::$tableName;
        $req = $db->query($sql);
        $list = $req->fetchAll();
        return $list;
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
    /*public function save()
    {
        $db = DB::getInstance();

        // Prepare the SQL statement to insert the new record
        $sql = 'INSERT INTO ' . self::$tableName . '(ma_hoc_vien, ten_hoc_vien, ngay_sinh, sdt, email, status_id) 
                                VALUES (:ma_hoc_vien, :ten_hoc_vien, :ngay_sinh, :sdt, :email, :status_id)';
        $req = $db->prepare($sql);

        // Execute the statement with the values of the object
        $req->execute(array(
            'ma_hoc_vien' => $this->ma_hoc_vien,
            'ten_hoc_vien' => $this->ten_hoc_vien,
            'ngay_sinh' => $this->ngay_sinh,
            'sdt' => $this->sdt,
            'email' => $this->email,
            'status_id' => $this->status_id
        ));

        // Check if the insert was successful (you can also handle the result accordingly)
        if ($req->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function update()
    {
        $db = DB::getInstance();
        $sql = 'UPDATE ' . self::$tableName . ' SET 
                                ma_hoc_vien = :ma_hoc_vien, 
                                ten_hoc_vien = :ten_hoc_vien, 
                                ngay_sinh = :ngay_sinh, 
                                sdt = :sdt, 
                                email = :email, 
                                status_id = :status_id 
                                WHERE id_hoc_vien = :id_hoc_vien';
        // Prepare the update query
        $req = $db->prepare($sql);
        //dd($req);
        // Execute the update with the current object's values
        $req->execute(array(
            'ma_hoc_vien' => $this->ma_hoc_vien,
            'ten_hoc_vien' => $this->ten_hoc_vien,
            'ngay_sinh' => $this->ngay_sinh,
            'sdt' => $this->sdt,
            'email' => $this->email,
            'status_id' => $this->status_id,
            'id_hoc_vien' => $this->id_hoc_vien
        ));
        //dd($req);
        return $req->rowCount() > 0;  // Check if the update was successful
    }*/
    public function saveOrUpdate()
    {

        try {
            $db = DB::getInstance();

            if (isset($this->id_hoc_vien)) {

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
                    'ma_hoc_vien' => $this->ma_hoc_vien,
                    'ten_hoc_vien' => $this->ten_hoc_vien,
                    'ngay_sinh' => $this->ngay_sinh,
                    'sdt' => $this->sdt,
                    'email' => $this->email,
                    'status_id' => $this->status_id,
                    'id_hoc_vien' => $this->id_hoc_vien
                ));
            } else {
                $sql = 'INSERT INTO ' . self::$tableName . '(ma_hoc_vien, ten_hoc_vien, ngay_sinh, sdt, email, status_id) 
                                VALUES (:ma_hoc_vien, :ten_hoc_vien, :ngay_sinh, :sdt, :email, :status_id)';
                $req = $db->prepare($sql);

                $req->execute(array(
                    'ma_hoc_vien' => $this->ma_hoc_vien,
                    'ten_hoc_vien' => $this->ten_hoc_vien,
                    'ngay_sinh' => $this->ngay_sinh,
                    'sdt' => $this->sdt,
                    'email' => $this->email,
                    'status_id' => $this->status_id
                ));
            }
            return $req->rowCount() > 0;
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            return false;
        }
    }
    public function remove()
    {
        if (!isset($this->id_hoc_vien)) {
            return false; // If there's no ID, there's nothing to delete
        }

        try {
            $db = DB::getInstance();
            $sql = 'DELETE FROM ' . self::$tableName . ' WHERE id_hoc_vien = :id_hoc_vien';
            $req = $db->prepare($sql);
            $req->execute(array('id_hoc_vien' => $this->id_hoc_vien));

            return $req->rowCount() > 0; // Return true if a row was deleted
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            return false; // Return false if there was an error
        }
    }
}
