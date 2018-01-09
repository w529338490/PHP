<?php
/**
 * Created by PhpStorm.
 * User.class: Administrator
 * Date: 2018/1/8
 * Time: 23:52
 */
session_start();
class User
{
    var  $uname;
    function  index(){
        $user= D("user");
        $data=$user->select();
        p($data);
         $this->assign("data",$data);
         $this->display();
    }

    public  function add(){
        echo  "hello world";
   }

   public function login(){
        $user= D("user");

        $v=$user->login();
        p($v[1]);
        if($user->login()){
            $_SESSION["isok"]='ok';
            $_SESSION["username"]=$v["username"];
            $this->success("恭喜登陆成功",3,"user/dologin");
        }else {
            $this->error("登陆失败，账户或密码错误",3,"user/index");
       }
   }
   public  function  dologin(){
        $this->assign("uname",$_SESSION["username"]);
        $this->assign("isok",$_SESSION["isok"]);
        $this->display("user/index");
   }
}