<?php

// gimme the important stuff...
include ('includes/functions.php');

// get config
$config = config();

	// adding an nzb?
	if ( isset( $_REQUEST['addnzb'] ) )
	{
		// if we've specified an NZB title..
		if ( !isset( $_REQUEST['title'] ) )
		{
			$_REQUEST['title'] = null;
		}

		// if we've specified an NZB category..
		if ( !isset( $_REQUEST['cat'] ) )
		{
			$_REQUEST['cat'] = null;
		}

		// go!
		toSab($_REQUEST['url']);
	}

	// have we searched?
	else if ( isset( $_REQUEST['search'] ) )
	{
		// get search results JSON
		$search = str_replace( array(' '), array('+'), $_REQUEST['search'] );
		$contents = file_get_contents( 'http://beta.nzbs.org/api?t=search&q='.$search.'&apikey='.$config['nzbsApiKey'].'&o=json' );
		
		if (substr($contents, 0, 5) == '<?xml'){
			echo 'nzbs.org API key error..';
			die();
		}
		
		$data = json_decode( $contents );
	}

	// selected a category?
	else if ( isset( $_REQUEST['showcat'] ) )
	{
		// get custom category results JSON
		$contents = file_get_contents ( 'http://beta.nzbs.org/api?t=search&apikey='.$config['nzbsApiKey'].'&o=json&cat='.$cats );
		
		if (substr($contents, 0, 5) == '<?xml'){
			echo 'nzbs.org API key error..';
			die();
		}

		$cats = $config['categories'][$_REQUEST['showcat']];

		$data = json_decode( $contents );
	}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Search, bro.</title>
		<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
		<link href='http://fonts.googleapis.com/css?family=Monda:400,700' rel='stylesheet' type='text/css'/>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		<script src="js/script.js"></script>
	</head>
<body>
<?php

	// remove + from our search query for outputting into page.
	if ( isset ( $search ) )
	{
		$search = str_replace(array('+'), array(' '), $search);
		$searchValue = $search;
	} else {
		$searchValue = '';
	}

	// header bar with your custom categories
	echo '<ul class="header-bar">';

	foreach( $config['categories'] as $catKey => $catVals )
	{
		echo '<li><a href="?showcat='.$catKey.'">'.$catKey.'</a></li>';
	}

	echo '</ul>';
	echo '<div class="container">';
	echo '<h1 class="title">searchbro.</h1>';
	echo '<form action="./" method="post" name="form">';
	echo '<input type="text" name="search" value="'.$searchValue.'"/><br/><input type="submit" name="submit" value="Search, bro."/>';	
	echo '</form>';

	if ( isset ( $search ) )
	{
		echo '<h2>Searched for: '.str_replace(array('+'), array(' '), $search).'</h2>';
	}

	if (isset($data)){
		showResults($data);
	}

?>
</div>
</body></html>
