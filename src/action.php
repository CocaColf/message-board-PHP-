<?php
include('./conn.php');


$act = $_GET['act'];



if($act == 'istop') {
	$id = $_GET['id'];
	$sql = "update guestbook set istop=1 where id=$id";
	$r = mysqli_query($conn, $sql);

	if($r) {
		echo "置顶成功";
	} else {
		echo "置顶失败";
	}
}
if($act == 'cancel') {
	$id = $_GET['id'];
	$sql = "update guestbook set istop=0 where id=$id";
	$r = mysqli_query($conn, $sql);

	if($r) {
		echo "取消置顶成功";
	} else {
		echo "取消置顶失败";
	}
}

if($act == 'praise') {
	$id = $_GET['id'];
	$sql = "update guestbook set praise=praise+1 where id=$id";
	$r = mysqli_query($conn, $sql);

	if($r) {
		//header("Location:./index.php");
		echo "置顶成功";
	} else {
		echo "置顶失败";
	}
}

//处理回复
if($act == 'save_comment') {
	$username = $_POST['commentusername'];	//回复者的名字
	$book_id = $_GET['id'];		//针对哪一个楼层进行的回复
	$comment = $_POST['comment'];		//回复的内容

	//在数据库语句里是代表字符串的变量要打引号
	$sql = "insert into comment(username,book_id,content) values('$username',$book_id,'$comment')";		
	$r = mysqli_query($conn, $sql);

	if($r) {
		//header("Location:index.php");
		echo "回复成功";
	} else {
		echo "回复失败";
	}
	var_dump(mysqli_error($conn));
}
?>