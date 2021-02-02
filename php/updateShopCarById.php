<?php
    
    @include_once("conn.php");

    $id = $_POST["id"]; 
    $buyNum = $_POST["buyNum"]; 
    $type = $_POST["type"];    // 1 => 加  0 => 减   2=>手动输入


    if(!($id&&$buyNum)){
        $obj = array();
        $obj["status"] = false;
        $obj["msg"] = "请传入完整参数";
        exit(json_encode($obj));  
    }

    if($type==1){ //加
        $sql = "update `shoppingcar` set buyNum = buyNum + $buyNum where id = $id";
    }else if($type==2){ //用户手动输入
        $sql = "update `shoppingcar` set buyNum =  $buyNum where id = $id";
    }else{
        $sql = "update `shoppingcar` set buyNum = buyNum - $buyNum where id = $id";
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