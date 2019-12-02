<?php
	session_start();
	
	if(isset($_SESSION['error'])){
	    echo($_SESSION['error']);
	}
	
	if (isset($_GET['controle']) and isset($_GET['action'])){
	    $controle = $_GET['controle'];
	    $action=$_GET['action'];
	}
	else{
	    $controle ="controllers";
	    $action="authentification";}
	
	require ('./controllers/' . $controle . '.php');
	$action();
	
	function route($controle,$action){
	    require ('./controlers/' . $controle .'php');
	    $action();
	}


