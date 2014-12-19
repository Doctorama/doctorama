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
	
	//Pagination
	$(".btn_nb_par_page").click(function(){
		var nb_visible = this.value;
		var nb_doctorant = $("tr").length - 1;
		var nb_page = Math.ceil(nb_doctorant/nb_visible);
		
		$('.active').removeClass("active btn-info");
		$(this).addClass("active btn-info");
		
		$("article:nth-child(n+"+nb_visible+")").hide();
		$("article:nth-child(-n+"+nb_visible+")").show();
		
		$("tr:nth-child(n+"+nb_visible+")").hide()
		$("tr:nth-child(-n+"+nb_visible+")").show();
		
		var html = '<li><a href="#"><span aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span></a></li>';
		for(var i = 1; i <=nb_page; i++)
		{
			html+=' <li><a href="#" class="page">'+i+'</a></li>';
		}
		html+='<li><a href="#" ><span aria-hidden="true">&raquo;</span><span class="sr-only">Next</span></a></li>';
		$('.pagination').html(html);
	});
	
	$(document).on('click','.page',function(){
		
		var num_page = this.text;
		var nb_visible = $('.active.btn-info').html();
		
		var deb = (num_page-1)*nb_visible + 1;
		var fin = num_page*nb_visible;
		
		$("article").hide();
		$("article:nth-child(n+"+deb+"):nth-child(-n+"+fin+")").show();
		
		$("tr").hide();
		$("tr:nth-child(n+"+deb+"):nth-child(-n+"+fin+")").show();
	});

	//Modification template fiche de suivi
	$(document).on('click','#add_question',function(){
		var input = $(this).parent().parent().find('#add_input_question');
		var question = input.val();
		var template = input.attr('class').split(' ').slice(-1);

		var html = '';
		if(question!=''){
			var exist = $('.tractive');
			if(exist.length > 0)
			{
				html+='<input type="hidden" value="'+question+'" name="question[]"/><td>'+question+'</td><td> <i class="btn-sm btn-danger sup_question">Supprimer</i> <i class="btn-sm btn-warning modif_question">Modifier</i> </td>';
				exist.html(html);
				exist.removeClass('tractive');
			}
			else
			{
				html+='<tr><input type="hidden" value="'+question+'" name="question[]"/><td>'+question+'</td><td> <i class="btn-sm btn-danger sup_question">Supprimer</i> <i class="btn-sm btn-warning modif_question">Modifier</i> </td></tr>';
				$("tbody#"+template).append(html);
			}	
		}
		input.val('');
	});

	$(document).on('click','.modif_question',function(){
		var tr = $(this).parent().parent();
		var td = tr.find('td:first');
		tr.addClass('tractive');
		var question = td.html();
		var template = $(this).attr('class').split(' ').slice(-1);
		$('input.'+template).val(question);
	});

	$(document).on('click','.sup_question',function(){
		var tr = $(this).parent().parent();
		tr.html('');
		tr.hide();
	});
	
	$(document).on('click','.fiche',function(){
		$('#modif_buttons').hide();
	});
	$(document).on('click','.infos_doctorant',function(){
		$('#modif_buttons').show();
	});
	
	//Mise à jour fiche de suivi
	$(document).on('click','.modifFiche_modifier',function(){
		$('.modifFiche_modifier').hide();
		$('.modifFiche_valider').show();
		$('.modifFiche_annuler').show();
		oldForm = $('div#'+$(this).siblings('.modifFiche_id').val());
		formId = $(this).siblings('.modifFiche_id').val();
		$('div#'+formId+" input[type='text']").prop('readonly',false);
	});
	
	$(document).on('click','.modifFiche_valider',function(){
		$('.modifFiche_modifier').show();
		$('.modifFiche_valider').hide();
		$('.modifFiche_annuler').hide();
		formId = $(this).siblings('.modifFiche_id').val();
		$('div#'+formId+" input[type='text']").prop('readonly',true);
		
	});
	
	$(document).on('click','.modifFiche_annuler',function(){
		$('.modifFiche_modifier').show();
		$('.modifFiche_valider').hide();
		$('.modifFiche_annuler').hide();
		formId = $(this).siblings('.modifFiche_id').val();
		$('div#'+formId+" input[type='text']").prop('readonly',true);
	});
	
	// Agenda
	$('#calendar').fullCalendar({
		firstDay:1,
		defaultDate: moment(),
		editable: false,
		eventLimit: true, // allow "more" link when too many events
		eventSources : [{url:'/mydate.php'}]
	});

	$('[data-toggle="tooltip"]').popover({
		'placement': 'bottom'
	});
	
	//Graphique progression
	var data = [
		['65%', 65],['35%', 35]
	];
	var plot1 = jQuery.jqplot ('chartdiv', [data], 
    { 
		seriesColors:['#5cb85c', '#f0ad4e'],
		seriesDefaults: {
			renderer: jQuery.jqplot.PieRenderer, 
			rendererOptions: {
			  // Put data labels on the pie slices.
			  // By default, labels show the percentage of the slice.
			  showDataLabels: true
			}
		},
    }
  );

});