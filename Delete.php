<?php
include 'DB.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    deleteStudent($id);
    header("Location: VIEW.php?action=danger&msg=Record+Deleted");
    exit();
} else {
    header("Location: VIEW.php");
    exit;
}
?>
