﻿<?php
	require_once('lib/affichage.php');
   	afficheStructureDeb("Doctorants du laboratoire");
?>

		<div class="page-header borderColor">
          <h2>Liste des doctorants </h2>
        </div>
        <div class="recherche input-group">
			<input type="text" class="form-control" placeholder="Rechercher un doctorant">
	     	<span class="input-group-btn">
	        	<button class="btn btn-default" type="button">Go!</button>
	      	</span>
	    </div>


		<div class="table-responsive">
			<table class="table border1px table-striped">
			  <thead>
				<tr>
				  <th>#</th>
				  <th>Nom</th>
				  <th>Prénom</th>
				  <th>Sujet de thèse</th>
				  <th>Progression</th>
				</tr>
			  </thead>
			  <tbody>
				<tr>
				  <td>1</td>
				  <td>Doctorant</td>
				  <td>Num1</td>
				  <td>Sujet de thèse du doctorant Num1</td>
				  <td>
					<div class="progress">
						<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;"> 80 % </div>
					</div>
				  </td>
				</tr>
				<tr>
				  <td>2</td>
				  <td>Doctorant</td>
				  <td>Num2</td>
				  <td>Sujet de thèse du doctorant Num2</td>
				  <td>
					<div class="progress">
						<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="250" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"> 250 % </div>
					</div>
				  </td>
				</tr>
				<tr>
				  <td>3</td>
				  <td>Doctorant</td>
				  <td>Num3</td>
				  <td>Sujet de thèse du doctorant Num3</td>
				  <td>
					<div class="progress">
						<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="110" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"> 110 % </div>
					</div>

				  </td>
				</tr>
				<tr>
				  <td>4</td>
				  <td>Doctorant</td>
				  <td>Num4</td>
				  <td>Sujet de thèse du doctorant Num4</td>
				  <td>
					<div class="progress">
						<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 10%;">10 %</div>
					</div>
				  </td>
				</tr>
			  </tbody>
			</table>
		</div>
		
		<nav class="text-center">
			<ul class="pagination">
				<li><a href="#"><span aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span></a></li>
				<li><a href="#">1</a></li>
				<li><a href="#">2</a></li>
				<li><a href="#">3</a></li>
				<li><a href="#">4</a></li>
				<li><a href="#">5</a></li>
				<li><a href="#"><span aria-hidden="true">&raquo;</span><span class="sr-only">Next</span></a></li>
			</ul>
		</nav>


<?php
	afficheStructureFin();
?>