// put custom script in here...
function showLoading() {
  $('#loading').fadeIn('fast');
}

function hideLoading() {
  $('#loading').fadeOut('fast');
}

function fixRequestGet(url) {
	if(url.indexOf("?") !== -1) 
		return url += "&"; 
	else 
		return url += "?";
}

$(function(){
	$('.form-select2').select2();

	$('.date-picker').datepicker({});
});