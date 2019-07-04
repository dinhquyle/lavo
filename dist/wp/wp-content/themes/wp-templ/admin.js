var $ = jQuery;
$(document).ready(function() {
	$("#preview-action").remove();
	handleChildClick();
	handleParentClick();
});

function handleChildClick() {
	$('.categorydiv .children').find('input').each(function(index, input) {
		$(input).on('change', function() {
			var _this = $(this);
			var this_id = _this.parents('li').attr('id');
			var is_checked = _this.is(':checked');
			var numberOfChecked = _this.closest('ul').find('input:checked').length;
			var numberOfInput = _this.closest('ul').find('input').length;

			// _this.parents('ul').children('li').each(function(){
			// 	if(!$(this).parent().is("ul.children")) $(this).children('label').children('input').prop('checked', false);
			// })
					
			if(is_checked) {
				if(numberOfChecked == numberOfInput){
					_this.parents('li').children('label').children('input').prop('checked', true);
				}
			}else{
				if(numberOfChecked < numberOfInput){
					_this.parents('li').children('label').children('input').removeAttr('checked');
				}
			}
		});
	});
}

function handleParentClick(){
	$('.categorydiv .categorychecklist > li label input').each(function(){
		$(this).on('change', function() {
			var _this = $(this);
			var is_checked = _this.is(':checked');
			var numberOfInput = _this.parents('li').children('ul').find('input').length;
			var numberOfChecked = _this.parents('li').children('ul').find('input:checked').length;
			if(is_checked){
				if(numberOfChecked != numberOfInput){
					_this.closest('li').children('ul').find('input').each(function(){
						$(this).attr('checked', 'checked');
					})
				}
			}else{
				if(numberOfChecked == numberOfInput){
					_this.closest('li').children('ul').find('input').each(function(){
						$(this).removeAttr('checked');
					})
				}
			}
		})
	})
}