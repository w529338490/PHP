<?php
	/*+-----------------------------------------------------------------------------------------+
	  | ˵˵���������
	  +-----------------------------------------------------------------------------------------+
	  | ��Ȩ���� lamp�ֵ���Դ����С��						
	  +-----------------------------------------------------------------------------------------+
	  | ����: ��� (lijie@li-jie.me)							
	  | ����޸�ʱ��: 2011-12-22 02:03  										
	  +-----------------------------------------------------------------------------------------+
	*/

	class Speak{
	
		/*
			��ʾindexģ��,����������Ajax����
		*/
		public function index(){
			$this->display();
			//��ʾģ��
		}
		
		/*
			���˵˵����,�����û�������Ӧ�Ļ���
		*/
		public function insert(){
			debug();//�ر�debug
			$_POST['ptime']=time();
			//��ȡ���˵˵ʱ��
			$_POST['ip']=sprintf("%u",ip2long($_SERVER['REMOTE_ADDR']));
			//��ȡ�ͻ���IP��ַ
			if(D("speak")->insert()){//ִ�����
				D("user","bbs")->add_grade($_SESSION['user_info']['id'],S_SPEAK_REWARD);
				//����bbsӦ�õ�userģ�͵�add_grade����
				echo S_SPEAK_REWARD;
				//�����������
			}
		}
		
		/*
			��ʾ˵˵�б�,����Ajax��ҳ����
		*/
		public function speak(){
			$sdata = D("speak")->speak_list($_GET['uid'],$fpage);
			//����speakģ�͵�speak_list����
			$this->assign("sdata",$sdata);
			//�����ݷ����ģ��
			$this->assign("fpage", $fpage);
			//����ҳ��Ϣ�����ģ��
			$this->display();
			//��ʾģ��
		}
		
		/*
			ɾ��˵˵,����ɾ��˵˵�Ļظ�
		*/
		public function sdel(){
			if(D("speak")->delete($_GET['sid'])){//ִ��ɾ��˵˵
				D("speak_comm")->delete(array("sid"=>$_GET['sid']));
				//ִ��ɾ��˵˵�����лظ�
			}
		}
		
		/*
			ɾ��˵˵�Ļظ�
		*/
		public function del(){
			D("speak_comm")->delete($_GET['cid']);
			//ɾ��˵˵�ĵ����ظ�
		}
		
		/*
			���˵˵�Ļظ�
		*/
		public function insert_c(){
			debug();//�ر�debug
			$_POST['ptime']=time();
			//��ȡ��ǰʱ��
			$_POST['ip']=sprintf("%u",ip2long($_SERVER['REMOTE_ADDR']));
			//��ȡ����ظ��Ŀͻ���IP��ַ
			if(D("speak_comm")->insert()){
			//ִ�����
				D("user","bbs")->add_grade($_SESSION['user_info']['id'],S_SPEAK_REWARD);
				//����bbsӦ���µ�userģ�͵�add_grade����
				echo S_SPEAK_REWARD;
				//�����������
			}
		}
	}