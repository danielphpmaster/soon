<nav class="navbar navbar-default">
	<div class="container-fluid">
		<div class="navbar-header">
			<?php
				// Button, mit dem man in der Mobile-Ansicht das Navi aufklappt. Erscheint nur im angemeldeten Zustand
				if(empty($_SESSION['userid'])) {
					echo "";
				} else {
					echo "<button type='button' class='navbar-toggle collapsed' data-toggle='collapse' data-target='#bs-example-navbar-collapse-1' aria-expanded='false'>
							<span class='sr-only'>Toggle navigation</span>
							<span class='icon-bar'></span>
							<span class='icon-bar'></span>
							<span class='icon-bar'></span>
						</button>";
				}
			?>
			<a class="navbar-brand" href="
				<?php
					// Prüfung, ob der Benutzer angemeldet ist. Wenn ja: Link führt zu calendar.php. Wenn nein: Link führt zu index.php
					if(empty($_SESSION['userid'])) {
						echo $path;
					} else {
						echo $path."calendar";
					}
				?>
			"><img src="images/logo.svg" height="20px"></a>
		</div> <?php // Ende von .navbar-header ?>
		<?php			
			// Prüfung, ob ein Suchwert eingegeben wurde
			if(isset($_GET['search'])) {
				$searchvalue = $_GET['search'];
			} elseif (isset($searchvalue)){
				$searchvalue = $searchvalue;
			} else {
				$searchvalue = '';
			}				
		
			// Prüfung, ob der Benutzer angemeldet ist. Wenn ja: Suchenleiste und Navigations-Punkte werden angezeigt
			if(empty($_SESSION['userid'])) {
				echo "";
			} else {
				// Zählen, wieviele Termine der angemeldete Benutzer heute hat
				$datetoday = date("Y-m-d");
				$sql_select = "SELECT COUNT(appointmentid) FROM appointments WHERE userid = '$userid' AND date = '$datetoday'";
				$count_result = $connection->prepare($sql_select);
				$count_result->execute();

				$total_appointments_today = $count_result->fetchColumn();
			
				$username = $_SESSION['username'];

			echo "
				<div class='collapse navbar-collapse' id='bs-example-navbar-collapse-1'>
					<form class='navbar-form navbar-left' action='".$path."result' methode='post'>
						<div class='form-group'>
						<input name='search' type='text' class='form-control' placeholder='Termin suchen...' value='".$searchvalue."'>
						</div>
						<button type='submit' class='btn btn-default'>Suchen</button>
					</form>
							
					<ul class='nav navbar-nav navbar-right'>
						<li><a href='".$path."add'><span class='glyphicon glyphicon-plus' aria-hidden='true'></span> Termin hinzufügen</a></li>
						<li><a href='".$path."calendar'><span class='glyphicon glyphicon-calendar' aria-hidden='true'></span> Mein Kalender";
			
			if($total_appointments_today > '0') {
				echo " <span class='label label-danger'>".$total_appointments_today."</span>";
			}
			
			echo "</a></li>
						<li class='dropdown'>
							<a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>".$username." <span class='caret'></span></a>
							<ul class='dropdown-menu'>
								<li><a href='".$path."profile'>Mein Profil</a></li>
								<li role='separator' class='divider'></li>
								<li><a href='".$path."logout'>Abmelden</a></li>
							</ul>
						</li>
					</ul>
				</div> <?php // Ende von .navbar-collapse ?>";
				}
				?>
	</div> <?php // Ende von .container-fluid ?>
</nav>