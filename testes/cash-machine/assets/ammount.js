$(document).ready(function() {
	$('#form_ammount').on('submit', function( event ) {
		event.preventDefault();
		var currency = $('#form_ammount input[name=monto]').val();
		if ( currency.length > 0 ) {
			var number = Number(currency.replace(/[^0-9\.]+/g,""));
			if ( number >= 10 ) {
				$.ajax({
					url: 'ammount/'+number,
					type: 'POST',
					success: function ( algo ) {
						console.log( algo );
					}
				});
			} else {
				alert('Ingrese un monto mayor a $10');
			}
		} else {
			alert('Ingrese un campo del tipo: $123,456.78');
		}
	});
});
