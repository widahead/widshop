 $('#OfferServiceId').live('change', updatePrice);
 function updatePrice() {
        data = $('select#OfferServiceId').val();
			$.post(JS_BASE_URL+"services/getCalculatedPrice",{serviceId:data},function(result){
			$('#OfferTotAmount').val(result);
		});
    }