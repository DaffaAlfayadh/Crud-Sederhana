<?php
include("connection.php");

class User {
    private $conn;
    private $username;
    private $password;

    public function __construct($conn, $username, $password) {
        $this->conn = $conn;
        $this->username = $username;
        $this->password = $password;
    }

    public function login() {
        $sql = "SELECT * FROM login WHERE username = ? AND password = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $this->username, $this->password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            header("Location: tampilan.php");
            exit();
        } else {
            $this->loginFailed();
        }
    }

    private function loginFailed() {
        echo '<script>
            alert("login gagal");
            window.location.href = "index.php";
        </script>';
    }
}

if (isset($_POST['submit'])) {
    $username = $_POST['user'];
    $password = $_POST['pass'];

    $user = new User($conn, $username, $password);
    $user->login();
}
?>