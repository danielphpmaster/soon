<nav class='navbar navbar-expand-lg navbar-light'>
	<a class='navbar-brand' href='
		<?php
			// Prüfung, ob der Benutzer angemeldet ist. Wenn ja: Link führt zu calendar.php. Wenn nein: Link führt zu index.php
			if(empty($_SESSION['userid'])) {
				echo $path;
			} else {
				echo $path.'calendar';
			}
		?>
	'><img src='<?php echo $path; ?>images/logo.svg' height='25px'></a>
	<button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarToggler' aria-controls='navbarToggler' aria-expanded='false' aria-label='Toggle navigation'>
		<span class='navbar-toggler-icon'></span>
	</button>
	<?php
		if(isset($_SESSION['userid'])) {
			// Zählen, wieviele Termine der angemeldete Benutzer heute hat
			$first_timestamp_of_day = strtotime(date("Y-m-d 00:00:00", time()));
			$last_timestamp_of_day = strtotime(date("Y-m-d 23:59:59", time()));
			
			$sql_select = "SELECT COUNT(entryid) FROM entries WHERE userid = '$userid' AND timestamp >= '$first_timestamp_of_day' and timestamp <= '$last_timestamp_of_day'";
			$count_result = $connection->prepare($sql_select);
			$count_result->execute();

			$total_appointments_today = $count_result->fetchColumn();
			
			$username = $_SESSION['username'];
		
			echo "
				<div class='collapse navbar-collapse' id='navbarToggler'>
					<ul class='navbar-nav ml-auto'>
						<li class='nav-item'>
							<a href='".$path."add' class='nav-link'><i class='fas fa-plus'></i> ".$t_add[$language]."</a>
						</li>
						<li class='nav-item'>
							<a href='".$path."calendar' class='nav-link'><i class='far fa-calendar'></i> ".$t_my_calendar[$language]; 
								if($total_appointments_today > 0) { echo " <span class='badge badge-danger'>".$total_appointments_today."</span>"; }
							echo "</a>
						</li>
						<li class='nav-item dropdown'>
							<a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>".htmlspecialchars($username)."</a>
								<div class='dropdown-menu' aria-labelledby='navbarDropdown'>
									<a class='dropdown-item' href='".$path."profile'><i class='fas fa-user'></i> ".$t_my_profile[$language]."</a>
									<div class='dropdown-divider'></div>
									<a class='dropdown-item' href='".$path."logout'><i class='fas fa-sign-out-alt'></i> ".$t_log_out[$language]."</a>
								</div>
						</li>
					</ul>
				</div>";
		} else {
			echo "
				<div class='collapse navbar-collapse' id='navbarToggler'>
					<ul class='navbar-nav ml-auto'>
						<li class='nav-item'>
							<a href='".$path."registration' class='nav-link'><i class='fas fa-sign-in-alt'></i> ".$t_sign_up[$language]."</a>
						</li>
						<li class='nav-item'>
							<a href='".$path."login' class='nav-link'><i class='fas fa-sign-in-alt'></i> ".$t_log_in[$language]."</a>
						</li>
					</ul>
				</div>";
		}
	?>
</nav>