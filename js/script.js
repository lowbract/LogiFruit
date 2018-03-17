// autocomplet : this function will be executed every time we change the text
function autocomplet(campo) {
	var min_length = 0; // min caracters to display the autocomplete
        var radice = campo.substr(0, 4);
        var idriga = campo.substring(5);
	var keyword = $('#'+ campo +'_txt').val();
	if (keyword.length >= min_length) {
            if (campo === 'clie') { percorsophp = 'js/cliente.php'; }
            if (campo === 'prod') { percorsophp = 'js/prodotto.php'; }
            if (campo === 'pez_') { percorsophp = 'js/pezzatura.php'; }
            if (campo === 'lavo') { percorsophp = 'js/lavorazione.php'; }
            if (campo === 'tpa_') { percorsophp = 'js/pallet.php'; }
            if (campo === 'imba') { percorsophp = 'js/imballo.php'; }
		$.ajax({
			url: percorsophp,
			type: 'POST',
			data: {keyword:keyword},
			success:function(data){
				$('#'+ campo +'_list').show();
				$('#'+ campo +'_list').html(data);
			}
		});
	} else {
		$('#'+campo+'_list').hide();
	}
}

// set_item : this function will be executed when we select an item
function set_item(campo,item,numar) { //assegna nome e id
	// change input value
	$('#'+campo+'_txt').val(item);
        $('#'+campo+'_hid').val(numar);
	// hide proposition list
	$('#'+campo+'_list').hide();
}