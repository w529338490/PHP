<{include file="public/header.tpl"}>
	<link rel="stylesheet" type="text/css" href="<{$res}>/css/index.css" />
	<script src="<{$res}>/js/common.js"></script>
	<script>
		$(function(){
			//默认"最新主题"被选中,加载背景色为白色的.option_card样式 其他的暂时隐藏
			$("#boxs .title ul li:first").addClass('option_card');
			$("#boxs .option_box .option_content:not(:first)").hide();
			//鼠标移动上去的时候,就显示相应的列表
			$("#boxs .title ul li").mouseover(function(){
				$(this).addClass('option_card').siblings("li").removeClass('option_card');
				$("#boxs .option_box .option_content:eq("+$(this).index()+")").show().siblings(".option_content").hide();
			})
		})	
	</script>
	<div id="main">
		<div id="boxs">
			<div class="side_box left_box box">
				<h1>热门主题</h1>
				<ul>
				<{section loop=$hot_subj name='hot_subj'}>
					<li>
						<strong>
							<a href="<{$app}>/subject/info/sid/<{$hot_subj[hot_subj].id}>"><{$hot_subj[hot_subj].title|truncate:'25'}></a>
						</strong>
						<span>
							<a href="<{$root}>/space.php/index/index/uid/<{$hot_subj[hot_subj].uid}>">
								<{$hot_subj[hot_subj].user_name|truncate:'8'}>
							</a>
						</span>
					</li>			
				<{sectionelse}>
				<li>暂无</li>
				<{/section}>
				</ul>
			</div>
			<div class="option_box">
				<div class="title">
					<ul>
						<li>最新主题</li>
						<li class="center">最新新闻</li>
						<li>最新公告</li>
					</ul>
				</div>
				<!--最新主题-->
				<div class="option_content">
					<ul>
						<{section loop=$new_subj name='new_subj'}>
							<li>
								<strong>
									<a href="<{$app}>/subject/info/sid/<{$new_subj[new_subj].id}>">
										<{$new_subj[new_subj].title|truncate:'25'}>
									</a>
								</strong>
								<span>
									<a href="<{$root}>/space.php/index/index/uid/<{$new_subj[new_subj].uid}>">
										<{$new_subj[new_subj].user_name|truncate:'8'}>
									</a>
								</span>
							</li>			
						<{sectionelse}>
						<li>暂无</li>
						<{/section}>			
					</ul>
				</div>
				<!--最新新闻-->
				<div class="option_content">
					<ul>
						<{section loop=$news name='news'}>
							<li>
								<strong>
									<a href="<{$app}>/news/info/nid/<{$news[news].id}>">
										<{$news[news].title|truncate:'25'}>
									</a>
								</strong>
								<span>
									<a href="<{$root}>/space.php/index/index/uid/<{$news[news].uid}>">
										<{$news[news].user_name|truncate:'8'}>
									</a>
								</span>
							</li>			
						<{sectionelse}>
						<li>暂无</li>
						<{/section}>
					</ul>
				</div>	
				<!--最新公告-->
				<div class="option_content">
					<ul>
						<{section loop=$notice name='notice'}>
							<li>
								<strong>
									<a href="<{$app}>/notice/info/ncid/<{$notice[notice].id}>"><{$notice[notice].title|truncate:'25'}></a>
								</strong>
								<span>
									<a href="<{$root}>/space.php/index/index/uid/<{$notice[notice].uid}>">
										<{$notice[notice].user_name|truncate:'8'}>
									</a>
								</span>
							</li>			
						<{sectionelse}>
						<li>暂无</li>
						<{/section}>									
					</ul>
				</div>				
			</div>
			<div class="side_box right_box box">
				<h1>最新日志</h1>
				<ul>
					<{section loop=$log name='log'}>
						<li>
							<strong>
								<a href="<{$root}>/space.php/log/content/uid/<{$log[log].uid}>/lid/<{$log[log].id}>">
									<{$log[log].title|truncate:'25'}>
								</a>
							</strong>
							<span>
								<a href="<{$root}>/space.php/index/index/uid/<{$log[log].uid}>">
									<{$log[log].user_name|truncate:'8'}>
								</a>
							</span>
						</li>			
					<{sectionelse}>
					<li>暂无</li>
					<{/section}>							
				</ul>				
			</div>
			<div class="clear"><><iv>
		</div>
		<div id="site_info">
			<p>
				今日: <b><{$today_sbj_num}></b>
				|
				昨日: <b><{$yesterday_sbj_num}></b>
				|
				主题:<b><{$total_sbj_num}></b>
				|
				帖子: <b><{$total_comm_num}></b>
				|
				会员: <b><{$user_total_num}></b>
				|
				欢迎新会员: <b><a href="<{$root}>/space.php/index/index/uid/<{$new_user.id}>"><{$new_user.name}></a></b>
				
			</p>
		</div>
		<div id="board_list">
		<!--分区板块-->
		<{section loop=$board_list name='bl'}>
			<div class="board_box">
				<h1><a href="<{$app}>/board/index/zid/<{$board_list[bl].zid}>"><{$board_list[bl].name}></a></h1>
				
				<div class="board_content">
					<table border="0" cellspacing="0" width="100%">
						<tr>
							<{section loop=$board_list[bl].sub_board name='sb'}>
							<{if $smarty.section.sb.rownum % 4 == 0}>
								</tr>
								<tr>
							<{/if}>
							<td width="32.9%">
								<div class="board_icon">
									<a href="<{$app}>/subject/index/bid/<{$board_list[bl].sub_board[sb].id}>">
										<img src="<{$public}>/uploads/board/<{$board_list[bl].sub_board[sb].img_path}>" />
									<a/>
								</div>
								<dl>
									<dt>
										<a href="<{$app}>/subject/index/bid/<{$board_list[bl].sub_board[sb].id}>">
											<{$board_list[bl].sub_board[sb].name}>
										</a>
									</dt>
									<dd>
										<small>
											主题:<{$board_list[bl].sub_board[sb].subj_num}>, 贴数:<{$board_list[bl].sub_board[sb].comm_num}>
										</small>
									</dd>
									<dd>版主:
										<a href="<{$root}>/space.php/index/index/uid/<{$board_list[bl].sub_board[sb].master}>">
											<{$board_list[bl].sub_board[sb].master_name}>
										</a>
									</dd>
								</dl>
							</td>
								<{if $smarty.section.sb.last && $smarty.section.sb.rownum % 3 == 2}>
									<td width="32.9%">&nbsp;</td>
								<{elseif $smarty.section.sb.last && $smarty.section.sb.rownum % 3 == 1}>
									<td width="32.9%">&nbsp;</td>
									<td width="32.9%">&nbsp;</td>
								<{/if}>
							<{/section}>
						</tr>
					</table>
				</div>
			</div>		
		<{/section}>
		</div>
	</div>
	<{if $flink}>
	<div id="flink">
		友情连接:
		<{section loop=$flink name='link'}>
			<a href="<{$flink[link].site}>"><{$flink[link].name}></a>
		<{/section}>
	</div>
	<{/if}>
<{include file="public/footer.tpl"}>
