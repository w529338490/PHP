<?php
	class Form {
		/**
		 * 编辑器
		 * @param int $textareaid
		 * @param int $toolbar    有basic full 和desc三种
		 * @param int $color 编辑器颜色
		 * @param string $alowuploadexts 允许上传类型
		 * @param string $height 编辑器高度
		 * @param string $disabled_page 是否禁用分页和子标题
		 */
		public static function editor($textareaid = 'content', $toolbar = 'basic', $height = 200, $color = '', $up=true) {
			$str ='';
			if(!defined('EDITOR_INIT')) {
				$str = '<script type="text/javascript" src="'.$GLOBALS["public"].'ckeditor/ckeditor.js"></script>';
				define('EDITOR_INIT', 1);
			}
		
			if($toolbar == 'basic') {
				$toolbar = "['Bold', 'Italic','Underline','Strike','NumberedList', 'BulletedList', 'TextColor','BGColor', '-','Table','Smiley','SpecialChar'],
			   \r\n";
			} elseif($toolbar == 'full') {
			   $toolbar = "['Source','-','Templates'],
				['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print'],
				['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],['ShowBlocks'],['Image','Capture','Flash'],['Maximize'],
				'/',
				['Bold','Italic','Underline','Strike','-'],
				['Subscript','Superscript','-'],
				['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],
				['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
				['Link','Unlink','Anchor'],
				['Table','HorizontalRule','Smiley','SpecialChar'],
				'/',
				['Styles','Format','Font','FontSize'],
				['TextColor','BGColor'],
				['attachment'],\r\n";
			  
			} elseif($toolbar == 'desc') {
				$toolbar = "['Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink', '-', 'Image', '-','Source'],\r\n";
			
			} else {
				$toolbar = '';
			}
			$str .= "<script type=\"text/javascript\">\r\n";
			$str .= "CKEDITOR.replace( '$textareaid',{";

		


			$str .= "height:{$height},";
		
		
			if($color) {
				$str .= "extraPlugins : 'uicolor',uiColor: '$color',";
			}
			
			if($up) {	
				$str .="filebrowserImageUploadUrl:'".$GLOBALS["url"]."upimage',";
				$str .="filebrowserFlashUploadUrl:'".$GLOBALS["url"]."upflash',";
			}
			$str .= "toolbar :\r\n";
			$str .= "[\r\n";
			$str .= $toolbar;
			$str .= "]\r\n";
			//$str .= "fullPage : true";
			$str .= "});\r\n";
			$str .= '</script>';
			return $str;
		}
	}