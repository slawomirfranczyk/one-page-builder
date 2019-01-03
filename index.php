<?php include "app/core/init.php"; ?>
<!DOCTYPE html>
<html lang="pl">

<head>
	<meta charset="UTF-8">
	<title>One Page BUILDER</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link rel="stylesheet" href="app/res/css/reset.css">
	<link rel="stylesheet" href="app/res/css/style.css">
	<link rel="stylesheet" href="app/res/js/custombox/dist/custombox.min.css">
	<link rel="stylesheet" href="app/res/css/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">

</head>

<body>
    
    <div class="loader">
        <div></div>
    </div>
        
	<?php 
	
	
	//sprawdź czy zalogowany
	if(isset($_SESSION["login"]))
		include "app/core/tool_bar/top-tool-bar.php";
	
	//Ładuj elementy strony do tablicy
	
	$elemTab = ElemToTab('app/res/elem_content/');
	//wyświetl elementy strony
	LoadPageElem($elemTab);
	
	?>
	
	<div id="modal" class="container">
		
		<textarea></textarea>

		<a class="btn save-btn">Zapisz zmiany</a>
		<a class="btn exit-btn">Anuluj</a>
		<p>-> Edytując treść możesz korzystać zarówno ze znaczników <a href="https://pl.wikipedia.org/wiki/Markdown" target="_blank">Markdown</a>, jak i znaczników HTML</p>	
		
	</div>
	
	<div id="add_options" class="container">
		<h2>Wybierz rodzaj elementu</h2>
		<a id="section" class="btn add-elem">Sekcja strony</a>
	</div>
	
	
<!-- JS -->
<script src="app/res/js/jquery.js"></script>

<script src="app/res/js/custombox/dist/custombox.min.js"></script>
<script src="app/res/js/custombox/dist/custombox.legacy.min.js"></script>
<script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
<script src="app/res/js/functions.js"></script>

</body>

</html>