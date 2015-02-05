function keyupAction(formname, fieldName) {
	var ctzn = $('#' + formname + fieldName).val();
	var listElm =  $('#' + fieldName + '_List');
	if (ctzn == '') {
		listElm.css('display', 'none');
		return false;
	}
	
	$.getJSON('../citizens/getCitizenList/'+ctzn, {}, function(data) {
		listElm.css('display', 'block');
		listElm.find("a").remove();
		listElm.find("br").remove();
		$.each(data, function(index,value){
			$.each(value, function(k,v){
				var id = $.trim(k);
				var info = $.trim(v);
				listElm.append("<a href='#' onclick='setValue(\"" + formname + "\", \"" + id + "\", \"" + info + "\", \"" + fieldName + "\")'>" + info + "</a><br>");
			});
		});
	});
}

function setValue(formname, id, info, fieldName) {
	var elmCitizenName = '#' + formname + fieldName;
	var elmHidden = '#' + formname + fieldName + 'Id';
	var elmList = '#' + fieldName + '_List';
	$(elmCitizenName).val(info);
	$(elmHidden).val(id);
	$(elmList).find("a").remove();
	$(elmList).find("br").remove();
	$('div.' + fieldName + '_List').css('display', 'none');
}