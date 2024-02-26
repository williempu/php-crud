<?php
class DBConnection {
    private $conn;

    public function __construct() {
        $this->conn = new PDO(
            "mysql:host=localhost;dbname=myssip",
            "admin", "admin123");
    }

    public function __destruct() {
        $this->conn = null;
    }

    public function getAllStudents() {
        $sql = "SELECT id, name, nim, phone FROM student";
        $result = $this->conn->prepare($sql);
        $result->execute();
        return $result;
    }

    public function getStudentByNIM($studentNIM) {
        $sql = "SELECT id, name, nim, phone FROM student
        WHERE nim = ?";
        $result = $this->conn->prepare($sql);
        $result->execute([$studentNIM]);
        return $result;
    }

    public function saveStudent($name, $nim, $phone, $major_id) {
        $sql = "INSERT INTO student (name, nim, phone, major_id)
        VALUES (?, ?, ?, ?)";
        $result = $this->conn->prepare($sql);
        $result->execute([$name, $nim, $phone, $major_id]);
    }

    public function getAllMajors() {
        $sql = "SELECT id, name, code FROM major";
        $result = $this->conn->prepare($sql);
        $result->execute();
        return $result;
    }

    public function saveMajor($name, $code) {
        $sql = "INSERT INTO major (name, code) VALUES (?, ?)";
        $result = $this->conn->prepare($sql);
        $result->execute([$name, $code]);
    }
}
?>
