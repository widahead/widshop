 $('#OfferServiceId').live('change', updatePrice);
 function updatePrice() {
	data = $('select#OfferServiceId').val();
		$.post(JS_BASE_URL+"services/getCalculatedPrice",{serviceId:data},function(result){
		$('#OfferTotAmount').val(result);
	});
}

$('.paymnt_opt').live('change', update_card_box);
function update_card_box() {
	if(this.value == 'DoDirectPayment') {
		$('#paypal_card_box').show();
	} else {
		$('#paypal_card_box').hide();
	}
}