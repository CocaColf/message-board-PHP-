<?php
header("Content-Type:text/html;charset=utf-8");
include('./conn.php')
?>
<!DOCTYPE html>
<html>
<head>
	<title>留言板</title>
	<meta charset="utf-8">

	<style type="text/css">
		.comment_form {
			display: none;
		}
	</style>
</head>
<body>
<form action="new_save.php" method="post">
	<p>用户名:<input type="text" name="username"></p>
	<p>留言:<textarea name="content" cols="80" rows="10"></textarea></p>
	<input type="submit" name="留言" value="留言">
</form>
<hr>
<?php

$sql = "select * from guestbook";
$rs = mysqli_query($conn, $sql);


//设置每页显示多少条
$pagesize = 5;

//设置默认在第几页
$page = isset($_GET['page']) ? $_GET['page'] : 1;
//echo $page;

//计算要分多少页
$rowNumber = mysqli_num_rows($rs);
$pageNumber = ceil($rowNumber / $pagesize);		//向上取整ceil 四舍五入round  取整intval 舍去小数位float

//显示对应页数的内容
$start = ($page - 1) * $pagesize;	//开始的楼层数

$sql2 = "select * from guestbook order by istop desc limit $start, $pagesize";

$rs2 = mysqli_query($conn, $sql2);

while($row = mysqli_fetch_assoc($rs2)) {
	//输出用户信息
	echo "<p>{$row['id']}# {$row['username']} {$row['intime']}"."<br>";
	//处理删除和修改
	echo $row['content'].' <a href="delete.php?id='.$row['id'].'">删除</a> '.'<a href="edit.php?id='.$row['id'].'">修改</a> ';

	//置顶功能
	if($row['istop']) {
		echo ' <a href="action.php?act=cancel&id='.$row['id'].'">取消置顶</a>';
	} else {
		echo ' <a href="action.php?act=istop&id='.$row['id'].'">置顶</a>';
	}

	//点赞功能
	echo ' <a href="action.php?act=praise&id='.$row['id'].'">点赞('.$row['praise'].')</a>';
	
	//回复功能
	echo ' <a href="javascript:show('.$row['id'].')">回复</a>'."<br>";

	//显示回复内容
	$sql3 = "select * from comment where book_id=".$row['id'];	//这句话很容易写错，错把变量放到双引号里面去

	$rs3 = mysqli_query($conn, $sql3);
	while($row = mysqli_fetch_assoc($rs3)) {
		echo "<span>";
		echo $row['id']."# ".$row['username'].": ".$row['content']."<br>";
		echo "</span>";
	}
	
	echo '
	<form id="comment'.$row['id'].'" class="comment_form" action="action.php?act=save_comment&id='.$row['id'].'" method="post">
		<p>用户名:<input type="text" name="commentusername"></p> <p>评论:<input type="text" name="comment"></p>
		<input type="submit" value="提交回复">
	</form>
	';
	echo "<hr>";
}
//var_dump(mysqli_error($conn));
//显示分页
for($i = 1; $i <= $pageNumber; $i++) {
	echo '<a href="index.php?page='.$i.'">'.$i.'</a> ';
}

?>

<script type="text/javascript">
	function show(id) {
		var obj = document.getElementById('comment'+id);
		if(obj.style.display == '' || obj.style.display == 'none') {
			obj.style.display = 'block';
		} else {
			obj.style.display = 'none';
		}
	}
</script>

</body>
</html>