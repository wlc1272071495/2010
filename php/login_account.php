<?php
    
    @include_once("conn.php");

    // 前端传过来的用户名和密码   => 和数据库中的数据做对比
    // $user = "a123123";
    // $pwd = "123123";

    $account = $_POST["account"]; 
    $pwd = $_POST["pwd"]; 

    if(!($account&&$pwd)){
        $obj = array();
        $obj["status"] = false;
        $obj["msg"] = "请传入完整参数";
        exit(json_encode($obj));  
    }

    // 1. 查询是否有该用户对应的数据 
    
    $search = "select * from `userinfo` where user = '$account' or email = '$account' or phone = '$account'";

    $result = mysqli_query($conn,$search);

    $item = mysqli_fetch_assoc($result);

    // print_r($item);

    $obj = array();
    if($item){  // 存在该用户
        // 存在  =>  对比密码
        $realPwd = $item["pwd"];
        if($pwd == $realPwd){
            $obj["status"] = true;
            $obj["msg"] = "登录成功";
            $obj["user"] = $item["user"];  //多账号登录  => 返回当前登录的用户名(标识用户身份)
        }else{
            $obj["status"] = false;
            $obj["msg"] = "用户名或密码有误";
        }
    }else{ // 不存在该用户
        $obj["status"] = false;
        $obj["msg"] = "该用户未注册";
    }

    echo json_encode($obj);


    






?>