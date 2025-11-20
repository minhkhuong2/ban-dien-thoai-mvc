<?php
// File: app/core/Database.php

/*
 * Lớp Database (Core)
 * Kết nối và thực thi truy vấn bằng PDO
 */
class Database
{
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;

    public $dbh; // Database Handler (Bộ xử lý)
    private $stmt; // Statement (Câu lệnh)
    private $error;

    public function __construct()
    {
        // Cấu hình DSN (Data Source Name)
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
        ];

        // Tạo PDO instance
        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    // Chuẩn bị câu lệnh
    public function query($sql)
    {
        $this->stmt = $this->dbh->prepare($sql);
    }

    // Gán giá trị (bind value)
    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    // Thực thi câu lệnh đã chuẩn bị
    public function execute()
    {
        return $this->stmt->execute();
    }

    // Lấy tất cả kết quả (dạng mảng)
    public function resultSet()
    {
        $this->execute();
        return $this->stmt->fetchAll();
    }

    // Lấy 1 kết quả
    public function single()
    {
        $this->execute();
        return $this->stmt->fetch();
    }

    // Đếm số dòng
    public function rowCount()
    {
        return $this->stmt->rowCount();
    }
}
