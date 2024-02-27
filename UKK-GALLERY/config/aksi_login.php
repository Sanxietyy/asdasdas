<?php 
include 'koneksi.php';
session_start();
if(isset($_POST['kirim'])){
    $username= $_POST['username'];
    $password= md5($_POST['password']);

    $sql=mysqli_query($con,"SELECT * FROM users WHERE username='$username' AND password='$password'");
    $cek=mysqli_num_rows($sql);

    if($cek===1){
        while($data=mysqli_fetch_array($sql)){
            $_SESSION['userid'] = $data['userid'];
            $_SESSION['username'] =$data['username'];
            $username = $data['Username'];
        }
        echo "<script>alert('Selamat datang user $username');location.href='../admin/index.php';</script>";
    }else{
        echo "<script>alert('Password Atau Username Salah');location.href='../login.php'</script>";
    }
}
?>