<?php
function afficheHeader($chemin)
{
	echo ' 
		<div class="navbar navbar-default navbar-fixed-top EnTete">
			<div class="row">
				<div class="col-md-6 col-xs-6">
					<button type="button" class="navbar-toggle ico-menu" data-toggle="offcanvas" data-recalc="false" data-target=".navmenu" data-canvas=".canvas">
					  <span class="icon-bar" style="background:#f2f2f2;"></span>
					  <span class="icon-bar" style="background:#f2f2f2;"></span>
					  <span class="icon-bar" style="background:#f2f2f2;"></span>
					</button>
					'.$chemin.'
				</div>
			
				<div class="col-md-6  col-xs-6 text-right">
					<div class="fr btn-group" style="margin-right:15px;">
						<button type="button" class="btn btn-xs btn-danger"><span class="badge">4</span></button>
						<button type="button" class="btn btn-xs btn-user">Augereau Mickaël</button>
						<button type="button" class="btn btn-xs btn-user dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
							<span class="caret"></span>
							<span class="sr-only">Toggle Dropdown</span>
						</button>
						<ul class="dropdown-menu pull-right" role="menu">
							<li><a href="#">Notifications <span class="badge">4</span></a> </li>
							<li class="divider"></li>
							<li><a href="#">Deconnexion</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	';
}

function afficheMenu()
{
	// ajout fixed nav
	echo'
		<div class="Menu navmenu navmenu-default navmenu-fixed-left">
			<img src="http://localhost:8888/doctorama/src/DT/UserBundle/Resources/views/User/img/logo.png" class="img-responsive center-block" style="margin-bottom:15px"/>
			<div class="well sidebar">
				<ul class="nav nav-list">
						<li class="nav-header">
							<legend>
								<i class="glyphicon glyphicon-align-justify"></i>
								<b style="font-size:12pt">MENU PRINCIPAL</b>
							</legend>
						</li>
						<li class="active"><a href="#">Accueil</a></li>
						<li><a href="#">Agenda</a></li>
						<li><a href="#">Doctorants encadrés </a></li>
						<li><a href="doctorant_labo.php">Doctorants du laboratoire </a></li>
						<li><a href="#">Statistiques</a></li>
						<li><a href="#">Historique doctorants</a></li>
				</ul>
			</div>
			<div class="well sidebar">
				<ul class="nav nav-stacked">
					<li class="nav-header">
						<legend>
							<i class="glyphicon glyphicon-wrench"></i>
							<b style="font-size:12pt">MENU ADMINISTRATION</b>
						</legend>
					</li>
					<li><a href="admin_dossier.php">Dossier de suivis</a></li>
				</ul>
			</div>
    	</div>
	';
}

function importCSS(){
	echo'
		<link href="http://localhost:8888/doctorama/src/DT/UserBundle/Resources/views/User/css/jasny-bootstrap.min.css" rel="stylesheet">
		<link href="http://localhost:8888/doctorama/src/DT/UserBundle/Resources/views/User/css/bootstrap.css" rel="stylesheet">
	    <link href="http://localhost:8888/doctorama/src/DT/UserBundle/Resources/views/User/css/style.css" rel="stylesheet">';
}

function importJS(){
	echo'
		<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
	    <script src="http://localhost:8888/doctorama/src/DT/UserBundle/Resources/views/User/js/bootstrap.js"></script>
	    <script src="http://localhost:8888/doctorama/src/DT/UserBundle/Resources/views/User/js/jasny-bootstrap.min.js"></script>
	    <script src="http://localhost:8888/doctorama/src/DT/UserBundle/Resources/views/User/js/comportement.js"></script>
	   ';
}

function afficheStructureDeb($chemin)
{
	echo '<!DOCTYPE html>
		<html lang="en">
  		<head>
		    <meta charset="utf-8">
		    <meta name="viewport" content="width=device-width, initial-scale=1.0">
		    <meta name="description" content="">
    		<title>'.$chemin.'</title>';
    importCSS();
    echo '</head>
		<body>';
	afficheMenu();
	echo '<div class="canvas Conteneur">';
	afficheHeader($chemin);
	echo '<div class="container">';
}

function afficheStructureFin()
{
	echo'</div>
    </div>';
    importJS();
    echo'</body>
    	</html>';
}