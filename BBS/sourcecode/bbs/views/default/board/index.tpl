<{include file="public/header.tpl"}>
<{nocache}>
<link rel="stylesheet" type="text/css" href="<{$res}>/css/board_index.css" />
<div id="main">
	<div class="sub_board_box">
		<h1><a href="<{$app}>/board/index/zid/<{$zone.zid}>"><{$zone.name}></a></h1>
		<div class="sub_info">
			<table width="100%" border="0" cellspacing="0">
				<{section loop=$sub_board_list name='sb'}>
					<tr>
						<td style='width:64px'>
							<a href="<{$app}>/subject/index/bid/<{$sub_board_list[sb].id}>">
								<img src="<{$public}>/uploads/board/<{$sub_board_list[sb].img_path}>" />
							</a>
						</td>
						<td>
							<h3>
								<a href="<{$app}>/subject/index/bid/<{$sub_board_list[sb].id}>"><{$sub_board_list[sb].name}></a>
								<small>(<{$sub_board_list[sb].sub_board_today_subj_num}>)</small>
							</h3>
							<p>
								版主:<a href="<{$root}>/space.php/index/index/uid/<{$sub_board_list[sb].master}>">
										<{$sub_board_list[sb].master_name}>
									</a>
							</p>
						</td>
						<td style='width:150px'>
							<{$sub_board_list[sb].sub_board_total_sbj_num}>
							/
							<{$sub_board_list[sb].sub_board_total_comm_num}>
						</td>
						<td style='width:220px'>
							<p>
								<a href="<{$app}>/subject/info/sid/<{$sub_board_list[sb].last_sbj_id}>">
									<{$sub_board_list[sb].last_sbj_title|truncate:'30'}>
								</a>
							</p>
							<{if $sub_board_list[sb].last_sbj_id >= 1}>
								<p>
									<{$sub_board_list[sb].last_sbj_time|chinadate:'Y-m-d H:i:s'}>
									<a href="<{$root}>/space.php/index/index/uid/<{$sub_board_list[sb].last_sbj_user_id}>">
										<{$sub_board_list[sb].last_sbj_user_name}>
									</a>
								</p>							
							<{/if}>
						</td>
					</tr>						
				<{/section}>				
			</table>
		</div>
	</div>			
</div>
<{/nocache}>
<{include file="public/footer.tpl"}>