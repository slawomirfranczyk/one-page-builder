<div id="top-tool-bar">
	<h4>Witaj<strong> <?php echo $_SESSION['username'] ?> </strong>, teraz możesz zarządzać swoją stroną</h4>

	<a class="btn accept-btn add"><i class="fa fa-plus" aria-hidden="true"></i> Dodaj element</a>
	<a class="btn exit-btn" href="?logout=true">Wyloguj</a>

	<?php 
		if(isset($_GET['logout']))
			Logout();
	?>
</div>
