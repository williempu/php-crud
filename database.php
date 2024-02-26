<?php
class DBConnection {
    private $conn;

    public function __construct() {
        $this->conn = new PDO(
            "mysql:host=localhost;dbname=database",
            "username", "password");
    }

    public function __destruct() {
        $this->conn = null;
    }

    public function getAllStudents() {
        $sql = "SELECT id, name, nim, phone, major_id FROM student";
        $result = $this->conn->prepare($sql);
        $result->execute();
        return $result;
    }

    public function getStudentById($id) {
        $sql = "SELECT id, name, nim, phone, major_id FROM student WHERE id = ?";
        $result = $this->conn->prepare($sql);
        $result->execute([$id]);
        return $result;
    }

    public function addStudent($name, $nim, $phone, $major_id) {
        $sql = "INSERT INTO student (name, nim, phone, major_id)
        VALUES (?, ?, ?, ?)";
        $result = $this->conn->prepare($sql);
        $result->execute([$name, $nim, $phone, $major_id]);
    }

    public function updateStudent($id, $name, $nim, $phone, $major_id) {
        $sql = "UPDATE student SET name = ?, nim = ?, phone = ?, major_id = ? WHERE id = ?";
        $result = $this->conn->prepare($sql);
        $result->execute([$name, $nim, $phone, $major_id, $id]);
    }

    public function deleteStudent($id) {
        $sql = "DELETE FROM student WHERE id = ?";
        $result = $this->conn->prepare($sql);
        $result->execute([$id]);
    }

    public function getAllMajors() {
        $sql = "SELECT id, name, code FROM major";
        $result = $this->conn->prepare($sql);
        $result->execute();
        return $result;
    }

    public function getMajorById($id) {
        $sql = "SELECT id, name, code FROM major WHERE id = ?";
        $result = $this->conn->prepare($sql);
        $result->execute([$id]);
        return $result;
    }

    public function addMajor($name, $code) {
        $sql = "INSERT INTO major (name, code) VALUES (?, ?)";
        $result = $this->conn->prepare($sql);
        $result->execute([$name, $code]);
    }

    public function updateMajor($id, $name, $code) {
        $sql = "UPDATE major SET name = ?, code = ? WHERE id = ?";
        $result = $this->conn->prepare($sql);
        $result->execute([$name, $code, $id]);
    }

    public function deleteMajor($id) {
        $sql = "DELETE FROM major WHERE id = ?";
        $result = $this->conn->prepare($sql);
        $result->execute([$id]);
    }
}
?>
