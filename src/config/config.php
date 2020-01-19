<?php

/**
 * @name:       Samp Front
 * @version:    0.5.0
 * @author:     EOussama (eoussama.github.io)
 * @license     MIT
 * @source:     github.com/EOussama/samp-front
 * 
 * This file is responsible on loading the configurations from
 * the config.ini file and setting them up for use.
 */

#region Setting up the configurations.

// Loading the configurations from the config.ini file.
$config = parse_ini_file('config.ini', true);

/**
 * The paths to different parts of the website.
 */
$config['path'] = array(

	/**
	 * The absolute path of the website's folder.
	 */
	'root'          => $_SERVER['DOCUMENT_ROOT'],

	/**
	 * The path to the folder that contains controllers.
	 */
	'controllers'   => 'controllers/',

	/**
	 * The path to the folder that contains the helper funtions.
	 */
	'helpers'       => 'helpers/',

	/**
	 * The path to the folder that contains 3rd party scripts.
	 */
	'lib'           => 'lib/',

	/**
	 * The path to the folder that contains models.
	 */
	'models'        => 'models/',

	/**
	 * The path to the folder that process scripts.
	 */
	'process'       => 'process/',

	/**
	 * The path to the folder that serves public files.
	 */
	'public'        => 'public/',

	/**
	 * The path to the folder that contains reusable components.
	 */
	'templates'     => 'templates/',

	/**
	 * The path to the folder that contains views.
	 */
	'views'         => 'views/',

	/**
	 * The path to the folder that contains javascript files.
	 */
	'js'            => 'assets/js/',

	/**
	 * The path to the folder that contains stylesheet files.
	 */
	'css'           => 'assets/css/',

	/**
	 * The path to the folder that contains images.
	 */
	'img'           => 'assets/img/'
);

/**
 * Samp Front's configurations.
 */
define('CONFIG', serialize($config));

#endregion

#region Retrieving the configurations.

/**
 * Returns the configurations if requested.
 */
if (isset($_GET['q'])) {

	$data = array(
		'path' => array(
			'news' => $config['path']['controllers'] . 'news/',
			'root' => $_SERVER['HTTP_HOST'] . $config['path']['root'],
			'liveStats' => $config['path']['process']
		),
		'website' => array(
			'scrollSpeed'           => $config['website']['scrollSpeed'],
			'liveUpdateInterval'    => $config['website']['liveUpdateInterval']
		)
	);

	echo json_encode($data);
}

#endregion

/**
 * Concatenates two paths together.
 * 
 * @param string $folder: The target folder.
 * @param string $file: The target file.
 * @param boolean $public: Whether or not the target file is in the public scope.
 * @param boolean $view: Whether or not the target file is going ot be loaded in a view page.
 * 
 * @return string The combination of the two paths.
 */
function pathfy($folder, $file, $public = false, $view = false)
{
	global $config;

	return $view
		? './../' . $config['path'][$folder] . $file
		: ($public ? '' : $config['path']['root']) . $config['path'][$folder] . $file;
}
