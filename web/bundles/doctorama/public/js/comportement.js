$(document).ready(function(){

	// ---------- NE PAS METTRE LE CODE HTML SUR PLUSIEURS LIGNES ---------- \\

	// Ajout des champs encadrants dans la création d'un dossier
	$("#plus_enc").css("cursor","pointer");
	$("#plus_enc").click(function(){
		$(this).before('<input type="text" class="form-control" name="enc_th[]" style="margin-top:15px;" placeholder="Encadrant de la thèse">');
	});

	/********************************************************************************\ 
		Gestion du type d'affichage lors des listes des doctorants
	\********************************************************************************/
	// par defaut, on cahce la vue en liste
	$('.vue-liste-doctorant').hide(); 

	// clique sur la vue en grille, on affiche la grille, cache la liste
	$('#btn_grille').click(function(){
		$('.vue-liste-doctorant').hide();
		$('.vue-grille-doctorant').show();
	});

	// clique sur la vue en liste, on affiche la liste, cache la grille
	$('#btn_list').click(function(){
		$('.vue-grille-doctorant').hide();
		$('.vue-liste-doctorant').show();
	});
	
	/********************************************************************************\ 
		Gestion de la pagination lors des listes
	\********************************************************************************/
	// au clique sur le nombre d'éléments à afficher par page
	$(".btn_nb_par_page").click(function(){
		// récupère les infos qui nous seront utiles
		var nb_visible = this.value; // nb a afficher
		var nb_doctorant = $("tr").length - 1; // le nombre total
		var nb_page = Math.ceil(nb_doctorant/nb_visible); // le nouveau nombre de page
		
		// changement de class entre l'ancien nombre select et le nouveau
		$('.active').removeClass("active btn-info");
		$(this).addClass("active btn-info");
		
		// affiche que les éléments nécessaire en première page pour la vue en grille et en liste
		$("article:nth-child(n+"+nb_visible+")").hide();
		$("article:nth-child(-n+"+nb_visible+")").show();
		
		$("tr:nth-child(n+"+nb_visible+")").hide()
		$("tr:nth-child(-n+"+nb_visible+")").show();

		// or refait le système de pagination en fonction du nouveau nombre de page
		var html = '<li><a href="#"><span aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span></a></li>';
		for(var i = 1; i <=nb_page; i++)
		{
			html+=' <li><a href="#" class="page">'+i+'</a></li>';
		}
		html+='<li><a href="#" ><span aria-hidden="true">&raquo;</span><span class="sr-only">Next</span></a></li>';
		// on affiche la pagination
		$('.pagination').html(html);
	});
	
	// au clique du changement de page
	$(document).on('click','.page',function(){
		var num_page = this.text; // on récupère le numéro de page à afficher
		var nb_visible = $('.active.btn-info').html(); // le nombre d'élément par page
		
		// la plage des élément à afficher (exemple page 2 avec 8 éléments doit entre 9 et 16 )
		var deb = (num_page-1)*nb_visible + 1;
		var fin = num_page*nb_visible;
		
		// cache ce qui n'est pas sur la page à afficher et montre ce qui doit l'être
		$("article").hide();
		$("article:nth-child(n+"+deb+"):nth-child(-n+"+fin+")").show();
		
		$("tr").hide();
		$("tr:nth-child(n+"+deb+"):nth-child(-n+"+fin+")").show();
	});

	/********************************************************************************\ 
		Modification templates fiches de suivi
	\********************************************************************************/
	// au clique sur le bouton d'ajout de la question
	$(document).on('click','#add_question',function(){
		var input = $(this).parent().parent().find('#add_input_question');
		var question = input.val(); // récupère la question
		var template = input.attr('class').split(' ').slice(-1); // le nom du template (class du boutton)

		var html = '';
		// si question n'est pas vide
		if(question!=''){
			var exist = $('.tractive');
			// on regarde si c'est une modification d'une question ou un ajout
			if(exist.length > 0)
			{
				// si c'est une modification, on change le html de la question à modifier
				html+='<input type="hidden" value="'+question+'" name="question[]"/><td>'+question+'</td><td> <i class="btn-sm btn-danger sup_question">Supprimer</i> <i class="btn-sm btn-warning modif_question '+template+'">Modifier</i> </td>';
				exist.html(html);
				exist.removeClass('tractive');
			}
			else
			{
				// si c'est un ajout, on ajoute le code html dans le tableau associé au template
				html+='<tr><input type="hidden" value="'+question+'" name="question[]"/><td>'+question+'</td><td> <i class="btn-sm btn-danger sup_question">Supprimer</i> <i class="btn-sm btn-warning modif_question '+template+'">Modifier</i> </td></tr>';
				$("tbody#"+template).append(html);
			}	
		}
		input.val(''); // vide le champs nouvelle question
	});

	// au clique sur le boutton modifier d'une question
	$(document).on('click','.modif_question',function(){
		var tr = $(this).parent().parent(); // récupère la ligne du tableau
		var td = tr.find('td:first'); // la première case contient la question
		tr.addClass('tractive'); // on ajoute la classe tractive pour signaler que c'est celle ci que l'on modifie
		var question = td.html(); // récupère la question
		var template = $(this).attr('class').split(' ').slice(-1); // le numéro de template
		$('input.'+template).val(question); // on écrit la question dans l'input associé au template
	});

	// au clique sur le boutton de suppression d'une question
	$(document).on('click','.sup_question',function(){
		// récupère la ligne de la question à supprimer
		var tr = $(this).parent().parent();
		// on vide le code html (pour ne rien récupérer à l'envoie du formulaire)
		tr.html('');
		tr.hide(); // on cahce la ligne qui est maintenant vide
	});
	
	/********************************************************************************\ 
		
	\********************************************************************************/
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
		//oldForm = $('div#'+$(this).siblings('.modifFiche_id').val());
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
	
	/********************************************************************************\ 
		Gestion du calendrier - fullcalendar
	\********************************************************************************/
	$('#calendar').fullCalendar({
		firstDay:1,
		defaultDate: moment(),
		editable: false,
		eventLimit: true, 
		eventSources : [{url:'/mydate.php'}] // le fichier php créer dans agendaAction() du controlleur
	});

	$('[data-toggle="tooltip"]').popover({
		'placement': 'bottom'
	});
	
	/********************************************************************************\ 
		Graphique progression
	\********************************************************************************/
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
		}
    }
  );

});