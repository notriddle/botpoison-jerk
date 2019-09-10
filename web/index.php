<?php
/*
 * BotPoison - Bad bot poisoning system
 * As the name implies, BotPoison "poisons" bad Web crawlers.
 * It works by creating tens of thousands of slightly
 * different links to itself, to quickly dominate a crawler's
 * backlog. Well-behaved bots are NOT affected, as it uses
 * the robots <meta> tag to make proper bots ignore it.
 * BotPoison is released under Creative Commons CC0 Public
 * Domain Dedication.
 * https://creativecommons.org/publicdomain/zero/1.0/
 */
 			$link    = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']; //The URL to this page
 			$counter = "counter"      ; //Replace with path to a writable file (set to 0 initially)
 			$c = file_get_contents($counter);
			$p = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ ";
			$l = strlen($p) - 1;
			if (isset($_GET['id']) && $_GET['id'] % 2 === 0) {
				header('Location: '.$link . "?id=" . $_GET['id']);
				exit();
			}
			if (isset($_GET['q'])) {
				header('Location: '.$link . "?q=" . $p[rand(0, $l - 1)]);
				exit();
			}

?><!DOCTYPE html>
<html lang=en>
	<head>
		<title>My Awesome Page</title>
		<meta name=viewport content="width=device-width, initial-scale=1.0">
		<meta name=charset content=utf-8>
		<meta name=robots content="noindex, nofollow">
	</head>
	<body>
<?php
 			for ($i=0; $i < 75000; $i++) {
 				print '<a href="' . $link . "?id=" . ($i + $c) . '">';
				for ($j = 0; $j < rand(1, 10); ++$j) {
					print $p[rand(0, $l)];
				}
				print '</a> ';
 			}
 			file_put_contents($counter, $c + 75000);
 		?>	
	</body>
</html>
