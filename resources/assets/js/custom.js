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

function getToolbarSimpleMDE(){
    return [
        "bold",
        "italic",
        "strikethrough",
        "heading",
        "heading-smaller",
        "heading-bigger",
        "heading-1",
        "heading-2",
        "heading-3",
        "quote",
        "ordered-list",
        "unordered-list",
        "|",
        "link",
        "image",
        "|",
        "preview"
    ];
}

$(function(){
    if ( $.isFunction($.fn.select2) ) {
        $('.form-select2').select2();
    }

    if ( $.isFunction($.fn.datepicker) ) {
        $('.date-picker').datepicker({});
    }
});
