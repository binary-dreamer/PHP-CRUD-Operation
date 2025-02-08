<?php

//require_once __DIR__."/db.php";
require_once __DIR__."/../view/layout/pagination.php";

class student {

    private $conn;
    private $table = "student";
    private $perPage;  // Number of records per page

    public function __construct() {
        $db = new db();
        $this->conn = $db->connect();
    }

    public function create($name, $email, $password, $gender, $photo) {
        $query = "INSERT INTO $this->table (name, email, password, gender, photo) VALUES ('$name', '$email','$password','$gender','$photo')";
        return mysqli_query($this->conn, $query);
    }

    public function read() {
        $query = "SELECT * FROM $this->table";
        return mysqli_query($this->conn, $query);
    }

    public function get_user($id) {
        $query = "SELECT * FROM $this->table WHERE id=$id";
        $result = mysqli_query($this->conn, $query);
        return mysqli_fetch_assoc($result);
    }

    public function update($id, $name, $email, $gender, $photo = null) {
        // If a photo is provided, include it in the query
        if ($photo) {
            $query = "UPDATE $this->table SET name='$name', email='$email', gender='$gender', photo='$photo' WHERE id=$id";
        } else {
            // Update without changing the photo
            $query = "UPDATE $this->table SET name='$name', email='$email', gender='$gender' WHERE id=$id";
        }

        return mysqli_query($this->conn, $query);
    }

    public function delete($id) {
        $query = "DELETE FROM $this->table WHERE id=$id";
        return mysqli_query($this->conn, $query);
    }

    public function getPaginatedStudents($currentPage, $perPage) {
        $this->setPerPage($perPage);  // Set the records per page dynamically
        $startFrom = ($currentPage - 1) * $this->perPage;
        $query = "SELECT * FROM $this->table LIMIT $startFrom, $this->perPage";
        $result = mysqli_query($this->conn, $query);

        $totalRecords = $this->getTotalRecords();
        $totalPages = ceil($totalRecords / $perPage);

        return [
            'students' => $result,
            'pagination' => generatePagination($currentPage, $totalPages, $perPage),
            'pageSelector' => generatePageSelector($perPage)
        ];
    }

    private function getTotalRecords() {
        $query = "SELECT COUNT(*) FROM $this->table";
        $result = mysqli_query($this->conn, $query);
        $data = mysqli_fetch_row($result);
        return $data[0];
    }

    public function setPerPage($perPage) {
        $this->perPage = $perPage;
    }
}

// Get the current page number and perPage value from the URL
$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
$perPage = isset($_GET['perPage']) ? $_GET['perPage'] : 5; // Default to 5 records per page

// Create an instance of the student class
$controller = new student();

// Fetch students for the current page with the selected perPage
$paginatedData = $controller->getPaginatedStudents($currentPage, $perPage);
$students = $paginatedData['students'];
$pagination = $paginatedData['pagination'];
$pageSelector = $paginatedData['pageSelector'];

?>
