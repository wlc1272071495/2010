<?php
    
    @include_once("conn.php");   // 引入公共的php

    $id = $_POST["id"];
    $chinese = $_POST["chinese"];
    $math = $_POST["math"];
    $english = $_POST["english"];

    if(!($id && $chinese && $math && $english)){   // 如果参数不完整  =>  请传入完整参数 
        $obj = array();
        $obj["status"] = false;
        $obj["msg"] = "请传入完整参数";
        exit(json_encode($obj));  
    }

    
    $update = "update `grade` set chinese=$chinese,math=$math,english=$english where id = $id";
    // 新增
    // mysqli_query($conn,$update);     
    // => 返回语句执行的结果  
    // 语句执行成功(但是数据不一定会被更改   delete from `grade` where id = 100)=>true 
    // 失败就返回false
    $result = mysqli_query($conn,$update);  
    // echo $result;

    //  更新
    //  $rows =mysqli_affected_rows($conn);   接收一个链接的对象返回受影响的函数
    //  $row > 0     更新成功  
    //  $row = 0     语句执行成功,表格数据未改变 (数据不存在 , 修改的数据和原数据一样)
    //  $row = -1    语法有误,导致语句执行失败   ( 更新  1.语法问题  2.唯一值重复 )

    $rows = mysqli_affected_rows($conn);

    // echo $rows;

    $obj = array();
    if($rows>0){
        $obj["status"] = true;
        $obj["msg"] = "更新成功";
    }else if($rows==0){
        $obj["status"] = true;
        $obj["msg"] = "更新成功,数据未改变";
    }else{
        $obj["status"] = false;
        $obj["msg"] = "更新失败,请检查sql语句";
        $obj["sql"] = $update;
    }

    echo json_encode($obj);


   
    
    

 









?>