<?php
	/*+-----------------------------------------------------------------------------------------+
	  | ���Թ��������
	  +-----------------------------------------------------------------------------------------+
	  | ��Ȩ���� lamp�ֵ���Դ����С��						
	  +-----------------------------------------------------------------------------------------+
	  | ����: ��� (lijie@li-jie.me)							
	  | ����޸�ʱ��: 2011-12-29 12:31  										
	  +-----------------------------------------------------------------------------------------+
	*/

	Class Message{
		/*
			��ʾ���԰���ҳ
		*/
		public function index(){
			$this->display();//��ʾģ��
		}
		
		/*
			��ʾ���԰��б�ҳ��,������ҳ��Ajax����
		*/
		public function message(){
			debug();//��ֹdebug��Ϣ����Ajax��������
			$suser = D("message");//����messageģ��
			$this->assign("message_data",$suser->message_index($_GET['uid'],$fpage));
			//����messageģ�͵�message_index����,�������ݷ����ģ��
			$this->assign("fpage", $fpage);
			//����ҳ��Ϣ���䵽ģ��
			$this->display();//��ʾģ��
		}
		
		/*
			������԰����ݷ���
		*/
		public function insert_message(){
			debug();//��ֹdebug��Ϣ����Ajax��������
			$_POST['ptime']=time();
			$_POST['ip']=sprintf("%u",ip2long($_SERVER['SERVER_ADDR']));
			if(D("message")->insert()){//ִ���������
				D("user","bbs")->add_grade($_SESSION['user_info']['id'],S_MESS_REWARD);
				//���ӻ���
				echo S_MESS_REWARD;
				//������ֽ���
			}
		}
		
		/*
			ɾ�����Է���
		*/
		public function del_message(){
			echo D("message")->delete($_GET['mid']);
			//���ִ��ɾ�����Ե�Ӱ������
		}
	}