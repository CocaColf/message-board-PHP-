<?php
include('./conn.php');

$username = $_POST['username'];
$content = $_POST['content'];
$id = $_POST['id'];

if(empty($username) || empty($content)) {
	echo "内容为空";
	exit;
}
if(!is_numeric($id)) {
	echo "ID不正确";
	exit;
}

$sql = "update guestbook set username='$username',content='$content' where id=$id";
$rs = mysqli_query($conn, $sql);

if($rs) {
	header("Location:./index.php");
} else {
	echo "修改出错";
}

?>