<?php
    @include_once("conn.php");

    // 用在做前端分页

    $key = $_GET["key"];   // 搜索的关键词
    $orderCol = $_GET["orderCol"];   // 排序的列名 column(id,chinese math english total)
    $orderType = $_GET["orderType"];   //  排序的方式  asc desc

    if(!($orderCol&&$orderType)){
        $obj = array();
        $obj["status"] = false;
        $obj["msg"] = "请传入完整参数";
        exit(json_encode($obj));  
    }

    $search = "select id,name,class,chinese,math,english,chinese+math+english as total from `grade` where name like '%$key%'  order by $orderCol $orderType";

    $result = mysqli_query($conn,$search);

    // print_r($result);
    // echo $result->num_rows;    // mysqli Object  => 对象取值

    // $item = mysqli_fetch_assoc($result);  // 每次解析一条
    // print_r($item);

    // [{},{},{},{},{}]

    // 1.  for    => $result->num_rows 循环的次数
    // $arr = array();
    // for($i=0;$i< $result->num_rows;$i++){
    //     $item = mysqli_fetch_assoc($result);  // {}
    //     array_push($arr,$item);
    // }

    $arr = array();
    while($item = mysqli_fetch_assoc($result)){  // 解析数据 将结果赋值给变量$item  =>  解析成功=>关联数组   解析失败=> false

        // 数据处理 
        $item["chinese"] = $item["chinese"]*1;
        $item["math"] = $item["math"]*1;
        $item["english"] = $item["english"]*1;
        $item["total"] = $item["total"]*1;
        
        array_push($arr,$item);
    }

    echo json_encode($arr);

    // 单数据查询  直接解析
    // 多数据查询  循环解析

?>