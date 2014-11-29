<?php
	require_once('lib/affichage.php');
	afficheStructureDeb("Modifier un dossier de suivis");
?>
		<div class="page-header borderColor">
          <h2>Modifier dossier de suivi </h2>
        </div>
		
		
		<form class="border1px form-horizontal" style="padding:30px;" role="form">
			<legend>
				Information sur la thèse 
			</legend>
			<div class="form-group">
				<label for="nom_doct" class="col-sm-3 control-label">Nom</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="nom_doct" placeholder="Nom">
				</div>
			</div>
			<div class="form-group">
				<label for="prenom_doct" class="col-sm-3 control-label">Prénom</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="prenom_doct" placeholder="Prénom">
				</div>
			</div>
			<div class="form-group">
				<label for="sujet_th" class="col-sm-3 control-label">Sujet de la thèse</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="sujet_th" placeholder="Sujet de la thèse">
				</div>
			</div>

			<div class="form-group">
				<label for="axe_th" class="col-sm-3 control-label">Axe thématique</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="axe_th" placeholder="Axe thématique">
				</div>
			</div>
			<div class="form-group">
				<label for="axe_sc" class="col-sm-3 control-label">Axe scientifique</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="axe_sc" placeholder="Axe scientifique">
				</div>
			</div>
			<div class="form-group">
				<label for="finance" class="col-sm-3 control-label">Financement</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="finance" placeholder="Financement">
				</div>
			</div>
			<div class="form-group">
				<label for="date_1er" class="col-sm-3 control-label">1ère inscription en thèse</label>
				<div class="col-sm-9">
					<input type="date" class="form-control" name="date_1er" placeholder="Date de 1ère inscription en thèse">
				</div>
			</div>
			<div class="form-group">
				<label for="dcace" class="col-sm-3 control-label">DCACE ?</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="dcace" placeholder="DCACE?">
				</div>
			</div>

			<legend>
				Information sur le Master 
			</legend>
			<div class="form-group">
				<label for="nom_mast" class="col-sm-3 control-label">Nom formation</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="nom_mast" placeholder="Nom de la formation">
				</div>
			</div>
			<div class="form-group">
				<label for="univ" class="col-sm-3 control-label">Université</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="univ" placeholder="Université">
				</div>
			</div>
			<div class="form-group">
				<label for="sujet_mast" class="col-sm-3 control-label">Sujet de Master</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="sujet_mast" placeholder="Sujet de Master">
				</div>
			</div>
			<div class="form-group">
				<label for="labo_acc" class="col-sm-3 control-label">Laboratoire d'accueil</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="labo_acc" placeholder="Laboratoire d'accueil">
				</div>
			</div>
			<div class="form-group">
				<label for="enc_mast" class="col-sm-3 control-label">Encadrant(s)</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="enc_mast" placeholder="Encadrant(s)">
				</div>
			</div>

			<legend> </legend>
			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-9">
					<button type="submit" class="btn btn-success">Valider</button>
					<button type="submit" class="btn btn-danger">Annuler</button>
				</div>
			</div>
		</form>
		
<?php
	afficheStructureFin();
?>
