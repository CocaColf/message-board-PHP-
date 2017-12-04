<?php
//数据库统一文件
header("Content-Type:text/html;charset=utf-8");
//连接数据库
$conn = @mysqli_connect('localhost', 'root','root','book') or die("连接数据库错误");
mysqli_query($conn, 'set names utf8');

?>