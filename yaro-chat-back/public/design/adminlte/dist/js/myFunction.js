function check_all(){

	if($('input[class=check_all]:checkbox:checked').length == 1){

		$('input[class=item_checkbox]').each(function(index, el) {
			$(this).prop('checked', true);
		});

	}else{
		$('input[class=item_checkbox]').each(function(index, el) {
			$(this).prop('checked', false);
		});
	}

}

function delete_all(){

	$(document).on('click', '.delBtn' , function() {

		$('#multipleDelete').modal('show');

		if ( $('input[class=item_checkbox]:checked').length > 0 ) {

			var value = $('input[class=item_checkbox]:checked').length;

			$('.record_count').text(value);
			$('.not_empty_record').removeClass('hidden');
			$('.empty_record').addClass('hidden');

		}else {
			$('.record_count').text('');
			$('.not_empty_record').addClass('hidden');
			$('.empty_record').removeClass('hidden');

		}
		$(document).on('click', '.del_all', function() {

			$('#form_delete').submit();

		});
	});

}