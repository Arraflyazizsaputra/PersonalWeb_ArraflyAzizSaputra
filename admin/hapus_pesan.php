<?php
include "../koneksi.php";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    mysqli_query($db, "DELETE FROM tbl_pesan WHERE id_pesan = $id");
}

header("Location: kelola_pesan.php");
exit;
?>
