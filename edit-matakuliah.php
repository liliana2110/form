<?php
session_start();
include 'db.php';
if ($_SESSION['status_login'] != true) {
    echo '<script>window.location="login.php"</script>';
}

$matakuliah = mysqli_query($conn, "SELECT * FROM tb_matakuliah WHERE matakuliah_id = '".$_GET['id']."' ");
if (mysqli_num_rows($matakuliah) == 0) {
    echo '<script>window.location="matakuliah.php"</script>';
}

$m = mysqli_fetch_object($matakuliah);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Mahasiswa</title>
    <link rel="stylesheet" type="text/css" href="style/style3.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
</head>
<body>
    <!-- header -->
    <header>
        <div class="container">
            <img src="foto/Logo.jpg" width="200px">
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="profil.php">Profil</a></li>
                <li><strong><a href="matakuliah.php">Matakuliah</a></strong></li>
                <li><a href="tugas.php">Tugas</a></li>
                <li><a href="logout.php">LOGOUT</a></li>
            </ul>
        </div>
    </header>

    <!-- content -->
    <div class="section">
        <div class="container">
            <h2>Edit Data Matakuliah</h2>
            <div class="box">
                <form action="" method="POST">
                    <input type="text" name="nama" placeholder="Nama Matakuliah" class="input-control" value="<?php echo $m->matakuliah_name ?>" required>
                    <input type="submit" name="submit" value="Submit" class="btn">
                </form>

                <?php 
                if(isset($_POST['submit'])){
                    $nama = ucwords($_POST['nama']);
                    $update = mysqli_query($conn, "UPDATE tb_matakuliah SET matakuliah_name = '".$nama."' WHERE matakuliah_id = '".$m->matakuliah_id."' ");
                    if($update){
                        echo '<script>alert("Edit Matakuliah BERHASIL")</script>';
                        echo '<script>window.location = "matakuliah.php"</script>';
                    } else {
                        echo 'gagal '.mysqli_error($conn);
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <!-- footer -->
    <footer>
        <div class="container">
            <small>Copyright &copy; 2021 - INSTITUT BISNIS DAN TEKNOLOGI INDONESIA</small>
        </div>
    </footer>
</body>
</html>
