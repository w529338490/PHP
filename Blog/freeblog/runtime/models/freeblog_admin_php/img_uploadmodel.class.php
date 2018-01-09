<?php
/**
	图像上传model
	作者：卫聪

*/
	class Img_uploadModel extends Dpdo {
		public $maxsize=10000000;
		public $allowtype=array('gif','jpg','png');
		public $thumb=array('width'=>80,'height'=>60,'prefix'=>'th_');
		//public $water=array('water'=>'logo.png','position'=>5,'prefix'=>'wa_');
		function up($name){
			$up=new FileUpload();
			   $up->set("maxsize",$this->maxsize)
				   //->set("path",$GLOBALS['pbulic'].'public/uploads/'.$_SESSION['user_username'].'')
				   ->set("allowtype",$this->allowtype)
				   ->set("thumb",$thumb=$this->thumb);
				//->set("watermark",array('water'=>'logo.png','position'=>5,'prefix'=>'wa_'));
			    //->set('watermark', array(“water”=>'logo.gif', "position"=>5,"prefix"=>'wa_'));
			if($up->upload($name)){
				$msg['info']=$up->getFileName();
				$msg['status']=true;
			}else{
				$msg['info']=$up->getErrorMsg();
				$msg['status']=false;
			}
			return $msg;
		} 
		
	}