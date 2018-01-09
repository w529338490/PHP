<{include file="public/header.tpl"}>
<script src="<{$public}>/ke/kindeditor.js"></script>
<script src="<{$public}>/js/common.js"></script>
<script src="<{$res}>/js/common.js"></script>
<script>
	KindEditor.ready(function(K) {
		var editor;
		KindEditor.ready(function(K) {
			editor = K.create('textarea[id="ke_content"]', {
				resizeType : 1,
				width:"100%",
				hright:"300px",
				allowPreviewEmoticons : false,
				allowImageUpload : false,
				items : [
					'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
					'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
					'insertunorderedlist', '|', 'emoticons', 'image', 'link']
			});
		});
	});
</script>
<script>
	$(function(){
		$("#title_input").click(function(){
			check_login();
		})
		$("#fast_post form").submit(function(){
			var content=$(".ke-edit-iframe").contents().find("body").text();
			if($("#title_input").val()==''){
				$("#mess").text("提示: 请输入标题");
				return false;
			}else if(content==''){
				$("#mess").text("提示: 请输入内容");
				return false;
			}else if(getlength(content,'utf8')<15){
				$("#mess").text("提示: 内容不能少于15个字符");
				return false;
			}
			return true;
		})
		$("#title_input").keydown(function(){
			$(this).next('b').text(150-getlength($(this).val(),'utf8'));
			if(150-getlength($(this).val(),'utf8')<=0){
				$(this).next('b').text('0');
				var title=$(this).val();
				$(this).val(title.substr(0,150));
			}
		})	
	})	
	//时间排序 主题类型排序
	$(function(){
		$('a.show_menu_icon').parent('span.menu_box').mouseover(function(){
			$(this).children('div').show();
		}).mouseout(function(){
			$(this).children('div').hide();
		})
		//时间排序
		var ptime=Array();
		ptime['0']='全部时间';
		ptime['86400']='一天之内';
		ptime['172800']='两天之内';
		ptime['604800']='一周之内';
		ptime['2592000']='一月之内';
		ptime['7776000']='三月之内';
		ptime['15552000']='半年之内';
		$("#time_order").text(ptime["<{$smarty.get.ptime}>"])
		$("body").click(function(){
			$(".time_order,.subj_type_order").hide();
		})
		//类型排序
		var type=Array();
		type['default']='默认排序';
		type['click_down']='点击量倒序';
		type['click_up']='点击量正序';
		type['no_down']='反对量倒序';
		type['no_up']='反对量正序';
		type['yes_down']='支持量倒序';
		type['yes_up']='支持量正序';
		type['time_down']='时间倒序';
		type['time_up']='时间正序';
		$("#subj_type_order").text(type["<{$smarty.get.order}>"]);
	})		
