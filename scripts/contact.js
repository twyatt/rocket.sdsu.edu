$(document).ready(function() {
	$('form#contact #recaptcha_response_field').addClass('required');
	
	var options = {
		target:       '#contact_container',
		dataType:     'script',
		beforeSubmit: checkContactForm,
		error:        failure
	};
	
	$('form#contact').submit(function() {
		$(this).ajaxSubmit(options);
		return false;
	});
});

function checkContactForm(formData, jqForm, options) {
	$('.required').removeClass('invalid');
	return true;
}

function failure(xhr, status, errMsg) {
	alert(xhr.responseText);
}

/**
 * Marks fields as being invalid (in error).
 *
 * @param array fields
 */
function error(fields) {
	for (var i = 0; i < fields.length; i++) {
		var field = fields[i];
		$('#' + field).addClass('invalid');
	}
}

function success(html) {
	$('#contact_container').html(html);
}

function recaptcha(error) {
	$.ajax({
		url: 'plugins/recaptcha?error=' + error,
		success: function(data) {
			$('#recaptcha').html(data);
		}
	});
}
