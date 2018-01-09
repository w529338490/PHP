<?php
class Alipay{
	
		function alipayto(){
			$aliapy_config['sign_type']    = 'MD5';
			global $aliapy_config;
			$order=D('orders');
			$orders=$order->field('id,total')->where(array('id'=>$_GET['id']))->find();
			//请与贵网站订单系统中的唯一订单号匹配
			$out_trade_no = 6;
			//订单名称，显示在支付宝收银台里的“商品名称”里，显示在支付宝的交易管理的“商品名称”的列表里。
			$subject      = '鞋子';
			//订单描述、订单详细、订单备注，显示在支付宝收银台里的“商品描述”里
			$body         = '鞋子';
			//订单总金额，显示在支付宝收银台里的“应付总额”里
			$total_fee    = 200;



			//扩展功能参数——默认支付方式//

			//默认支付方式，取值见“即时到帐接口”技术文档中的请求参数列表
			$paymethod    = '';
			//默认网银代号，代号列表见“即时到帐接口”技术文档“附录”→“银行列表”
			$defaultbank  = '';


			//扩展功能参数——防钓鱼//

			//防钓鱼时间戳
			$anti_phishing_key  = '';
			//获取客户端的IP地址，建议：编写获取客户端IP地址的程序
			$exter_invoke_ip = '';
			//注意：
			//1.请慎重选择是否开启防钓鱼功能
			//2.exter_invoke_ip、anti_phishing_key一旦被使用过，那么它们就会成为必填参数
			//3.开启防钓鱼功能后，服务器、本机电脑必须支持SSL，请配置好该环境。
			//示例：
			//$exter_invoke_ip = '202.1.1.1';
			//$ali_service_timestamp = new AlipayService($aliapy_config);
			//$anti_phishing_key = $ali_service_timestamp->query_timestamp();//获取防钓鱼时间戳函数


			//扩展功能参数——其他//

			//商品展示地址，要用 http://格式的完整路径，不允许加?id=123这类自定义参数
			$show_url			= 'http://www.buqiu.com/order/myorder.php';
			//自定义参数，可存放任何内容（除=、&等特殊字符外），不会显示在页面上
			$extra_common_param = '';

			//扩展功能参数——分润(若要使用，请按照注释要求的格式赋值)
			$royalty_type		= "";			//提成类型，该值为固定值：10，不需要修改
			$royalty_parameters	= "";
			//注意：
			//提成信息集，与需要结合商户网站自身情况动态获取每笔交易的各分润收款账号、各分润金额、各分润说明。最多只能设置10条
			//各分润金额的总和须小于等于total_fee
			//提成信息集格式为：收款方Email_1^金额1^备注1|收款方Email_2^金额2^备注2
			//示例：
			//royalty_type 		= "10"
			//royalty_parameters= "111@126.com^0.01^分润备注一|222@126.com^0.01^分润备注二"

			/************************************************************/

			//构造要请求的参数数组
			$parameter = array(
					"service"			=> "create_direct_pay_by_user",
					"payment_type"		=> "1",
					
					"partner"			=> trim($aliapy_config['partner']),
					"_input_charset"	=> trim(strtolower($aliapy_config['input_charset'])),
					"seller_email"		=> trim($aliapy_config['seller_email']),
					"return_url"		=> trim($aliapy_config['return_url']),
					"notify_url"		=> trim($aliapy_config['notify_url']),
					
					"out_trade_no"		=> $out_trade_no,
					"subject"			=> $subject,
					"body"				=> $body,
					"total_fee"			=> $total_fee,
					
					"paymethod"			=> $paymethod,
					"defaultbank"		=> $defaultbank,
					
					"anti_phishing_key"	=> $anti_phishing_key,
					"exter_invoke_ip"	=> $exter_invoke_ip,
					
					"show_url"			=> $show_url,
					"extra_common_param"=> $extra_common_param,
					
					"royalty_type"		=> $royalty_type,
					"royalty_parameters"=> $royalty_parameters
			);

			//构造即时到帐接口
			$alipayService = new AlipayService($aliapy_config);
			$html_text = $alipayService->create_direct_pay_by_user($parameter);
			echo $html_text;

		}

		function return_url(){
				global $aliapy_config;
				//计算得出通知验证结果
				$alipayNotify = new AlipayNotify($aliapy_config);
				//$verify_result = $alipayNotify->verifyReturn();
				if(true) {//验证成功
					/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
					//请在这里加上商户的业务逻辑程序代码
					
					//——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
					//获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表
					$out_trade_no	= $_GET['out_trade_no'];	//获取订单号
					$trade_no		= $_GET['trade_no'];		//获取支付宝交易号
					$total_fee		= $_GET['price'];			//获取总价格

					if($_GET['trade_status'] == 'TRADE_FINISHED' || $_GET['trade_status'] == 'TRADE_SUCCESS') {
						//判断该笔订单是否在商户网站中已经做过处理（可参考“集成教程”中“3.4返回数据处理”）
							//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
						//如果有做过处理，不执行商户的业务程序

						$order=D('orders');
						$order->where(array('ordernum'=>$out_trade_no))->update(array('statu'=>2));
						if($order){
							unset($_SESSION['shop']);
							echo '您的订单付款成功！<a href="'.$GLOBALS['app'].'users">查看订单</a>';
						}else{
							echo '付款失败';
						}

					}
					else {
					  echo "trade_status=".$_GET['trade_status'];
					}
						
					echo "验证成功<br />";
					echo "支付宝交易号=".$trade_no;
					
					//——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
					
					/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
				}
				else {
					//验证失败
					//如要调试，请看alipay_notify.php页面的verifyReturn函数，比对sign和mysign的值是否相等，或者检查$responseTxt有没有返回true
					echo "验证失败";
				}
		}
		
		function notify_url(){
			global $aliapy_config;
			//计算得出通知验证结果
			$alipayNotify = new AlipayNotify($aliapy_config);
			$verify_result = $alipayNotify->verifyNotify();

			if($verify_result) {//验证成功
				/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
				//请在这里加上商户的业务逻辑程序代
				
				//——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
				//获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表
				$out_trade_no	= $_POST['out_trade_no'];	    //获取订单号
				$trade_no		= $_POST['trade_no'];	    	//获取支付宝交易号
				$total_fee		= $_POST['total_fee'];			//获取总价格

				if($_POST['trade_status'] == 'TRADE_FINISHED' ||$_POST['trade_status'] == 'TRADE_SUCCESS') {    //交易成功结束
					//判断该笔订单是否在商户网站中已经做过处理（可参考“集成教程”中“3.4返回数据处理”）
						//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
						//如果有做过处理，不执行商户的业务程序
					
					echo "success";		//请不要修改或删除

					//调试用，写文本函数记录程序运行情况是否正常
					//logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
				}
				else {
					echo "success";		//其他状态判断。普通即时到帐中，其他状态不用判断，直接打印success。

					//调试用，写文本函数记录程序运行情况是否正常
					//logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
				}
				
				//——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
				
				/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			}
			else {
				//验证失败
				echo "fail";

				//调试用，写文本函数记录程序运行情况是否正常
				//logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
			}
		}
	}