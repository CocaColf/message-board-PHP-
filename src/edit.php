<?php
header("Content-Type:text/html;charset=utf-8");
include('./conn.php');

//接收id
$id = $_GET['id'];

//查找id对应的数据,结果集
$sql = "select * from guestbook where id=$id";
$rs = mysqli_query($conn, $sql);

//从结果集里读取数据
$row = mysqli_fetch_assoc($rs);

?>
<!DOCTYPE html>
<html>
<head>
	<title>修改留言</title>
	<meta charset="utf-8">
</head>
<body>
<form action="edit_save.php" method="post">
	<input type="hidden" name="id" value="<?php echo $id; ?>">
	<p>用户名:<input type="text" name="username" value="<?php echo $row['username']; ?>"></p>
	<p>留言:<textarea name="content" cols="80" rows="10"><?php echo $row['content']; ?></textarea></p>
	<input type="submit" name="留言" value="留言">
</form>

