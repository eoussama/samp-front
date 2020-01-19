<?php

/**
 * @name:       Samp Front
 * @version:    0.5.0
 * @author:     EOussama (eoussama.github.io)
 * @license     MIT
 * @source:     github.com/EOussama/samp-front
 * 
 * The page that shows up whenever an error of code 404 or 403 are fired.
 */

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
$host = 'http://' . $config['path']['host'] . 'public/';

// Setting up the $inverted string, used to make the dark mode
// work if enabled.
$inverted = $config['website']['darkMode'] ? 'inverted' : '';
?>

<!DOCTYPE html>

<html lang="en">

<head>

	<!-- The meta data. -->
	<meta charset="UTF-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="author" content="<?php echo $config['general']['owner']; ?>">
	<meta name="application-name" content="<?php echo $config['general']['name']; ?>">
	<meta name="description" content="<?php echo $config['general']['slogan']; ?>">
	<meta name="keywords" content="<?php echo join(', ', $config['general']['keywords']); ?>">

	<!-- Semantic UI. -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">

	<!-- The main stylesheet. -->
	<link rel="stylesheet" href="<?php echo $host . pathfy('css', 'error/error.css', true); ?>">

	<!-- The website's favicon. -->
	<link rel="shortcut icon" type="image/png" href="<?php echo $host . pathfy('img', 'logo.png', true); ?>">

	<!-- The website's title -->
	<title><?php echo $config['general']['name']; ?></title>
</head>

<body class="<?php echo $config['website']['darkMode'] ? "dark" : "";  ?>">
	<main class="ui container">

		<!-- The page's content -->
		<div class="content-wrapper">
			<img src="<?php echo $host . pathfy('img', 'logo.png', true); ?>" alt="<?php echo $config['general']['name']; ?>'s logo.">
			<h1><?php echo $config['general']['name']; ?></h1>

			<p>Page doesn't exist!</p>

			<div class="ui divider"></div>
			<div class="ui large buttons">
				<a id="home-btn" href="<?php echo $host ?>" class="ui <?php echo $inverted; ?> button">Home</a>
				<div class="or"></div>
				<button id="back-btn" class="ui <?php echo $inverted; ?> button">Back</button>
			</div>
		</div>
	</main>

	<!-- The footer. -->
	<footer class="ui basic segment">

		<!-- Trademark -->
		<?php require_once pathfy('templates', '_trademark.php'); ?>
	</footer>

	<!-- JQuery. -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<!-- The main script -->
	<script src="<?php echo $host . pathfy('js', 'error/error.js', true); ?>"></script>
</body>

</html>