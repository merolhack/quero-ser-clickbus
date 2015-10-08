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
					success: function ( dataset ) {
						var obj = jQuery.parseJSON( dataset );
						$("#page_description").empty();
						$("#page_description").append("<h2>Tome sus billetes:</h2>");
						$.each( obj, function( key, value ) {
							$("#page_description").append("<p>"+value+"</p>");
						});
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
