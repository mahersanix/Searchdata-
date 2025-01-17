<?php

define('MyConst', TRUE);
if (!defined('MyConst')) {
    die('Direct access not permitted');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">

    <title>Ftu_1Password</title>
</head>
<body>
    <img src="ftu_logo.png" alt="ftu logo" class="center" >
    <h2>รายการรหัสผ่านระบบต่างๆของมหาวิทยาลัย</h2>
    <br>
    <div class="container">
    <form action="th.php" method="POST">
        <input type="text" placeholder="กรุณากรอบเลขประจําตัวประชาชน" name="search" class="form-control" style="font-family: 'Noto Sans Thai', sans-serif;">
        <button type="submit" style="font-family: 'Noto Sans Thai', sans-serif;">ค้นหา</button>
        <button type="reset" style="font-family: 'Noto Sans Thai', sans-serif;">รีเซ็ต</button>
        
        <a href="https://airtable.com/shrtflAQbxmjuLjqx" class="btn btn-danger report-link" style="background-color: #e84118; 
        padding: 8px 5px; margin-top: 0px; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19); font-family: 'Noto Sans Thai', sans-serif;">แจ้งเรื่อง </a>
        <br>
    </form>
    </div>
    <?php 
if(isset($_POST['search']) && !empty($_POST['search'])){
    $home = $_POST['search'];
    $query = "SELECT * FROM user WHERE id_card  LIKE '%$home%'";
    include_once('conn.php');
    $path = mysqli_query($conn, $query);
    if (mysqli_num_rows($path) > 0) {
?>
    <!-- Table to display the search results -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>บัตรประชาชน</th>
                <th>รหัสนักศึกษา</th>
                <th>อีเมล์</th>
                <th>รหัสผ่าน</th>
                <th>รหัสผ่านไวไฟ</th>
                <th>รหัสผ่านห้องสมุด</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($path)) { ?>        
            <tr>
                <td><?php echo $row['id_card']; ?></td>
                <td><?php echo $row['student_id']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['password_email']; ?></td>
                <td><?php echo $row['password_wifi']; ?></td>
                <td><?php echo $row['password_library']; ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
<?php 
            mysqli_close($conn);	
        }
} else if(isset($_POST['search']) && empty($_POST['search'])) {
    echo "";
}
?>
    <br>
    <div class="language">
            <a class="btn btn-outline-primary" href="index.php">ENG</a>
			<a class="btn btn-outline-primary" href="th.php">TH</a>
			<a class="btn btn-outline-primary" href="ar.php">AR</a>
	</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<script src="script.js"></script>
</html>
