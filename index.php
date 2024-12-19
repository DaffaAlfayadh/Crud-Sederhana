<?php 
include("connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>crud by alfayadh</title>
    <!-- Link ke CSS Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        h1{
            font-size: 28px;
        }
        body {
            background-color: #2c2f33;
            color: white; 
        }
        .form-container {
            max-width: 400px;
            margin: 100px auto; 
            background-color: #23272a; 
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-control {
            background-color: #40444b; 
            border: 1px solid #7289da;
            color: white;
        }
        .form-control:focus {
            background-color: #ffff; 
            border-color: #7289da; 
            box-shadow: none; 
        }
        .btn-primary {
            background-color: #7289da; 
            border-color: #7289da; 
        }
        .btn-primary:hover {
            background-color: #5b6e9e; 
            border-color: #5b6e9e; 
        }
    </style>
</head> 

<body> 
    <div class="form-container">
        <h1>Silahkan Login</h1> 
        <form name="form" action="login.php" method="POST">
            <div class="form-group">
                <label for="user">Username</label> 
                <input type="text" id="user" name="user" class="form-control" required> 
            </div>
            <div class="form-group">
                <label for="pass">Password</label> 
                <input type="password" id="pass" name="pass" class="form-control" required> 
            </div>
            <button type="submit" id="btn" class="btn btn-primary btn-block" name="submit">Login</button>
        </form>
    </div> 

    <!-- Link ke JS Bootstrap (opsional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>