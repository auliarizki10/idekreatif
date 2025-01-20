<?php
session_start();
require_once("../config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_POST ["usename"];
    $password = $_POST ["password"];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        //verifikasi password
        if (password_verify($password, $row["password"])){
            $_SESSION["username"] = $username;
            $_SESSION["name"] = $row["name"];
            $_SESSION["role"] = $row["role"];
            $_SESSION["user_id"] = $row["user_id"];
            //set notifikasi selamat datang
            $_SESSION['notification'] =[
                'type'=> 'primary'
                'massage' => 'Selamat Datang Kembali!'
            ];
             // Redirect ke dashboard
             header('Location:../dasboard.php');
             exit();   
        }else{
            // password salah
            $_SESSION['notification'] =[
                'type'=> 'danger'
                'massage' => 'Username atau Password salah'
            ];
        }
    }else{
        //username tidak di temukan
        $_SESSION['notification']=[
            'type'=> 'denger'
            'massage' => 'Username atau Password salah'
        ];
    }
    // Redirect kembali ke halaman login jika gagal
    header('Location: login.php');
    exit();
}
$conn->close();
?>