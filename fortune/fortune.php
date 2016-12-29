<?php

class Source {

	public $path;
	public $type;
	public $enabled;
	public $auth;

	/**
	 * @param string $path - 'system_path/file_name'|'mysql:host={HOST};dbname={DBNAME}'
	 * @param string  $type - 'xml'|'txt'|'db'
	 * @param boolean $enabled - true|false
	 * @param array $auth - array('host'[optional], 'name'[optional], 'user', 'pass')
	 */
	public function __construct($path, $type, $enabled, array $auth = null) {
		$this->path = $path;
		$this->type = $type;
		$this->enabled = $enabled;
		$this->auth = $auth;
	}

}

class Quote {

	public $text;
	public $author;

	/**
	 * @param string $text - (quote text)
	 * @param string $author - (quote author) [optional]
	 */
	public function __construct($text, $author = null) {
		$this->text = $text;
		$this->author = $author;
	}

}

/*
 * DB Access Details 
 */
$db = array(
	'host' => 'localhost',
	'name' => 'quotes',
	'user' => 'quotes',
	'pass' => 's3crEt'
);

$sources = array();

/*
 * Initilize sources
 * You can change file names, disable Sources or add more Sources
 */
$sources[] = new Source('quotes.xml', 'xml', true);
$sources[] = new Source('quotes.txt', 'txt', true);
$sources[] = new Source('mysql:host=localhost;dbname=quotes', 'db', true, $db);

$quotes = array();

$q = isset($_GET['q']) ? $_GET['q'] : null;

/*
 * Retrieve quotes from Sources
 */
if (!empty($sources)) {
	foreach ($sources as $source) {
		if ($source->enabled) {

			switch ($source->type) {
				case 'xml':
					$xml = simplexml_load_file($source->path);
					if ($xml !== false) {
						foreach ($xml->quote as $quote) {
							if ($quote->text) {
								$quotes[] = new Quote($quote->text, $quote->author);
							}
						}
					} else {
						echo "XML Source - input error\n";
					}
					break;

				case 'txt':
					$txt_str = file_get_contents($source->path);
					if ($txt_str !== false) {
						$txt = preg_split('/\r\n|\r|\n/', $txt_str);
						if (is_array($txt)) {
							foreach ($txt as $quote) {
								if ($quote) {
									$quotes[] = new Quote($quote);
								}
							}
						}
					} else {
						echo "TXT Source - can't read file '" . $source->path . "'\n";
					}
					break;

				case 'db':
					try {
						$dbh = new PDO($source->path . ";charset=utf8", $source->auth['user'], $source->auth['pass']);
						$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						$query = "SELECT * from quote";
						$sth = $dbh->prepare($query);
						$sth->execute();
						$quotes_db = $sth->fetchAll();
						foreach ($quotes_db as $quote) {
							if ($quote['quote']) {
								$quotes[] = new Quote($quote['quote']);
							}
						}
					} catch (PDOException $Exception) {
						echo "DB Source - input error\n";
					}
					break;

				default:
					echo "Uknown source type for '" . $source->path . "'\n";
			}
		}
	}
} else {
	echo "No Sources to pick names from\n";
}

/*
 * Shuffle quotes - (get random quote each time)
 */
$random_quote = null;
 
if (!empty($quotes) && shuffle($quotes)) {
	
	$random_quote = $quotes[0]; // it will be random every time, because we shuffle the whole quotes array
	
	if ($q && $q != "*all*") {
		foreach ($quotes as $key => $quote) {
			if (stripos($quote->text, $q) !== false) {
				$random_quote = $quote;
				break;
			}
		}
	}

} else {
	echo "Could generate random quotes";
}

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Fortune - Quotes</title>
	</head>
	<body>
		<ul id="quotes">

<?php
	/*
	 * Output quites
	 */
	if ($quotes) {
		if ($q == "*all*") {
			foreach($quotes as $key => $quote) {
				?>

			<li class="quote">
				<?=$quote->text?>
				<?php if($quote->author) { ?>
				<i class="author"> - <?=$quote->author?></i>
				<?php } ?>
			</li>
				<?php
			}
		} elseif ($random_quote) {
				?>

			<li class="quote">
				<?=$random_quote->text?>
				<?php if($random_quote->author) { ?>
				<i class="author"> - <?=$random_quote->author?></i>
				<?php } ?>
			</li>
				<?php
		}
	}
?>

		</div>
	</body>
</html>