<?php
session_start();//memulai sesi
session_unset();//menghapus semua data
session_destory();//menghancurkan sesi sepenuhnya
header('Location: login.php');//Arahkan pengguna ke halaman login
exit();//menghentikan eksekusi script