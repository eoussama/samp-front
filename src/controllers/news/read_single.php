<?php

/**
 * @name:       Samp Front
 * @version:    0.5.1
 * @author:     EOussama (eoussama.github.io)
 * @license     MIT
 * @source:     github.com/EOussama/samp-front
 */

// Setting the header.
header('Content-type: application/json');

/**
 * Only disable errors if you're pushing this
 * into a production environment.
 * In order to disable it, change `E_ALL` to `0`.
 */
error_reporting(E_ALL);

// Requiring the configurations.
require_once "./../../config/config.php";

// Loading the configurations.
$config = unserialize(CONFIG);

// Requiring all dependancies.
require_once pathfy('models', 'Database.php');
require_once pathfy('models', 'News.php');

// Sanitizing the id.
$id = htmlspecialchars(strip_tags($_GET['id']));

// Instantiating a new database connection.
$db = new Database(
	$config['database']['host'],
	$config['database']['port'],
	$config['database']['name'],
	$config['database']['user'],
	$config['database']['pass']
);

// Getting a connection object.
$conn = $db->connect();

// Instantiating a new News object.
$news = new News($conn, $config['database']['newsTable']);

// Getting the news article's data.
$news->read_single($id);

// Decoding the html body.
$news->body = htmlspecialchars_decode($news->body);

// Sending the fetched data.
echo json_encode($news);
