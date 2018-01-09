<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty {html_textarea} function plugin
 *
 * Type:     function<br>
 * Name:     html_textarea<br>
 * Purpose:  输出富文本编辑器
 * @author 李捷 <lijie@li-jie.me>
 * @param size string 默认字号大小
 * @param default string 初始化编辑器的内容
 * @param form string 提交表单时，服务器获取编辑器提交内容的所用的参数，多实例时请给每个实例赋予不同的名字
 * @param focus string 是否获取焦点
 * @param index string 首行缩进
 * @param autoh boolean 是否自动长高
 * @param toolbar boolean 是否保持toolbar的位置不动
 * @param page string 分页符
 * @param minh string 最小高度
 * @param count boolean 是否开启字数统计
 * @param autoh boolean 是否自动长高
 * @param maxw int 最大字符数
 * @param pasteplain boolean 是否纯文本粘贴
 * @param autoclear boolean 是否自动清除默认内容
 * @param style string 文本框样式
 * @param Smarty
 * @return string
 */
function smarty_function_textarea($params, &$smarty){
    $textarea.='<script type="text/javascript" charset="utf-8" src="'.B_PUBLIC.'/ueditor/editor_config.js"></script>';   //引入配置文件
    $textarea.='<script type="text/javascript" charset="utf-8" src="'.B_PUBLIC.'/ueditor/editor_all.js"></script>';   //引入核心文件
    $textarea.='<link rel="stylesheet" type="text/css" href="'.B_PUBLIC.'/ueditor/themes/default/ueditor.css"/>';        //引入样式
	$textarea.="<script type='text/javascript'>
							var editor = new baidu.editor.ui.Editor({
							emotionLocalization:true,";
							if(!empty($params['size'])){							
							$textarea.="defaultFontSize:'{$params['size']}',";
							}
							if(!empty($params['default'])){							
							$textarea.="initialContent: '<font color=#cccccc>{$params['default']}</font>',";
							}
							if(!empty($params['form'])){							
							$textarea.="textarea : '{$params['form']}',";
							}
							if(!empty($params['index'])){							
							$textarea.="indentValue : '{$params['index']}',";
							}
							if(!empty($params['autoh'])){							
							$textarea.="autoHeightEnabled:'{$params['autoh']}',";
							}
							if(!empty($params['toolbar'])){							
							$textarea.="autoFloatEnabled: '{$params['toolbar']}',";
							}
							if(!empty($params['page'])){							
							$textarea.="pageBreakTag : '{$params['page']}',";
							}
							if(!empty($params['minh'])){							
							$textarea.="minFrameHeight: '{$params['minh']}',";
							}
							if(!empty($params['count'])){							
							$textarea.="wordCountMsg:'{$params['count']}',";
							}
							if(!empty($params['maxw'])){							
							$textarea.="maximumWords:'{$params['maxw']}',";
							}
							if(!empty($params['pasteplain'])){							
							$textarea.="pasteplain : '{$params['pasteplain']}',";
							}
							if(!empty($params['focus'])){							
							$textarea.="focus : '{$params['focus']}',";
							}
							if(!empty($params['autoclear'])){							
							$textarea.="autoClearinitialContent:'{$params['autoclear']}',";
							}
							if(!empty($params['family'])){							
							$textarea.="defaultFontFamily:'{$params['family']}'";
							}
							if($params['style']=='basic'){
								$textarea.="toolbars:[
									['Source','Bold','Italic','Underline','StrikeThrough','Superscript','Subscript','ForeColor','Emotion']
								]";
							}elseif($params['style']=='emotion'){
								$textarea.="toolbars:[
									['Emotion']
								]";
							}elseif($params['style']=='simple'){
								$textarea.="toolbars:[
									['FullScreen','Source','|','Undo','Redo','|',
													 'Bold','Italic','Underline','StrikeThrough','Superscript','Subscript','RemoveFormat','FormatMatch','|',
													 'BlockQuote','|',
													 'PastePlain','|',
													 'ForeColor','BackColor','InsertOrderedList','InsertUnorderedList','|',
													 'DirectionalityLtr','DirectionalityRtl','|','','Indent','|',
													 'JustifyLeft','JustifyCenter','JustifyRight','JustifyJustify','|',
													 'Link','Unlink','Anchor','|','Emotion','HighlightCode','|',
													 'Horizontal','Spechars','|',
													 'InsertTable','|',
													 'SelectAll','ClearDoc','Preview','Paragraph','RowSpacing','LineHeight','FontFamily','FontSize']
								]";
							}else{
								$textarea.="toolbars:[
													 ['FullScreen','Source','|','Undo','Redo','|',
													 'Bold','Italic','Underline','StrikeThrough','Superscript','Subscript','RemoveFormat','FormatMatch','|',
													 'BlockQuote','|',
													 'PastePlain','|',
													 'ForeColor','BackColor','InsertOrderedList','InsertUnorderedList','|',
													 'Paragraph','RowSpacing','LineHeight','FontFamily','FontSize','|',
													 'DirectionalityLtr','DirectionalityRtl','|','','Indent','|',
													 'JustifyLeft','JustifyCenter','JustifyRight','JustifyJustify','|',
													 'Link','Unlink','Anchor','|','ImageNone','ImageLeft','ImageRight','ImageCenter','|','InsertImage','Emotion','InsertVideo','Map','GMap','InsertFrame', 'PageBreak','HighlightCode','|',
													 'Horizontal','Date','Time','Spechars','|',
													 'InsertTable','DeleteTable','InsertParagraphBeforeTable','InsertRow','DeleteRow','InsertCol','DeleteCol','MergeCells','MergeRight','MergeDown','SplittoCells','SplittoRows','SplittoCols','|',
													 'SelectAll','ClearDoc','SearchReplace','Print','Preview','CheckImage','Help']
													 ]";
							}
							$textarea.='});
							editor.render("'.$params['name'].'");
						</script>';
	return $textarea;
}

/* vim: set expandtab: */

?>
