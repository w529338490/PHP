<script charset="utf-8" src="<{$public}>/ke/kindeditor.js"></script>
<script>
	KindEditor.ready(function(K) {
		var editor1 = K.create('textarea[name="content"]', {
			width:'100%',
			height:'250px',
			afterCreate : function() {
				var self = this;
				K.ctrl(document, 3, function() {
					self.sync();
					K('form[name=notice]')[0].submit();
				});
				K.ctrl(self.edit.doc, 2, function() {
					self.sync();
					K('form[name=notice]')[0].submit();
				});
			},
			items : [
					'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
					'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
					'insertunorderedlist', '|', 'emoticons', 'link']
		});
		prettyPrint();
	});
</script>
