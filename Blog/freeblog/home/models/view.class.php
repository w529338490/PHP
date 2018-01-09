<?php
/**
	评论模块
	作者：卫聪

*/
	class view{
		function output($var){//变量是ajax发送过来的$_GET，js--innerHTML
			if(!empty($var['str2'])){
			$arr2=explode(',',$var['str2']);
			$rarg2['review_name']=$arr2[3];
			$rarg2['review_email']=$arr2[2];
			$rarg2['review_website']=$arr2[1];
			$rarg2['review_content']=$arr2[4];
			$rarg2['path']=$arr2[0];
			$rarg2['review_time']=time();
			$insert2=D('review')->insert($rarg2);//评论的回复评论的插入ID
			}else{	
			$arr=explode('|',$var['str']);
			$arg['review_name']=$arr[0];
			$arg['review_email']=$arr[1];
			$arg['review_website']=$arr[2];
			$arg['review_content']=$arr[3];
			$arg['aid']=$arr[4];
			$arg['review_time']=time();
			$insert=D('review')->insert($arg);
			$show=D('review')->where(array('aid'=>$arg['aid']))->select();
			}
			$width=535;
			$offset=40;
			for($i=0;$i<count($show);$i++){
			$str.='<div class="column_two_section_cont" style="width:575px;margin-top:10px;">状态:待审核<br/>'.$show[$i]['review_name'].'&nbsp;在&nbsp;'.date('Y-m-d H:i:s',$show[$i]['review_time']).'&nbsp;说&nbsp;<br>'.$show[$i]['review_content'].'<br><span ><font color="#f5ea01" onclick="bb(this)"></font></span><div style="position:relative;left:70px;border:1px solid red;display:none;width:400px;" class="column_two_section_cont" id="backup">
				<form>个人昵称：<input type="text" id="name2">&nbsp;&nbsp;&nbsp;&nbsp;<font color="#f5ea01" onclick="bb2(this)">关闭</font><br/>
					电子邮箱：<input type="text" id="email2"><br/>
					个人网站：<input type="text" id="web2"><br/>
					评论内容：<textarea style="width:370px;height:120px" id="cont2"></textarea><br/>
					<input type="hidden" id="rid2" value="'.$show[$i]['rid'].'">
					<font color="#f5ea01" onclick="bb3(this)">发表内容</font>
				</form>
				</div></div>';

			}
			 $str=$str.'^'.$i;
			return $str; //第一层回复返回；
		}
		
			
		function bianli($arr){//从数据库遍历出来摆放	php--for
			$str='';
			$width=535;
			$offset=40;
			for($i=0;$i<count($arr);$i++){
				//$width-=$offset;	
				$str.='<div class="column_two_section_cont" style="width:575px;margin-top:10px;">状态:待审核<br/>'.$arr[$i]['review_name'].'&nbsp;在&nbsp;'.date('Y-m-d H:i:s',$arr[$i]['review_time']).'&nbsp;说&nbsp;<br>'.$arr[$i]['review_content'].'<br><span ><font color="#f5ea01" onclick="bb(this)"></font></span><div style="position:relative;left:70px;border:1px solid red;display:none;width:400px;" class="column_two_section_cont" id="backup">
				<form>个人昵称：<input type="text" id="name2">&nbsp;&nbsp;&nbsp;&nbsp;<font color="#f5ea01" onclick="bb2(this)">关闭</font><br/>
					电子邮箱：<input type="text" id="email2"><br/>
					个人网站：<input type="text" id="web2"><br/>
					评论内容：<textarea style="width:370px;height:120px" id="cont2"></textarea><br/>
					<input type="hidden" id="rid2" value="'.$arr[$i]['rid'].'">
					<font color="#f5ea01" onclick="bb3(this)">发表内容</font>
				</form></div>';	
				$str.='</div>';	
			}
			return $str;
		}


	
	}


	//				$rr=D('review')->where('aid=0')->select();//$rr是多层回复数据插入数据后返回的ID
//
//					p($arr[$i]['rid']);
//					P($rr[$i]['path'].'-----');
//					//p($rr);
//					for($j=0;$j<count($rr);$j++){//第二层回复
//						
//						//p($j);
//						if($rr[$j]['path']==$arr[$i]['rid']){
//							$str.='<div class="column_two_section_cont" style="width:'.$width.'px;height:150px;margin-top:10px;">状态:待审核<br/>'.$rr[$j]['review_name'].'在'.date('Y-m-d H:i:s',$rr[$j]['review_time']).'刚刚回	复'.$arr[$i]['review_name'].'<br>'.$rr[$j]['review_content'].'<br><span ><font color="#f5ea01"	onclick="bb(this)">回复</font></span><div style="position:relative;left:70px;border:1px solid red;display:none;width:400px;" class="column_two_section_cont">
//							<form>个人昵称：<input type="text" id="name2">&nbsp;&nbsp;&nbsp;&nbsp;<font color="#f5ea01" onclick="bb2(this)">关闭</font><br/>
//							电子邮箱：<input type="text" id="email2"><br/>
//							个人网站：<input type="text" id="web2"><br/>
//							评论内容：<textarea style="width:370px;height:120px" id="cont2"></textarea><br/>
//							<input type="hidden" id="rid2" value="'.$rr[$j]['rid'].'">
//							<font color="#f5ea01" onclick="bb3(this)">发表内容'.$rr[$j]['rid'].'</font>
//							</form></div></div>';
//							
//
//						}else{
//							continue;
//						}
//					}