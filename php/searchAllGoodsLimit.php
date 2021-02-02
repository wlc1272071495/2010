<?php
    @include_once("conn.php");

    // 用在做前端分页

    $key = $_POST["key"];   // 搜索的关键词
    $orderCol = $_POST["orderCol"];   // 排序的列名 column(id,chinese math english total)
    $orderType = $_POST["orderType"];   //  排序的方式  asc desc
    $pageIndex = $_POST["pageIndex"];
    $showNum = $_POST["showNum"];

    if(!($orderCol&&$orderType&&$pageIndex&&$showNum)){
        $obj = array();
        $obj["status"] = false;
        $obj["msg"] = "请传入完整参数";
        exit(json_encode($obj));  
    }

    // 后端分页    => 借助sql语法  limit  m,n  跳过m条,显示n跳
    // 第1页   limit 0,5
    // 第2页   limit 5,5
    // 第3页   limit 10,5
    // ...    
    // $pageIndex   =>  limit  ($pageIndex-1)*$showNum

    // $pageIndex => 可能超出最大值,也有可能小于1   =>限制范围

    //页码的最大值 pageMax = count / showNum => 向上取整

    // 查询数据的总数量 (按照搜索的关键词查询)
    $searchAll = "SELECT count(*) as count FROM `goodslist` where goodsName like '%$key%'";
    // echo $searchAll;
    $resultAll = mysqli_query($conn,$searchAll);
    $item = mysqli_fetch_assoc($resultAll);
    // print_r($item);
    $count = $item["count"];  // 满足条件的数据的总数量
    $maxPage = ceil($count/$showNum);

    if($pageIndex >= $maxPage){
        $pageIndex = $maxPage;
    }

    if($pageIndex <= 1){
        $pageIndex = 1;
    }


    $skipNum = ($pageIndex-1)*$showNum;

    $search = "SELECT id,goodsId,goodsName,goodsPrice,bigPicList FROM `goodslist` where goodsName like '%$key%' order by $orderCol $orderType limit $skipNum,$showNum";

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
        $str = $item["bigPicList"];
        $item["bigPicList"] = explode(",",$str);
        $item["goodsImg"] = $item["bigPicList"][0];
       
        array_push($arr,$item);
    }

    // [{},{},{},{},{}]
    // echo json_encode($arr);
    // echo $maxPage;

    // {
    //     maxPage,
    //     data:[{},{},{},{},{}]
    // }

    $obj = array();
    $obj["count"] = $count*1;   // 数据的总数量
    $obj["currentPage"] = $pageIndex*1;  // 返回当前页是第几页
    $obj["maxPage"] = $maxPage;   // 最大页码
    $obj["list"] = $arr;

    echo json_encode($obj);



?>