<?php
	require_once('lib/affichage.php');
	afficheStructureDeb("Administration - Dossiers de suivis");
?>

	<div class="page-header borderColor">
      <h2>Dossiers de suivi </h2>
    </div>
	
	<section align="right">
        	<a class="btn btn-default" href="creer_dossier.php" role="button"> Ajouter un dossier </a>
    </section>
	<section class="tab_suivi border1px table-responsive" >
		<table class="table table-striped">
		  <thead>
			<tr>
			  <th>#</th>
			  <th>Nom</th>
			  <th>Prénom</th>
			  <th style="width:15%">Modifier dossier</th>
			</tr>
		  </thead>
		  <tbody>
			<tr>
			  	<td>1</td>
			  	<td>Doctorant</td>
		 	 	<td>Num1</td>
			  	<td>
			  		<a class="btn btn-default" href="modif_dossier.php" role="button"> Modifier le dossier </a>
				</td>
			 
			</tr>
			<tr>
				<td>2</td>
				<td>Doctorant</td>
				<td>Num2</td>
				<td>
			  		<a class="btn btn-default" href="modif_dossier.php" role="button"> Modifier le dossier </a>
				</td>
			</tr>
			<tr>
				<td>3</td>
				<td>Doctorant</td>
				<td>Num3</td>
				<td>
			  		<a class="btn btn-default" href="modif_dossier.php" role="button"> Modifier le dossier </a>
				</td>
			</tr>
			<tr>
				<td>4</td>
				<td>Doctorant</td>
				<td>Num4</td>
				<td>
			  		<a class="btn btn-default" href="modif_dossier.php" role="button"> Modifier le dossier </a>
				</td>
			</tr>
		  </tbody>
		</table>
	</section>
	
		
<?php
	afficheStructureFin();
?>
