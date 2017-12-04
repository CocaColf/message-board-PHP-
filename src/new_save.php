<?php
include('./conn.php');

//接收数据
$username = $_POST['username'];
$content = $_POST['content'];
//验证数据
if(strlen($username) < 2) {
	echo "用户名不能少于两个字";
	exit;
}
if(empty($content)) {
	echo "留言内容不能为空";
	exit;
}
//构造sql语句发往服务器实现功能
$sql = "insert into guestbook(username,content) values('$username', '$content')";
$r = mysqli_query($conn, $sql);
//将执行结果显示
if($r) {
	echo "发表成功";
}else{
	echo "发表失败<br>";
	echo mysqli_error($conn);
}
?>