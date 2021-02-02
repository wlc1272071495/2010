<?php
    
    @include_once("conn.php");

    $user = $_POST["user"]; 
    $pwd = $_POST["pwd"]; 
    $phone = $_POST["phone"]; 
    $email = $_POST["email"]; 

    if(!($user&&$pwd&&$phone&&$email)){
        $obj = array();
        $obj["status"] = false;
        $obj["msg"] = "请传入完整参数";
        exit(json_encode($obj));  
    }

    // 注意  1. 引号不能删   2.复制时不能有空格
    $insert = "insert into `userinfo`(user,pwd,phone,email) value('$user','$pwd','$phone','$email')";
   
    $result = mysqli_query($conn,$insert);  

    $rows = mysqli_affected_rows($conn);

    $obj = array();
    if($rows>0){
        $obj["status"] = true;
        $obj["msg"] = "新增成功";
    }else{
        $obj["status"] = false;
        $obj["msg"] = "新增失败,请检查sql语句";
        $obj["sql"] = $insert;
    }

    echo json_encode($obj);





?>