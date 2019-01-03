<?php
//error_reporting(0); //wyłączenie wyświetlania błędów
include "init.php";

//Pobierz listę elementów do tablicy
$elemTab = ElemToTab('../res/elem_content/');

//Przeniesienie elementu w dół
if( isset($_POST['go']) && $_POST['go'] == 'down' )
		Down( $_POST['currentId'] );

//Przeniesienie elementu do góry
if( isset($_POST['go']) && $_POST['go'] == 'up' )
	Up( $_POST['currentId'] );

//test edycji elementu
if( isset($_POST['edit']) ) {
	LoadMd($elemTab[ $_POST['edit'] -1 ], 'content');
}

//zapisywanie zmian po edycji
if( isset($_POST['saveChanges']) )
	SaveChanges( $elemTab[ $_POST['saveChanges'] -1 ], 'content', $_POST['fcontent'] );

//tworzenie nowego elementu 
if( isset($_POST['newElem']) )
	NewElem( $_POST['newElem'] );

if( isset($_POST['del']) )
	DeleteElem($_POST['elemId']);






//============================================================
//Deklaracje funkcji 
//============================================================
function Down( $nextElem ){
	
	global $elemTab;
	
	$currentElem = $elemTab[$nextElem - 1];
	$nextElem = $elemTab[$nextElem];
	
	//print_r($elemTab);
	//echo "current: ".$currentElem." and next: ".$nextElem;
	
	list($currentId, $currentName) = explode("_", $currentElem);
	list($nextId, $nextName) = explode("_", $nextElem);
	
	$renameFirst = rename ("../res/elem_content/$currentElem", "../res/elem_content/$nextId"."_$currentName"."_new");
	$renameSecound = rename ("../res/elem_content/$nextElem", "../res/elem_content/$currentId"."_$nextName");
	
	$renameThird= rename ("../res/elem_content/$nextId"."_$currentName"."_new", "../res/elem_content/$nextId"."_$currentName");
	
	if($renameFirst && $renameSecound && $renameThird)
		echo "Zamieniono kolejnosć elementów strony";
	else 
		echo "Błąd podczas zmiany kolejnosci elementów strony";
}

function Up( $nextElem ){
	
	global $elemTab;
	
	$currentElem = $elemTab[$nextElem - 1];
	$prevElem = $elemTab[$nextElem - 2];
	
	list($currentId, $currentName) = explode("_", $currentElem);
	list($prevId, $prevName) = explode("_", $prevElem);
	
	$renameFirst = rename ("../res/elem_content/$currentElem", "../res/elem_content/$prevId"."_$currentName"."_new");
	$renameSecound = rename ("../res/elem_content/$prevElem", "../res/elem_content/$currentId"."_$prevName");
	
	$renameThird= rename ("../res/elem_content/$prevId"."_$currentName"."_new", "../res/elem_content/$prevId"."_$currentName");
	
	if($renameFirst && $renameSecound)
		echo "Zamieniono kolejnosć elementów strony";
	else 
		echo "Błąd podczas zmiany kolejnosci elementów strony";
}

function DeleteElem( $elemId ){
	
	global $elemTab;
	
	for( $i = $elemId; $i < sizeof($elemTab)-1; $i++ )
		Down( $i );
	
	$elemTab = ElemToTab('../res/elem_content/');
	
	$dirToDel = "../res/elem_content/".$elemTab[sizeof($elemTab)-2];
	
	array_map('unlink', glob("$dirToDel/*.*"));
	
	if( !rmdir( $dirToDel ) )
		echo "Nie można usunąć elementu";
	
}


function SaveChanges( $dir, $file, $fcontent ){
	
	$file = '../res/elem_content/'.$dir.'/'.$file.'.md';
	
	if(file_exists($file)) {
	
	$handle = fopen($file, 'w');
		
	fwrite($handle, $fcontent);
	
	fclose($handle);

		
	} else {
		echo "Błąd: Nie znaleziono pliku: $file";
	}
	
}

function NewElem( $elem_name ) {
	
	global $elemTab;
	$number = sizeof($elemTab); // ostatnim elementem jest end_footer, dlatego nie +1
	if($number < 10) 
		$number = '0'.$number;
	
//	echo $number.'<br>';
//	echo $elem_name;
	mkdir("../res/elem_content/e$number"."_$elem_name");
	
	$file = "page_elem/default_content/$elem_name".".md";
	$newfile = "../res/elem_content/e$number"."_$elem_name/"."content.md";
	
	if( !copy($file, $newfile) )
		echo "Nie udało się skopiować pliku $file do $newfile";
	
}