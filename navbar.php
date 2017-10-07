<nav class="navbar navbar-default">
	<div class="container-fluid">
		<div class="navbar-header">
			<!-- Button, mit dem man in der Mobile-Ansicht das Navi aufklappt. Erscheint nur im angemeldeten Zustand -->
			<?php
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
			<!-- Logo, welches im unangemeldet Zustand zu index.php und im angemeldeten Zustand zu calendar.php verlinkt -->
			<a class="navbar-brand" href="
				<?php
					if(empty($_SESSION['userid'])) {
						echo "index.php";
					} else {
						echo "calendar.php";
					}
				?>
			"><img src="images/logo.svg" height="20px"></a>
		</div>
		<!-- Suchen-Formular und Navigations-Punkte, welche nur im angemeldeten Zustand erscheinen -->
		<?php
			if(empty($_SESSION['userid'])) {
				echo "";
			} else {
				$username = $_SESSION['username'];
			echo "
				<div class='collapse navbar-collapse' id='bs-example-navbar-collapse-1'>
					<form class='navbar-form navbar-left'>
						<div class='form-group'>
						<input type='text' class='form-control' placeholder='Termin suchen...'>
						</div>
						<button type='submit' class='btn btn-default'>Suchen</button>
					</form>
							
					<ul class='nav navbar-nav navbar-right'>
						<li><a href='calendar.php'><span class='glyphicon glyphicon-calendar' aria-hidden='true'></span> Mein Kalender <span class='label label-danger'>4</span></a></li>
						<li><a href='add.php'><span class='glyphicon glyphicon-plus' aria-hidden='true'></span> Termin</a></li>
						<li class='dropdown'>
							<a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>".$username."<span class='caret'></span></a>
							<ul class='dropdown-menu'>
								<li><a href='profile.php'>Einstellungen</a></li>
								<li role='separator' class='divider'></li>
								<li><a href='logout.php'>Abmelden</a></li>
							</ul>
						</li>
					</ul>
				</div><!-- Ende von .navbar-collapse -->";
				}
				?>
	</div> <!-- Ende von .container-fluid -->
</nav>