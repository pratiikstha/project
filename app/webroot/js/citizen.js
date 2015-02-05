$(document).ready(function() {
	$('#CitizenAddForm select#CitizenZone').change(function() {
		zone = $('#CitizenAddForm select#CitizenZone').val();
		$('#CitizenAddForm select#CitizenBirthZone').val(zone);
		$.getJSON('getDistricts/'+zone, {}, function(data) {
			$('#CitizenAddForm select#CitizenDistrict').find("option").remove();
			$('#CitizenAddForm #CitizenDistrict').append("<option value=''>-</option>");
			$.each(data, function(index,value){
				var id = $.trim(index);
				var district = $.trim(value);
				$('#CitizenAddForm #CitizenDistrict').append("<option value='"+id+"'>"+district+"</option>");
			});
		});
	});

	$('#CitizenAddForm select#CitizenRegion').change(function() {
		region = $('#CitizenAddForm select#CitizenRegion').val();
		//$('#CitizenAddForm select#CitizenBirthRegion').val(zone);
		$.getJSON('getZones/'+region, {}, function(data) {
			$('#CitizenAddForm select#CitizenZone').find("option").remove();
			$('#CitizenAddForm select#Citizenzone').append("<option value=''>-</option>");
			$.each(data, function(index,value){
				var id = $.trim(index);
				var zone = $.trim(value);
				$('#CitizenAddForm #CitizenZone').append("<option value='"+id+"'>"+zone+"</option>");
			});
		});
	});

	$('#CitizenAddForm select#CitizenBirthregion').change(function() {
		region = $('#CitizenAddForm select#CitizenBirthregion').val();
		//$('#CitizenAddForm select#CitizenBirthRegion').val(zone);
		$.getJSON('getZones/'+region, {}, function(data) {
			$('#CitizenAddForm select#CitizenBirthzone').find("option").remove();
			$('#CitizenAddForm select#CitizenBirthzone').append("<option value=''>-</option>");
			$.each(data, function(index,value){
				var id = $.trim(index);
				var zone = $.trim(value);
				$('#CitizenAddForm #CitizenBirthzone').append("<option value='"+id+"'>"+zone+"</option>");
			});
		});
	});

	$('#CitizenAddForm select#CitizenBirthzone').change(function() {
		zone = $('#CitizenAddForm select#CitizenBirthzone').val();
		$.getJSON('getDistricts/'+zone, {}, function(data) {
			$('#CitizenAddForm select#CitizenBirthdistrict').find("option").remove();
			$('#CitizenAddForm #CitizenBirthdistrict').append("<option value=''>-</option>");
			$.each(data, function(index,value){
				var id = $.trim(index);
				var district = $.trim(value);
				$('#CitizenAddForm #CitizenBirthdistrict').append("<option value='"+id+"'>"+district+"</option>");
			});
		});
	});

	$('#CitizenAddForm select#CitizenVmsOption').change(function() {
		vms = $('#CitizenAddForm select#CitizenVmsOption').val();
		$.getJSON('getVms/'+vms, {}, function(data) {
			$('#CitizenAddForm select#CitizenVmsName').find("option").remove();
			$('#CitizenAddForm #CitizenVmsName').append("<option value=''>-</option>");
			$.each(data, function(index,value){
				var id = $.trim(index);
				var district = $.trim(value);
				$('#CitizenAddForm #CitizenVmsName').append("<option value='"+id+"'>"+district+"</option>");
			});
		});
	});

	$('#CitizenAddForm select#CitizenBirthVmsOption').change(function() {
		vms = $('#CitizenAddForm select#CitizenBirthVmsOption').val();
		$.getJSON('getVms/'+vms, {}, function(data) {
			$('#CitizenAddForm select#CitizenBirthVmsName').find("option").remove();
			$('#CitizenAddForm #CitizenBirthVmsName').append("<option value=''>-</option>");
			$.each(data, function(index,value){
				var id = $.trim(index);
				var district = $.trim(value);
				$('#CitizenAddForm #CitizenBirthVmsName').append("<option value='"+id+"'>"+district+"</option>");
			});
		});
	});
	$("a#test").fancybox({
		'titlePosition':'outside',
		'overlayColor':'#000',
		'overlayOpacity':0.9
	});
});