</script>
<script src="<{$res}>/js/post.js"></script>
<link rel="stylesheet" type="text/css" href="<{$res}>/css/subject_list.css">
<div id="main">
	<div id="nav_chain_box">
		<h2>板块导航</h2>	
		<{section loop=$zone_board_list name='zb'}>
			<dl>
				<dt><{$zone_board_list[zb].name}></dt>
				<{section loop=$zone_board_list[zb].sub_board name='sb'}>
					<dd>
						<{if $smarty.get.bid == $zone_board_list[zb].sub_board[sb].id}>
							<a href="<{$app}>/subject/index/bid/<{$zone_board_list[zb].sub_board[sb].id}>" style="color:#F26C4F">
						<{else}>
							<a href="<{$app}>/subject/index/bid/<{$zone_board_list[zb].sub_board[sb].id}>">
						<{/if}>
							<{$zone_board_list[zb].sub_board[sb].name}>
							</a>
					</dd>
				<{/section}>
			</dl>
		<{/section}>
	</div>
	
	<div id="subj_list">
		<div id="subj_title">
			<strong><{$board_name}></strong> 今日主题: <b><{$board_subj_num}></b>
		</div>
		<{if $board_name == '未知板块'}>
			<p style="border:1px dashed #F26C4F;padding:10px;margin-top:10px;">未知板块</p>
		<{else}>
		<div class="post_page">
			<a href="<{$app}>/subject/post_subj_page/bid/<{$smarty.get.bid}>"><img src="<{$res}>/images/pn_post.png"></a>
			<{$fpage}>
			<p class="clear"></p>
		</div>
		<div id="list_box">
			<table border="0" cellspacing="0" width="100%">
				<thead>
					<tr>
					<td class="filter">筛选:</td>
					<td class="title">
						<span class="menu_box">
						<a href="javascript:void(0)" class="show_menu_icon" id="time_order" style="display:inline">
							全部时间
						</a>
						<div class='hide_menu time_order'>
							<ul>
								<li>
									<a href='<{$app}>/subject/index/bid/<{$smarty.get.bid}>/ptime/0/order/<{$smarty.get.order|default:"default"}>'>全部时间</a>
								</li>
								<li>
									<a href='<{$app}>/subject/index/bid/<{$smarty.get.bid}>/ptime/86400/order/<{$smarty.get.order|default:"default"}>'>一天之内</a>
								</li>
								<li>
									<a href='<{$app}>/subject/index/bid/<{$smarty.get.bid}>/ptime/172800/order/<{$smarty.get.order|default:"default"}>'>两天之内</a>
								</li>
								<li>
									<a href='<{$app}>/subject/index/bid/<{$smarty.get.bid}>/ptime/604800/order/<{$smarty.get.order|default:"default"}>'>一周之内</a>
								</li>
								<li>
									<a href='<{$app}>/subject/index/bid/<{$smarty.get.bid}>/ptime/2592000/order/<{$smarty.get.order|default:"default"}>'>一月之内</a>
								</li>
								<li>
									<a href='<{$app}>/subject/index/bid/<{$smarty.get.bid}>/ptime/7776000/order/<{$smarty.get.order|default:"default"}>'>三月之内</a>
								</li>
								<li>
									<a href='<{$app}>/subject/index/bid/<{$smarty.get.bid}>/ptime/15552000/order/<{$smarty.get.order|default:"default"}>'>半年之内</a>
								</li>								
							</ul>
						</div>
						</span>
						排序:
						<span class="menu_box">
						<a href="javascript:void(0)" class="show_menu_icon" id="subj_type_order">默认排序</a>
						<div class="hide_menu subj_type_order">
							<ul>
								<li>
									<a href='<{$app}>/subject/index/bid/<{$smarty.get.bid}>/ptime/<{$smarty.get.ptime|default:0}>/order/default'>
										默认排序
									</a>
								</li>							
								<li>
									<a href='<{$app}>/subject/index/bid/<{$smarty.get.bid}>/ptime/<{$smarty.get.ptime|default:0}>/order/click_down'>
										点击量倒序
									</a>
								</li>
								<li>
									<a href='<{$app}>/subject/index/bid/<{$smarty.get.bid}>/ptime/<{$smarty.get.ptime|default:0}>/order/click_up'>
										点击量正序
									</a>
								</li>
								<li>
									<a href='<{$app}>/subject/index/bid/<{$smarty.get.bid}>/ptime/<{$smarty.get.ptime|default:0}>/order/no_down'>
										反对量倒序
									</a>
								</li>
								<li>
									<a href='<{$app}>/subject/index/bid/<{$smarty.get.bid}>/ptime/<{$smarty.get.ptime|default:0}>/order/no_up'>
										反对量正序
									</a>
								</li>
								<li>
									<a href='<{$app}>/subject/index/bid/<{$smarty.get.bid}>/ptime/<{$smarty.get.ptime|default:0}>/order/yes_down'>
										支持量倒序
									</a>
								</li>
								<li>
									<a href='<{$app}>/subject/index/bid/<{$smarty.get.bid}>/ptime/<{$smarty.get.ptime|default:0}>/order/yes_up'>
										支持量正序
									</a>
								</li>
								<li>
									<a href='<{$app}>/subject/index/bid/<{$smarty.get.bid}>/ptime/<{$smarty.get.ptime|default:0}>/order/time_down'>
										时间倒序
									</a>
								</li>
								<li>
									<a href='<{$app}>/subject/index/bid/<{$smarty.get.bid}>/ptime/<{$smarty.get.ptime|default:0}>/order/time_up'>
										时间正序
									</a>
								</li>									
							</ul>
						</div>
						</span>
						|
						<a href="<{$app}>/subject/index/bid/<{$smarty.get.bid}>/ptype/2">
							精华
						</a>
						|
						<a href="<{$app}>/subject/index/bid/<{$smarty.get.bid}>/ptype/3">
							推荐
						</a>
					</td>
					<td class="author">作者</td>
					<td class="comm_num">回复/查看</td>
					<td class="last_comm">最后评论</td>
					</tr>
				</thead>
				<tbody>
					<{section loop=$subj_list name='sbj'}>
						<tr>
							<td class="filter">
								<{if $subj_list[sbj].ptype == 1}>
									<img src="<{$res}>/images/pin_1.gif" />							
								<{elseif $subj_list[sbj].ptype == 6 }>
									<img src="<{$res}>/images/hot_3.gif" />
								<{elseif $subj_list[sbj].ptype == 2}>
									<img src="<{$res}>/images/digest_1.gif" />
								<{elseif $subj_list[sbj].ptype == 3}>
									<img src="<{$res}>/images/006.small.gif" />									
								<{elseif $subj_list[sbj].comm_num == 0}>
									<img src="<{$res}>/images/folder_common.gif" />
								<{else}>
									<img src="<{$res}>/images/folder_new.gif" />
								<{/if}>
								
							</td>
							<td class="title">
								<a href="<{$url}>/info/sid/<{$subj_list[sbj].id}>">
									<{$subj_list[sbj].title|truncate:'55'}>
								</a>
							</td>
							<td class="author">
								<a href="<{$root}>/space.php/index/index/uid/<{$subj_list[sbj].uid}>">
									<{$subj_list[sbj].author}>
								</a>
							</td>
							<td class="comm_num">
								<{$subj_list[sbj].comm_num}>/<{$subj_list[sbj].click_num}>
							</td>
							<{if $subj_list[sbj].comm_num > 0}>
								<td class="last_comm" style="width:134px">
									<a href="<{$root}>/space.php/index/index/uid/<{$subj_list[sbj].last_comm_id}>">
										<{$subj_list[sbj].last_comm_name}>
									</a>
									<br />
									<small><{$subj_list[sbj].last_comm_time|chinadate:'Y-m-d H:i:s'}></small>
								</td>								
							<{else}>
								<td>暂无</td>
							<{/if}>
						</tr>		
					<{sectionelse}>
						<tr><td colspan="5">暂无主题</td></tr>
					<{/section}>
				</tbody>
			</table>
		</div>
		<div class="post_page">
			<a href="<{$app}>/subject/post_subj_page/bid/<{$smarty.get.bid}>"><img src="<{$res}>/images/pn_post.png"></a>
			<{$fpage}>
			<p class="clear"></p>
		</div>
		<div id="fast_post">
			<form action="<{$app}>/subject/insert" method="post">
			<h4>快速发帖</h4>
			<p><b>标题:</b></p>
			<input type="text" name="title" id="title_input" maxlength="150" /> 你还可以输入 <b>150</b> 个字符<span id="mess"></span>
			<div id="post_zone">
				<textarea id="ke_content" name="content"></textarea>
				<input type="submit" value="发表" id="fast_btn"/>
				<span id="look">
				<input type="radio" name="state" value="1" checked />可回复
				<input type="radio" name="state" value="2" />禁止回复
				</span>
				<input type="hidden" value="<{$smarty.get.bid}>" name="bid" />
			</div>
			</form>
		</div>		
		<{/if}>
	</div>
</div>
<div id="pmbottom" style="height:100%;"></div>
<{include file="public/footer.tpl"}>
