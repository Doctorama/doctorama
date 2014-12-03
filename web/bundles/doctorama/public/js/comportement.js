$("#plus_enc").css("cursor","pointer");

$("#plus_enc").click(function(){
	$(this).before('<input type="text" class="form-control" name="enc_th[]" style="margin-top:15px;" placeholder="Encadrant de la thèse">');
});