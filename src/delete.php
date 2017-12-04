<?php
include('./conn.php');

//接收数据
$id = $_GET['id'];
//过滤数据
if(!is_numeric($id)) {
	echo "不是一个有效楼层";
	exit;
}

//发送数据库语句和执行操作
$sql = "delete from guestbook where id=$id";
$rs = mysqli_query($conn, $sql);

if($rs) {
	header('Location:index.php');	//跳转到首页
	//echo '<script>alter("删除成功");location.href="./index.php"</script>'
} else {
	echo "删除失败";
}


?>