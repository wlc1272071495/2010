<?php

    @include_once("conn.php");

    $email = $_POST["email"]; 
    
    if(!$email){
        $obj = array();
        $obj["status"] = false;
        $obj["msg"] = "请传入完整参数";
        exit(json_encode($obj));  
    }
        
    // $email = "a123123";
    // 1. 查询是否有该用户对应的数据 
    
    $search = "select * from `userinfo` where email = '$email'";

    $result = mysqli_query($conn,$search);

    $item = mysqli_fetch_assoc($result);

    // print_r($item);

    $obj = array();
    if(!$item){ // 不存在该用户 
        $obj["status"] = true;
        $obj["msg"] = "可以注册的邮箱";
    }else{ // 存在该用户
        // 存在  => 该用户已注册
        $obj["status"] = false;
        $obj["msg"] = "该邮箱已注册";
    }

    echo json_encode($obj);


?>