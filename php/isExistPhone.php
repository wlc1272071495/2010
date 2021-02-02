<?php

    @include_once("conn.php");

    $phone = $_POST["phone"]; 
    
    if(!$phone){
        $obj = array();
        $obj["status"] = false;
        $obj["msg"] = "请传入完整参数";
        exit(json_encode($obj));  
    }
        
    // $phone = "a123123";
    // 1. 查询是否有该用户对应的数据 
    
    $search = "select * from `userinfo` where phone = '$phone'";

    $result = mysqli_query($conn,$search);

    $item = mysqli_fetch_assoc($result);

    // print_r($item);

    $obj = array();
    if(!$item){ // 不存在该用户 
        $obj["status"] = true;
        $obj["msg"] = "可以注册的手机号";
    }else{ // 存在该用户
        // 存在  => 该用户已注册
        $obj["status"] = false;
        $obj["msg"] = "该手机号已注册";
    }

    echo json_encode($obj);


?>