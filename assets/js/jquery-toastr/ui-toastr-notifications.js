function Notify(msg, title, type) {
	toastr.options = {
		"closeButton": false,
		"debug": false,
		"positionClass": "toast-top-right",
		"onclick": null,
		"showDuration": "300",
		"hideDuration": "1000",
		"timeOut": "5000",
		"extendedTimeOut": "1000",
		"showEasing": "swing",
		"hideEasing": "linear",
		"showMethod": "fadeIn",
		"hideMethod": "fadeOut",
		"preventDuplicates": true,
		"maxOpened": 1,
		"autoDismiss": true
	}
	toastr.clear();
	var $toast = toastr[type](msg, title);
}