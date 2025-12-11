<?php  
   session_start();
   include 'config.php';
   include 'admin_header.php';

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['admin'];
    $password = $_POST['admin123'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if ($password == $user['password']) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: orders.php"); 
            exit;
        } else {
            $error = "Incorrect password";
        }
    } else {
        $error = "User not found";
    }
}

$countUsers = 0;

$countOrders = 0;
$sql = "
    SELECT 
        (SELECT COUNT(*) FROM users) AS total_users,
        (SELECT COUNT(*) FROM orders) AS total_orders
";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Admin Dashboard</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="text-align: center;">

<div  class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Admin Dashboard</h2>
        
    </div>



        <div class="col-md-4 mb-3">
            <div class="card p-3">
                <h5>Total Orders is <?php echo $countUsers = $row['total_orders'];?></h5>
                <p class="display-6 mb-0"></p>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card p-3">
                <h5>Total Users is <?php echo $countOrders = $row['total_users'];?></h5>
                <p class="display-6 mb-0"></p>
            </div>
        </div>
    </div>

    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

