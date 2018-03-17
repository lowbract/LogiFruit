// autocomplet : this function will be executed every time we change the text
function autocomplet(campo) {
	var min_length = 0; // min caracters to display the autocomplete
        var radice = campo.substr(0, 4);
        var idriga = campo.substring(4);
	var keyword = $('#'+ campo +'_txt').val();
	if (keyword.length >= min_length) {
            if (radice === 'clie') { percorsophp = 'js/cliente.php?id='+idriga; }
            if (radice === 'prod') { percorsophp = 'js/prodotto.php?id='+idriga; }
            if (radice === 'pezz') { percorsophp = 'js/pezzatura.php?id='+idriga; }
            if (radice === 'lavo') { percorsophp = 'js/lavorazione.php?id='+idriga; }
            if (radice === 'tpal') { percorsophp = 'js/pallet.php?id='+idriga; }
            if (radice === 'imba') { percorsophp = 'js/imballo.php?id='+idriga; }
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

function selezionami(valorecheck,campo) {
    document.getElementById(campo).selectedIndex = valorecheck;
    esito = document.getElementById(campo).selectedIndex
    //window.alert(esito);
}

function allertami(campo) {
    esito = document.getElementById(campo).selectedIndex
    //window.alert(esito);
}

function lampeggiami(campo,classe,tempoblink) { //"#IDcampo","background-color","red",100
    setInterval(cambiami_classe(campo,classe),tempoblink);
}
function cambiami_stile(campo,target,colore) {
    $(campo).css(target,colore);
}
function cambiami_classe(campo,classe) {
    $(campo).toggleClass(classe);
}
