<!DOCTYPE html>

<html>

<?php
	$title = "Termin hinzufügen - soon";
?>

<head>
	<?php include 'head.php';?>
</head>

<body>
	<?php include 'navbar.php';?>
	
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-md-3">
			</div>
			<div class="col-xs-12 col-md-6">
				<div class="box">
					<h2>
						Termin hinzufügen
					</h2>
					<form>
						<div class="form-group">
							<label for="exampleInputUsername1">Titel</label>
							<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Titel">
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Datum</label>
							<input type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Datum">
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Zeit</label>
							<input type="time" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Zeit">
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1">Ort</label>
							<input type="text" class="form-control" id="exampleInputPassword1" placeholder="Ort">
						</div>
						<div class="form-group">						
							<label for="exampleInputPassword1">Bemerkung</label>
							<input type="text" class="form-control" id="exampleInputPassword1" placeholder="Bemerkung">
						</div>
						<button type="submit" class="btn btn-primary">Termin erfassen</button>
					</form>
				</div>
			</div>
			<div class="col-xs-12 col-md-3">
			</div>
		</div>
	</div>
</body>

</html> 