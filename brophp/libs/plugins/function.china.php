<?php
	function smarty_function_china(){
		$str=<<<html
		<script src='js/jquery.js'></script>
		<script>
		//选择省份
		function select_province(){
			$('#city').attr('onclick','select_city()');
			$('#city').children(":gt(0)").remove();
			$('#district').children(":gt(0)").remove();
			$.ajax({
				type:'post',
				url:'china.php?a=select_province',
				success:function(data){
					if(data!=0){
						eval("var province_list="+data);
							var str='';
							for(var i=0;i<province_list.length;i++){
								str+="<option onclick='select_province_ok(this)' value='"+province_list[i]['ProID']+"'>"+province_list[i]['ProName']+"</option>";
							}
							$('#province option:gt(0)').remove();
							$('#province').append(str);
					}else{
						alert('加载失败');
					}
				}
			})
		}
		function select_province_ok(obj){
			$('#province').removeAttr('onclick');
		}

		//选择城市
		function select_city(){
			$('#province').attr('onclick','select_province()');
			$('#district').attr('onclick','select_district()');
			$('#district').children(":gt(0)").remove();
			if($('#province option:selected').val()>0){
				$.ajax({
					type:'post',
					url:'china.php?a=select_city',
					data:"province_id="+$('#province option:selected').val(),
					success:function(data){
						if(data!=0){
							eval("var city_list="+data);
							var str='';
							for(var i=0;i<city_list.length;i++){
								str+="<option onclick='select_city_ok()' value='"+city_list[i]['CityID']+"'>"+city_list[i]['CityName']+"</option>";
							}
							$('#city option:gt(0)').remove();
							$('#city').append(str);
						}else{
							alert('加载失败');
						}
					}
				})
			}
		}
		function select_city_ok(){
			$('#city').removeAttr('onclick');
		}

		//选择区县
		function select_district(){
			$('#city').attr('onclick','select_city()');
			$('#district option:gt(0)').remove();
			if($('#city option:selected').val()>0){
				$.ajax({
					type:'post',
					url:'china.php?a=select_district',
					data:"city_id="+$('#city option:selected').val(),
					success:function(data){
						if(data!=0){
							eval("var district_list="+data);
							var str='';
							for(var i=0;i<district_list.length;i++){
								str+="<option onclick='select_district_ok()' value='"+district_list[i]['Id']+"'>"+district_list[i]['DisName']+"</option>";
							}
							$('#district option:gt(0)').remove();
							$('#district').append(str);
						}else{
							alert('加载失败');
						}
					}
				})
			}
		}
		function select_district_ok(){
			$('#district').removeAttr('onclick');
		}
		</script>
		<select id='province' onclick='select_province()'>
			<option value='-1'>请选择省份</option>
		</select>
		<select id='city' onclick='select_city()'>
			<option value='-1'>请选择城市</option>
		</select>
		<select id='district' onclick='select_district()'>
			<option value='-1'>请选择区县</option>
		</select>
html;
	return $str;
	}
?>