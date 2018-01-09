<?php
	class Index {
		/**
		 * 后台分帧界面
		 */	
		function index(){
			$this->caching=0;
			debug();
			$this->display();
		}	
		/**
		 * 后台的头界面
		 */
		function admin_top(){
			$this->caching=0;
			debug();
			$this->display();
		}
		/**
		 * 后台的菜单界面
		 */
		function left(){
			$this->caching=0;
			debug();
			$this->display();
		}
	}	
