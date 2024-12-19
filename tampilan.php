<?php 
require_once('tcpdf/tcpdf.php');

$servername = "localhost";
$username = "root";
$password = "";
$db_name = "crud_oop";

$conn = new mysqli($servername, $username, $password, $db_name, 3306);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error); 
}

// Create
if (isset($_POST['create'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $sql = "INSERT INTO users (name, email) VALUES ('$name', '$email')";
    $conn->query($sql);
    header("Location: tampilan.php"); 
    exit();
}


$sql = "SELECT * FROM users";
$result = $conn->query($sql);


if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $sql = "UPDATE users SET name='$name', email='$email' WHERE id=$id";
    $conn->query($sql);
    header("Location: tampilan.php"); 
    exit();
}

// Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM users WHERE id=$id";
    $conn->query($sql);
    header("Location: tampilan.php"); 
    exit();
}


$edit_row = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $edit_sql = "SELECT * FROM users WHERE id=$id";
    $edit_result = $conn->query($edit_sql);
    $edit_row = $edit_result->fetch_assoc();
}


if (isset($_GET['generate_pdf'])) {
    $pdf = new TCPDF();
    $pdf->AddPage();
    $pdf->SetFont('helvetica', 'B', 20);
    $pdf->Cell(0, 10, 'List Mahasiswa', 0, 1, 'C');
    $pdf->SetFont('helvetica', '', 12);
    
    $pdf->Cell(30, 10, 'ID', 1);
    $pdf->Cell(80, 10, 'Name', 1);
    $pdf->Cell(80, 10, 'Email', 1);
    $pdf->Ln();

    while ($row = $result->fetch_assoc()) {
        $pdf->Cell(30, 10, $row['id'], 1);
        $pdf->Cell(80, 10, $row['name'], 1);
        $pdf->Cell(80, 10, $row['email'], 1);
        $pdf->Ln();
    }

    $pdf->Output('list_mahasiswa.pdf', 'D'); 
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mahasiswa</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        h1 {
            font-size: 24px; 
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">List Mahasiswa Pemrograman Berorientasi Objek</h1>
        
        <!-- Tombol Logout -->
        

        <h2 class="mt-4 card-header"><?php echo $edit_row ? 'Edit Nama' : 'Tambah Pengguna'; ?></h2> <br>
        <form method="POST" action="">
            <?php if ($edit_row): ?>
                <input type="hidden" name="id" value="<?php echo $edit_row['id']; ?>">
            <?php endif; ?>
            <div class="form-group">
                <input type="text" class="form-control" name="name" placeholder="Name" value="<?php echo $edit_row ? $edit_row['name'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo $edit_row ? $edit_row['email'] : ''; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary" name="<?php echo $edit_row ? 'update' : 'create'; ?>">
                <?php echo $edit_row ? 'Perbarui' : 'Tambah Pengguna'; ?>
            </button>
        </form> <br> <br>

        <h2 class="card-header">List Mahasiswa</h2>
        <table class="table table-bordered mt-3">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td>
                        <a href="?edit=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>   

        <a href="?generate_pdf=true" class="btn btn-success">Generate PDF</a>
        <div class="text-right mb-3">
            <a href="logout.php" class="btn btn-danger">Logout</a> <br><br> <br><br><br>

            
                </form>
            </div>
        </div>
    </div>
        </div>
    </div>
</body>
</html>