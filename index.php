<?php
	//Error reporting for developmental purposes
	error_reporting(0);
	ini_set('display_errors', false);
	
	define("IP", $_SERVER["REMOTE_ADDR"]);
	define("PAGE_THEME", "Default");
	
	session_start();
	require_once("Requires.php");
	
	if (!file_exists("Settings.php")) {
		echo "You must run the installer first";
		die();
	} else {
		if (file_exists("install")) {
			echo "You  must delete the installer after installing!";
			die();
		}
	}
	require_once("Settings.php");

	try {
		DB::Connect(DB_Host, DB_User, DB_Pass, DB_Name);
	} catch (Exception $E) {
		$Header = new Page("Header");
		$Footer = new Page("Footer");
		$Page = new Page("Error");
		$Header->Page = $Page;
		$Header->Footer = $Footer;
		$Page->Header = $Header;
		$Page->Footer = $Footer;
		$Footer->Header = $Header;
		$Footer->Page = $Page;
		$Page->Error = "The database is down, please try again later.";
		$Page->LoadPage();
		echo $Header->ParseTemplate();
		echo $Page->ParseTemplate();
		echo $Footer->ParseTemplate();
		die();
	}
	
	$CSession = new CSession();
	define("PREVTOKEN", isset($CSession->Token) ? $CSession->Token : "");
	define("TOKEN", $CSession->RegenToken());
	$CUsr = false;
	if ($CSession->IsLogged()) {
		$CUsr = new User($CSession->ID);
		if (!$CSession->CheckSession($CUsr))
			$CUsr = false;
	}
	User::$CUsr = $CUsr;

	$Header = new Page("Header");
	$Footer = new Page("Footer");
	$Page = new Page();
	
	$Header->Page = $Page;
	$Header->Footer = $Footer;
	$Page->Header = $Header;
	$Page->Footer = $Footer;
	$Footer->Header = $Header;
	$Footer->Page = $Page;


	if (isset($_GET["notemplate"]) || !$Page->shouldDoLayout()) {
		$Page->LoadPage();
		echo $Page->ParseTemplate();
		die();
	}
	
	try {
		$Page->LoadPage();
		$Header->LoadPage();
		$Footer->LoadPage();
	} catch (PageException $E) {
		$CSession->Flash($E->getMessage(), FLASH_ERROR);
		Page::Redirect($E->getPage());
	} catch (Exception $E) {
		echo $E->getMessage();
		die();
	}

	//ob_start("ob_gzhandler");
	echo $Header->ParseTemplate();
	echo $Page->ParseTemplate();
	echo $Footer->ParseTemplate();
?>