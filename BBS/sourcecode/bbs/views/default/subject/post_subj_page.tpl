<{include file="public/header.tpl"}>
<link rel="stylesheet" type="text/css" href="<{$res}>/css/post_subj_page.css">
<script src="<{$public}>/ke/kindeditor.js"></script>
<script src="<{$public}>/js/common.js"></script>
<script>
KindEditor.ready(function(K) {
	var editor;
	KindEditor.ready(function(K) {
		editor = K.create('textarea[id="ke_content"]', {
			resizeType : 1,
			width:'100%',
			height:'400px',
			allowPreviewEmoticons : false,
			allowImageUpload : false
		});
	});
});
</script>
<script>
	$(function(){
		//标题字符限制
		$("#post_title").keydown(function(){
			$(this).next('b').text(150-getlength($(this).val(),'utf8'));
			if(150-getlength($(this).val(),'utf8')<=0){
				$(this).next('b').text('0');
				var title=$(this).val();
				$(this).val(title.substr(0,150));
			}
		})		
		//判断是否登录
		$("#post_title,#post_btn").click(function(){
			if(!check_login()){
				$("#post_title").blur();
			}
		})	
		//标题与内容检测
		$("#post_box form").submit(function(){
			var content_text=$(".ke-edit-iframe").contents().find("body").text();
			if($("#post_title").val()==''){
				$("#mess").text("提示: 请输入标题");
				window.scrollTo(0,0);
				return false;
			}else if(content_text==''){
				window.scrollTo(0,0);
				$("#mess").text("提示: 请输入内容");
				return false;
			}else if(getlength(content_text,'utf8')<15){
				window.scrollTo(0,0);
				$("#mess").text("提示: 内容不能少于15个字符");
				return false;
			}
			$('#post_box form').attr("action","<{$app}>/subject/insert").attr("method",'post');
			return true;
		})
	})
</script>
	<div id="main">
	<div id="post_box">
		<h2>发表主题</h2>
		<form>
			<select name="bid" id="board_list">
				<{html_options options=$board_list selected=$smarty.get.bid}>
			</select>
			<input type="text" name="title" id="post_title" maxlength="150" /> 你还可以输入 <b>150</b> 个字符  <span id="mess"></span>
			<p style="height:5px;"></p>
			<textarea id="ke_content" name="content"></textarea>
			<input type="submit" value="发表" id="post_btn"/>
			<input type="radio" checked="" value="1" name="state">
			可回复
			<input type="radio" value="2" name="state">
			禁止回复 			
		</form>
	</div>	
	</div>

<{include file="public/footer.tpl"}>