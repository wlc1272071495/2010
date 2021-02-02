<?php
    
    @include_once("conn.php");
    @header("Content-Type:text/json;charset=utf-8");  //text html json


    $id = $_GET["gid"];   // 从前端接收字段 id  把对应的值赋值给变量 $id
    if(!$id){
        $obj = array();
        $obj["status"] = false;
        $obj["msg"] = "请传入完整参数";
        exit(json_encode($obj));   
    }

    // mysqli_query($conn,sql)   执行传入的sql语句
    // $conn  链接对象
    // sql    被执行的sql语句

    // 返回值:   语句执行成功=> 返回结果对象(mysqli_result Object 指针对象)   执行失败 => false

    $search = "select * FROM `goodslist` where goodsId = '$id'";

    $result = mysqli_query($conn,$search);
   
    $item = mysqli_fetch_assoc($result);

    $obj = array();
    if($item){
        $item["bigPicList"] = explode(",",$item["bigPicList"]);
        $item["smallPicList"] = explode(",",$item["smallPicList"]);

        $obj["status"] = true;
        $obj["msg"] = "OK";
        $obj["data"] = $item;
    }else{
        $obj["status"] = false;
        $obj["msg"] = "该数据不存在";
    }
    echo json_encode($obj);

?>