<?php
	/*+-----------------------------------------------------------------------------------------+
	  | ��ҳ���������
	  +-----------------------------------------------------------------------------------------+
	  | ��Ȩ���� lamp�ֵ���Դ����С��						
	  +-----------------------------------------------------------------------------------------+
	  | ����: ��� (lijie@li-jie.me)							
	  | ����޸�ʱ��: 2011-12-20 20:48  										
	  +-----------------------------------------------------------------------------------------+
	*/

	class Index {
		/*
			��ҳ������Ŀ����ʾ(����ģ�͵����ģ��)
		*/
		public function index(){
			if(empty($_GET['uid']) && $_SESSION['user_info']['id']){
				header("location:".B_APP."/index/index/uid/{$_SESSION['user_info']['id']}");
				//���uidΪ��,��ֱ����ת����ǰ��¼�û��ռ���ҳ
			}
			$speak = D("speak")->field("id,content")->order("ptime desc")->select(array("uid"=>$_GET['uid']));
			//��ѯ˵˵��Ϣ�б�
			$this->assign("user",D("user")->user_detail($_GET['uid']));
			//����userģ�͵�user_detail����
			$this->assign("total",D("user")->user_total($_GET['uid']));
			//����userģ�͵�user_total����
			$this->assign("log",D("log")->loglist($_GET['uid']));
			//����logģ�͵�loglist����
			$this->assign("speak",$speak);
			//��˵˵��Ϣ�б���䵽ģ��
			$this->assign("s_log_index",S_LOG_INDEX);
			//�������ļ�����ҳ��־��ʾ�����������ģ��
			$this->assign("fdata",D("friend")->friend_list($_GET['uid']));
			//�������б���Ϣ�����ģ��
			$this->assign("s_friend_index",S_FRIEND_INDEX);
			//�������ļ�����ҳ������ʾ�����������ģ��
			$this->assign("vdata",D("user")->v_list($_GET['uid']));
			//����userģ�͵�v_list����,������ֵ�����ģ��
			$this->assign("s_guest_index",S_GUEST_INDEX);
			////�������ļ�����ҳ�ÿ���ʾ�����������ģ��
			$this->assign("user_info",D("user")->user_info($_SESSION['fid']));
			//����userģ�͵�user_info����
			$this->display();//��ʾģ��
		}
		
		/*
			������Է���
		*/
		public function insert_message(){
			debug();//��ֹdebug��Ϣ����Ajax��������
			$_POST['ptime']=time();//��ȡ����ʱ��
			$_POST['ip']=sprintf("%u",ip2long($_SERVER['REMOTE_ADDR']));
			//��ȡ������IP
			D("message")->insert();//ִ���������
			D("user","bbs")->add_grade($_SESSION['user_info']['id'],S_MESS_REWARD);
			//����bbs��userģ�͵�add_grade����
			echo S_MESS_REWARD;//�����������
		}
		
		/*
			��ʾ�����б�
		*/
		public function message(){
			debug();//��ֹdebug��Ϣ����Ajax��������
			$suser = D("message");//����messageģ��
			$this->assign("mdata",$suser->message_index($_GET['uid']));
			//����messageģ�͵�message_index����,������ֵ���䵽ģ��
			$this->assign("s_mess_index",S_MESS_INDEX);
			//�������ļ���ҳ�������������䵽ģ��
			$this->display();//��ʾģ��
		}
		
		/*
			��ӷÿ���Ϣ
		*/
		public function visite(){
			$guest = D("guest");//����guest���ݱ�
			if($_SESSION['home_login']==1){
				if($_SESSION['user_info']['id']!=$_GET['uid']){
				//�жϵ�ǰ���ʿռ��Ƿ����Լ��Ŀռ�
					if($guest->field("id")->where(array("guest_id"=>$_SESSION['user_info']['id'],"uid"=>$_GET['uid']))->select()){
					//���������жϵ�ǰ��¼�û��Ƿ���ʹ����û�	
						$guest->where(array("guest_id"=>$_SESSION['user_info']['id'],"uid"=>$_GET['uid']))->update(array("vtime"=>time()));
						//�����ʹ����ķ���ʱ��
					}else{
						//��û�з��ʹ�,��ӷ�����Ϣ
						$guest->insert(array("uid"=>$_GET['uid'],"guest_id"=>$_SESSION['user_info']['id'],"vtime"=>time()));
					}
				}
			}else{
				return false;//���û�δ��¼���ؼ�
			}
			return true;//���򷵻���
		}
		
		/*
			�����֤��
		*/
		public function code(){
			echo new Vcode();//�����֤��
		}
	}