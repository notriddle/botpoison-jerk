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
 			$counter = "counter"      ; //Replace with path to a writable file (set to 0 initially)
			$p = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ ";
			$l = strlen($p) - 1;
			if (isset($_GET['id']) && $_GET['id'] % 2 === 0) {
				sleep(1);
				header('Location: index.php?q='. $p[rand(0, $l - 1)]);
				exit();
			}
			if (isset($_GET['q']) && $_GET['q'] != 'a') {
				sleep(1);
				header('Location: index.php?q=' . $p[rand(0, $l - 1)]);
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
			header('Status: 200');
 			$c = file_get_contents($counter);
			if (isset($_GET['id']) && $_GET['id'] > $c) {
				$c = $_GET['id'] + 1;
			}
 			for ($i=0; $i < 750; $i++) {
 				print '<a href="https://agile-crag-85952.herokuapp.com/index.php?id=' . ($i + $c) . '">';
				for ($j = 0; $j < rand(1, 10); ++$j) {
					print $p[rand(0, $l)];
				}
				print '</a> ';
 			}
 			file_put_contents($counter, $c + 1);
 		?>	
	</body>
</html>
