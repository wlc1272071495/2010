<?php
    @header("Content-Type:text/html;charset=utf-8");
	// 配置CORS 跨域资源共享
	@header("Access-Control-Allow-Origin:*");  // 允许所有的服务器访问
	// @header("Access-Control-Allow-Origin:http://127.0.0.1:5500");    // 允许一个源访问
	
    const host ="localhost:3306";
    const user ="root";
    const pwd ="root";
    const dbName ="2010";

    $conn = mysqli_connect(host,user,pwd,dbName);

    if(!$conn){
        exit("数据库链接失败");
    }

    // 适配低版本  (上线  5.3)
    mysqli_query($conn,"set names utf8");
    mysqli_query($conn,"set character set utf-8");  


    // 限制访问
	// if(!($_SERVER['REMOTE_ADDR']=="192.168.51.45"||$_SERVER['REMOTE_ADDR']=="::1")){
	//     exit("你在想什么呢?");       //阻止脚本继续向后执行  退出
	// }
    









?>