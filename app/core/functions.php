<?php
//Logowanie 
function Logout() {
	unset($_SESSION['login']);
	unset($_SESSION['username']);
	header("Location: .");
}

//Lista elementow strony do tablicy
function ElemToTab($dir){
	
	$page_elem = array_slice(scandir($dir), 2);
	return $page_elem;
	
}

$content_folder = ''; //nazwa folderu zawierającego model elementu
$elemId = ''; //numer elementu
//Ładowanie elementów strony 
function LoadPageElem($elements) {
	
	if(isset($elements))
	{
		foreach($elements as $elem)
		{
		//Pobierz nr i nazwę elementu
		list($elemId, $elem_name) = explode("_", $elem);
		$content_folder = $elem;
		$elemId = $elemId;
		//Dołącz elementy strony 
		include "app/core/page_elem/".$elem_name.".php";
		}
	}
}

function ReadMd($folder, $fname) {
	
	if( !isset($_POST['edit']) )
		$file = 'app/res/elem_content/'.$folder.'/'.$fname.'.md';
	else
		$file = '../res/elem_content/'.$folder.'/'.$fname.'.md';
	
	if(file_exists($file)) {
	
	$handle = fopen($file, 'r');
	$text = '';
		
	while(!feof($handle))
	{
		$text .= fgets($handle);
	}	
	fclose($handle);

	$Parsedown = new Parsedown();
	echo $Parsedown->text($text);
	unset($Parsedown);
		
	} else {
		echo "<p>Nie znaleziono pliku: $file</p>";
	}
}

//Ładowanie paska narzędzi 
function LoadToolBar() {
	if(isset($_SESSION['login']))
		include "app/core/tool_bar/elem-tool-bar.php";
}


function LoadMd($folder, $fname){
	
	$file = '../res/elem_content/'.$folder.'/'.$fname.'.md';
	
	if(file_exists($file)) {
	
	$handle = fopen($file, 'r');
	$text = '';
		
	while(!feof($handle))
	{
		$text .= fgets($handle);
	}	
	fclose($handle);

	echo $text;
		
	} else {
		echo "Błąd: Nie znaleziono pliku: $file";
	}
	
}






		/* LOGIN PAGE TEMPLATES */
		function display_login_form()
		{
?>

<h2>Zaloguj się</h2>
<form action="" method="post">
    <div class="input-box">
        <input type="text" name="username" value="admin" required>
        <label for="username">Login: </label>
    </div>
    <div class="input-box">
        <input type="password" name="password" value="admin" required>
        <label for="password">Hasło: </label>
    </div>
    <input type="submit" name="submit" value="Zaloguj">
</form>


<?php			
}
	function logged_in_msg($username)
		{
			echo  '<p>Witaj <b>' . $username . '</b>, jak leci?<br>'.
				  '<a class="btn" 		   href=".">Zarządzaj stroną</a><br>'.
				  '<a class="btn exit-btn" href="?logout=true">Wyloguj</a>'.
				  '</p>';
		}
	function display_error_msg()
		{
			echo '<p id="error">Nieprawidłowa nazwa użytkownika lub hasło</p>';
		}