<?php
    
    @include_once("conn.php");

    $user = $_POST["user"]; 
    $gid = $_POST["gid"]; 
    $buyNum = $_POST["buyNum"]; 

    if(!($user&&$gid&&$buyNum)){
        $obj = array();
        $obj["status"] = false;
        $obj["msg"] = "请传入完整参数";
        exit(json_encode($obj));  
    }

    // 加入购物车 =>无脑新增,数据会重复加入购物车  
    // 怎么解决? 加入之前判断   该用户是否购买了该商品  (user,gid)
    // 如果买了  => 累加 
    // 没有   => 就新增

    $search = "select * from `shoppingcar` where user = '$user' and gid = '$gid'";

    $result = mysqli_query($conn,$search);

    $item = mysqli_fetch_assoc($result);   //解析成功 => 关联数据  失败=>false
    // print_r($item);

    if($item){
        $sql = "update `shoppingcar` set buyNum = buyNum + $buyNum where user = '$user' and gid = '$gid'";
    }else{
        $sql = "insert into `shoppingcar`(user,gid,buyNum) values('$user','$gid',$buyNum)";
    }
    $result = mysqli_query($conn,$sql);  

    $rows = mysqli_affected_rows($conn);

    $obj = array();
    if($rows>0){
        $obj["status"] = true;
        $obj["msg"] = "新增成功";
    }else{
        $obj["status"] = false;
        $obj["msg"] = "新增失败,请检查sql语句";
        $obj["sql"] = $sql;
    }

    echo json_encode($obj);






?>