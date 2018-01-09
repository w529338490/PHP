<?php
/**
 * Created by PhpStorm.
 * User.class: Administrator
 * Date: 2018/1/9
 * Time: 22:40
 */

class UserModel extends Dpdo {

    function index(){
        echo "index";
    }

    function login(){
        echo "login";
        $arr=array(
            "username"=>$_POST["username"],
            "pwd"=>$_POST["password"]
        );
        $result= D("user")->where($arr)->select();
        p($result);
       if($result){
           return $result[0];
       }else{
           return false;
       }
    }

}