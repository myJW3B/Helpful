<?php
use JW3B\erday\Helpful_Color;
// include the colour class
include __DIR__.'/../erday/Helpful_Color.php';

//============================================================
?>
<!DOCTYPE html>
<html lang="en-gb">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="description" content="Page description"/>
<meta name="keywords" content="page keywords"/>
<style type="text/css">
	body {
		padding: 20px;
	}
</style>
<title>PHPColor Examples</title>
</head>
<body>
	<h1>PHPColor Examples</h1>
	<hr/>
	<h3>Create a Color object</h3>

	<h5>Code</h5>
	<pre><code>$c = new Helpful_Color(255, 0, 0);</code></pre>
	<hr/>
	<h3>Get a colour's HEX code</h3>

	<h5>Code</h5>
	<pre><code>$c = new Helpful_Color(255, 0, 0);
print $c->getHex();
print '&lt;br/&gt;';
print $c->getHex(true);</code></pre>

	<h5>Output</h5>
	<p><?php
	$c = new Helpful_Color(255, 0, 0);
	print $c->getHex();
	print '<br/>';
	print $c->getHex(true);
	?></p>
	<hr/>
	<h3>Create a Color object using a HEX code</h3>

	<h5>Code</h5>
	<pre><code>$c = new Helpful_Color();
$c->setHex('#ff0000') // accepts 3-character or 6-character variants</code></pre>
	<hr/>
	<h3>Mix two colours</h3>

	<h5>Code</h5>
	<pre><code>$c1 = new Helpful_Color(255, 0, 0);
$c2 = new Helpful_Color(0, 0, 204);
$c3 = Helpful_Color::mix($c1, $c2);
print $c3->getHex(true);</code></pre>

	<h5>Output</h5>
	<p><?php
	$c1 = new Helpful_Color(255, 0, 0);
	$c2 = new Helpful_Color(0, 0, 204);
	$c3 = Helpful_Color::mix($c1, $c2);
	print $c3->getHex(true);
	?></p>

	<h5>Visual</h5>
	<p>
		<span style="color:<?php print $c1->hex; ?>;">Colour 1</span>
		mixed with
		<span style="color:<?php print $c2->hex; ?>;">Colour 2</span>
		makes
		<span style="color:<?php print $c3->hex; ?>;">Colour 3</span>
	</p>
	<hr/>
	<h3>Get a colour range</h3>

	<h5>Code</h5>
	<pre><code>$c1 = new Helpful_Color(0, 0, 255);
$c2 = new Helpful_Color(0, 255, 0);
$range = Helpful_Color::range($c1, $c2, 10);
foreach ($range as $cr){
	print $cr->getHex(true);
	print ', ';
	}</code></pre>

	<h5>Output</h5>
	<p><?php
	$c1 = new Helpful_Color(0, 0, 255);
	$c2 = new Helpful_Color(0, 255, 0);
	$range = Helpful_Color::range($c1, $c2, 10);
	foreach ($range as $cr){
		print $cr->getHex(true);
		print ', ';
		}
	?></p>

	<h5>Visual</h5>
	<p class="container"><?php
	foreach ($range as $cr){
		print '<span style="width:20px;height:20px;display:block;float:left;background:' . $cr->hex . ';"></span>';
		}
	?></p>
</body>
</html>