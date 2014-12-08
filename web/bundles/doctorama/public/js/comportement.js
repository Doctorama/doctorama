$(document).ready(function(){

	// Ajout des champs encadrants dans la création d'un dossier
	$("#plus_enc").css("cursor","pointer");
	$("#plus_enc").click(function(){
		$(this).before('<input type="text" class="form-control" name="enc_th[]" style="margin-top:15px;" placeholder="Encadrant de la thèse">');
	});

	// Gestion du type d'affichage lors des listes des doctorants
	$('.vue-liste-doctorant').hide();
	$('#btn_grille').click(function(){
		$('.vue-liste-doctorant').hide();
		$('.vue-grille-doctorant').show();
	});
	$('#btn_list').click(function(){
		$('.vue-grille-doctorant').hide();
		$('.vue-liste-doctorant').show();
	});

});