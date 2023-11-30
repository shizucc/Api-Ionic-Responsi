<?php
include "koneksi.php";

function generateRandomToken($length = 32)
{
    return bin2hex(random_bytes($length));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);


    $username = trim($data['username']);
    $password = trim($data['password']);

    $query = "SELECT `username`, `password` FROM `pegawai` WHERE `username` = '$username' AND `password` = '$password'";
    $result = mysqli_query($koneksi, $query);
    $user = mysqli_fetch_assoc($result);

    
    if ($user) {
        $_SESSION['username'] = $username;
        $token = generateRandomToken();
        echo json_encode(['status' => 'success', 'message' => 'Login berhasil', 'username' => $username, 'token' => $token]);
        exit;
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Username atau password salah']);
        exit;
    }
}