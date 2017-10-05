<?php

session_start();

if (empty($_SESSION['email'])){
 echo "";
} else {
	$email = $_SESSION['email'];
}

?>

<nav class="navbar navbar-default">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<?php
				if(empty($_SESSION['username'])) {
					echo "";
				} else {
					echo "<button type='button' class='navbar-toggle collapsed' data-toggle='collapse' data-target='#bs-example-navbar-collapse-1' aria-expanded='false'>
				<span class='sr-only'>Toggle navigation</span>
				<span class='icon-bar'></span>
				<span class='icon-bar'></span>
				<span class='icon-bar'></span>
			</button>";
				} ?>
			<a class="navbar-brand" href="<?php
				if(empty($_SESSION['username'])) {
					echo "index.php";
				} else {
					echo "calendar.php";
				}
				?>"><img src="images/logo.svg" height="20px"></a>
		</div>
			<!-- Collect the nav links, forms, and other content for toggling -->
			<?php
				if(empty($_SESSION['username'])) {
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
		</div><!-- /.navbar-collapse -->";
				}
				?> 
	</div><!-- /.container-fluid -->
</nav>