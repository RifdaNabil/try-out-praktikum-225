<?php
session_start();
session_unset();
session_destroy();
session_write_close(); // Tambahan opsional untuk memastikan sesi tertutup
header("Location: ../beranda.php");
exit();
?>