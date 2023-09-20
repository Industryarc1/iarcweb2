function getSubCat(catid){
	$.ajax({url:"ajax.php",type: 'POST',data: {'action': 'getSubCat', 'catid': catid},success:function(result){
		$("#subCatAjax").html(result);
	}});
}
function getGalCat(catid){
	$.ajax({url:"ajax.php",type: 'POST',data: {'action': 'getGalCat', 'catid': catid},success:function(result){
		$("#galCatAjax").html(result);
	}});
}