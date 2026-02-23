<?php

// Koneksi ke database

$connect = mysqli_connect('localhost', 'root', '', 'pernikahan');

if (!$connect) {
    echo "Gagal koneksi ke Database". mysqli_connect_error();
} 