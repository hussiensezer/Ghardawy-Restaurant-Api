$(document).ready(function(){
	'use strict';
	//LoginController Register Validation
	if($("form.form-horizontal").attr("novalidate")!=undefined){
		$("input,select,textarea").not("[type=submit]").jqBootstrapValidation();
	}

	// Remember checkbox
	if($('.chk-remember').length){
		$('.chk-remember').iCheck({
			checkboxClass: 'icheckbox_square-blue',
			radioClass: 'iradio_square-blue',
		});
	}

	// For change default year in copyright
	var $year = new Date().getFullYear();
	$(".year").text($year);
});
