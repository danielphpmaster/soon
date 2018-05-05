<nav class="navbar navbar-default">
	<div class="container-fluid">
		<div class="navbar-header">
			<?php
				// Button, mit dem man in der Mobile-Ansicht das Navi aufklappt. Erscheint nur im angemeldeten Zustand
				if(empty($_SESSION['usertoken'])) {
					echo "<button type='button' class='navbar-toggle collapsed' data-toggle='collapse' data-target='#bs-example-navbar-collapse-1' aria-expanded='false'>
							<span class='sr-only'>Toggle navigation</span>
							<span class='icon-bar'></span>
							<span class='icon-bar'></span>
							<span class='icon-bar'></span>
						</button>";
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
					if(empty($_SESSION['usertoken'])) {
						echo $path;
					} else {
						echo $path."calendar";
					}
				?>
			"><img src="<?php echo $path; ?>images/logo.svg" height="20px"></a>
		</div> <?php // Ende von .navbar-header ?>
		<?php
			// Prüfung, ob der Benutzer angemeldet ist. Wenn ja: Navigations-Punkte werden angezeigt
			if(empty($_SESSION['usertoken'])) {
				echo "<div class='collapse navbar-collapse' id='bs-example-navbar-collapse-1'>
				
						<!-- Dropdown rechts vom Logo. Momentan ohne Funktion.
							<ul class='nav navbar-nav'>
								<li class='dropdown'>
									<a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>Kalender <span class='caret'></span></a>
									<ul class='dropdown-menu'>
										<li><a href='#'>Kalender</a></li>
										<li><a href='#'>Projektmanager</a></li>
									</ul>
								</li>
							</ul>
						-->				
				
						<ul class='nav navbar-nav navbar-right'>
							<li><a href='".$path."login'><span class='glyphicon glyphicon-user' aria-hidden='true'></span> ".$t_log_in[$language]."</a></li>
							<li><a href='".$path."registration'><span class='glyphicon glyphicon-user' aria-hidden='true'></span> ".$t_sign_up[$language]."</a></li>
						</ul>
					</div>";
			} else {
				// Zählen, wieviele Termine der angemeldete Benutzer heute hat
				$first_timestamp_of_day = strtotime(date("Y-m-d 00:00:00", time()));
				$last_timestamp_of_day = strtotime(date("Y-m-d 23:59:59", time()));
				
				$sql_select = "SELECT COUNT(appointmenttoken) FROM appointments WHERE usertoken = '$usertoken' AND timestamp >= '$first_timestamp_of_day' and timestamp <= '$last_timestamp_of_day'";
				$count_result = $connection->prepare($sql_select);
				$count_result->execute();

				$total_appointments_today = $count_result->fetchColumn();
			
				$username = $_SESSION['username'];

			echo "
				<div class='collapse navbar-collapse' id='bs-example-navbar-collapse-1'>
				
					<!-- Dropdown rechts vom Logo. Momentan deaktiviert.
						<ul class='nav navbar-nav'>
							<li class='dropdown'>
								<a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>Kalender <span class='caret'></span></a>
								<ul class='dropdown-menu'>
									<li><a href='#'>Kalender</a></li>
									<li><a href='#'>Projektmanager</a></li>
								</ul>
							</li>
						</ul>
					-->	
					
					<ul class='nav navbar-nav navbar-right'>
						<li><a href='".$path."add'><span class='glyphicon glyphicon-plus' aria-hidden='true'></span> ".$t_add_appointment[$language]."</a></li>
						<li><a href='".$path."calendar'><span class='glyphicon glyphicon-calendar' aria-hidden='true'></span> ".$t_my_calendar[$language]."";
			
			if($total_appointments_today > '0') {
				echo " <span class='label label-danger'>".$total_appointments_today."</span>";
			}
			
			echo "</a></li>
						<li class='dropdown'>
							<a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>".htmlspecialchars($username)." <span class='caret'></span></a>
							<ul class='dropdown-menu'>
								<li><a href='".$path."profile'><span class='glyphicon glyphicon-user' aria-hidden='true'></span> ".$t_my_profile[$language]."</a></li>
								<li role='separator' class='divider'></li>
								<li><a href='".$path."logout'><span class='glyphicon glyphicon-off' aria-hidden='true'></span> ".$t_log_out[$language]."</a></li>
							</ul>
						</li>
					</ul>
				</div> <?php // Ende von .navbar-collapse ?>";
				}
				?>
	</div> <?php // Ende von .container-fluid ?>
</nav>