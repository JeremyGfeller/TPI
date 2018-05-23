<?php
include('phpqrcode/qrlib.php');
QRcode::png('code data text', 'qr_code/filename.png'); // creates file
?>