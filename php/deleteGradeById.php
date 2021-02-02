<?php
    
    @include_once("conn.php");   // 引入公共的php

    $ids = $_GET["ids"]; // 接收前端传过来的 id(多个  用逗号分隔)
    
    
    if(!($ids)){   // 如果参数不完整  =>  请传入完整参数 
        $obj = array();
        $obj["status"] = false;
        $obj["msg"] = "请传入完整参数";
        exit(json_encode($obj));  
    }
    
    $del = "delete from `grade` where id in ($ids)";
    // $del = "delete from `grade` where id in (39,44)";
    // 新增
    // mysqli_query($conn,$del);     
    // => 返回语句执行的结果  
    // 语句执行成功(但是数据不一定会被更改   delete from `grade` where id = 100)=>true 
    // 失败就返回false
    $result = mysqli_query($conn,$del);  
    // echo $result;

    //  删除
    //  $rows =mysqli_affected_rows($conn);   接收一个链接的对象返回受影响的函数
    //  $row > 0     删除成功  
    //  $row = 0     语句执行成功,表格数据未改变 (数据不存在 数据已经被删除了)
    //  $row = -1    语法有误,导致语句执行失败   ( 删除  1.语法问题  2.唯一值重复 )

    $rows = mysqli_affected_rows($conn);


    // echo $rows;

    $obj = array();
    if($rows>0){
        $obj["status"] = true;
        $obj["msg"] = "删除成功";
    }else if($rows==0){
        $obj["status"] = true;
        $obj["msg"] = "该数据已被删除";
    }else{
        $obj["status"] = false;
        $obj["msg"] = "删除失败,请检查sql语句";
        $obj["sql"] = $del;
    }

    echo json_encode($obj);


   
    
    

 









?>