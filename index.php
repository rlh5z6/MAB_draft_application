<?php
if(file_exists('vendor/autoload.php')){
	require 'vendor/autoload.php';
} else {
	echo "<h1>Please install via composer.json</h1>";
	echo "<p>Install Composer instructions: <a href='https://getcomposer.org/doc/00-intro.md#globally'>https://getcomposer.org/doc/00-intro.md#globally</a></p>";
	echo "<p>Once composer is installed navigate to the working directory in your terminal/command promt and enter 'composer install'</p>";
	exit;
}

if (!is_readable('app/core/config.php')) {
	die('No config.php found, configure and rename config.example.php to config.php in app/core.');
}

/*
 *---------------------------------------------------------------
 * APPLICATION ENVIRONMENT
 *---------------------------------------------------------------
 *
 * You can load different configurations depending on your
 * current environment. Setting the environment also influences
 * things like logging and error reporting.
 *
 * This can be set to anything, but default usage is:
 *
 *     development
 *     production
 *
 * NOTE: If you change these, also change the error_reporting() code below
 *
 */
	define('ENVIRONMENT', 'development');
/*
 *---------------------------------------------------------------
 * ERROR REPORTING
 *---------------------------------------------------------------
 *
 * Different environments will require different levels of error reporting.
 * By default development will show errors but production will hide them.
 */

if (defined('ENVIRONMENT')){

	switch (ENVIRONMENT){
		case 'development':
			error_reporting(E_ALL);
		break;

		case 'production':
			error_reporting(0);
		break;

		default:
			exit('The application environment is not set correctly.');
	}

}

//initiate config
new \core\config();

//create alias for Router
use \core\router,
    \helpers\url;

//define routes
//define routes
Router::any('', '\controllers\login@index');
Router::any('login', '\controllers\login@login');
Router::any('welcome', '\controllers\welcome@index');
Router::any('logout', '\controllers\auth@logout');
Router::any('registerSiteLeader', '\controllers\registerSiteLeader@create');
Router::any('trip', '\controllers\trip@create');
Router::any('draft', '\controllers\draft@create');
Router::any('wishlist', '\controllers\wishlist@create');
Router::any('validateAppId', '\controllers\wishlist@validateAppId');
Router::any('exec', '\controllers\exec@create');
Router::any('board', '\controllers\board@create');
Router::any('siteLeader', '\controllers\siteLeader@create');
Router::any('registerTrip', '\controllers\registerTrip@create');
Router::any('tripBoard', '\controllers\tripBoard@create');
Router::any('applications', '\controllers\applications@create');
Router::any('locations', '\controllers\locations@create');
Router::any('apply', '\controllers\apply@index');
Router::any('apply_submit', '\controllers\apply@submit');
Router::any('changepassword', '\controllers\changepassword@index');
Router::any('changepassword_submit', '\controllers\changepassword@submit');
Router::any('registerBoardMember', '\controllers\registerAdmin@index');
Router::any('registerBoardMember_submit', '\controllers\registerAdmin@submit');
Router::any('draftBoard', '\controllers\draftBoard@index');
Router::any('draftBoard_wishlist', '\controllers\draftBoard@wishlist');
Router::any('draftBoard_search', '\controllers\draftBoard@search');
Router::any('draftBoard_main', '\controllers\draftBoard@draftBoard');
Router::any('trip_analytics', '\controllers\trip_analytics@create');
Router::any('application_analytics', '\controllers\application_analytics@create');

//ajax routes
Router::any('ajax/applicantSearch', '\controllers\ajax@applicantSearch');
Router::any('ajax/applicantAnswers', '\controllers\ajax@applicantAnswers');
Router::any('ajax/checkTurn', '\controllers\ajax@checkTurn');
Router::any('ajax/draft', '\controllers\ajax@draft');
Router::any('ajax/updateTurn', '\controllers\ajax@updateTurn');
Router::any('ajax/getDrafted', '\controllers\ajax@getDrafted');
Router::any('ajax/startDraft', '\controllers\ajax@beginDraft');
Router::any('ajax/finalizeDraft', '\controllers\ajax@finalizeDraft');
Router::any('ajax/getDraftOrder', '\controllers\ajax@getDraftOrder');


//if no route found
Router::error('\core\error@index');

//turn on old style routing
Router::$fallback = false;

//execute matched routes
Router::dispatch();

// debugger
