<?php
    
    @include_once("conn.php");
    @header("Content-Type:text/json;charset=utf-8");  //text html json


    $user = $_POST["user"];   // 从前端接收字段 id  把对应的值赋值给变量 $id
    if(!$user){
        $obj = array();
        $obj["status"] = false;
        $obj["msg"] = "请传入完整参数";
        exit(json_encode($obj));   
    }

    // mysqli_query($conn,sql)   执行传入的sql语句
    // $conn  链接对象
    // sql    被执行的sql语句

    // 返回值:   语句执行成功=> 返回结果对象(mysqli_result Object 指针对象)   执行失败 => false

    $search = "select s.id,s.user,s.gid,s.buyNum,g.goodsName,g.goodsPrice,g.bigPicList,round(s.buyNum*g.goodsPrice,2) as subTotal from `shoppingcar` as s,`goodslist` as g where s.gid = g.goodsId and user = '$user'";

    $result = mysqli_query($conn,$search);
    
    $arr = array();
    while($item = mysqli_fetch_assoc($result)){
        $item["bigPicList"] = explode(",",$item["bigPicList"]);
        $item["goodsImg"] = $item["bigPicList"][0];

        $item["buyNum"] = $item["buyNum"]*1;
        // $item["subTotal"] = $item["buyNum"]*$item["goodsPrice"]);

        array_push($arr,$item);
    }
    echo json_encode($arr);

    // echo round(100,2);
?>