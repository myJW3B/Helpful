<?php

include __DIR__.'/../Helpful/Str.php';

echo "\n\n";
echo 'Example for method camel():'.PHP_EOL;
echo 'echo JW3B\Helpful\Str::camel("example text");'.PHP_EOL;
echo JW3B\Helpful\Str::camel("example text");

echo "\n\n";
echo 'Example for method clean_url():'.PHP_EOL;
echo 'echo JW3B\Helpful\Str::clean_url("example text");'.PHP_EOL;
echo JW3B\Helpful\Str::clean_url("example text");

echo "\n\n";
echo 'Example for method e():'.PHP_EOL;
echo 'echo JW3B\Helpful\Str::e(""example \'text\'");'.PHP_EOL;
echo JW3B\Helpful\Str::e("\"example 'text'");

echo "\n\n";
echo 'Example for method form_element_name():'.PHP_EOL;
echo 'echo JW3B\Helpful\Str::form_element_name("example text");'.PHP_EOL;
echo JW3B\Helpful\Str::form_element_name("example text");

echo "\n\n";
echo 'Example for method fromBase64():'.PHP_EOL;
echo 'echo JW3B\Helpful\Str::fromBase64("ZXhhbXBsZSB0ZXh0");'.PHP_EOL;
echo JW3B\Helpful\Str::fromBase64("ZXhhbXBsZSB0ZXh0");

echo "\n\n";
echo 'Example for method headline():'.PHP_EOL;
echo 'echo JW3B\Helpful\Str::headline("example text");'.PHP_EOL;
echo JW3B\Helpful\Str::headline("example text");

echo "\n\n";
echo 'Example for method kebab():'.PHP_EOL;
echo 'echo JW3B\Helpful\Str::kebab("exampleText");'.PHP_EOL;
echo JW3B\Helpful\Str::kebab("example text");

echo "\n\n";
echo 'Example for method lcfirst():'.PHP_EOL;
echo 'echo JW3B\Helpful\Str::lcfirst("EXAMPLE TEXT");'.PHP_EOL;
echo JW3B\Helpful\Str::lcfirst("EXAMPLE TEXT");

echo "\n\n";
echo 'Example for method length():'.PHP_EOL;
echo 'echo JW3B\Helpful\Str::length("example text");'.PHP_EOL;
echo JW3B\Helpful\Str::length("example text");

echo "\n\n";
echo 'Example for method limit():'.PHP_EOL;
echo 'echo JW3B\Helpful\Str::limit("example text", 4);'.PHP_EOL;
echo JW3B\Helpful\Str::limit("example text", 4).PHP_EOL;
echo 'echo JW3B\Helpful\Str::limit("example text", 4, "**");'.PHP_EOL;
echo JW3B\Helpful\Str::limit("example text", 4, "**");

echo "\n\n";
echo 'Example for method lower():'.PHP_EOL;
echo 'echo JW3B\Helpful\Str::lower("Example Text");'.PHP_EOL;
echo JW3B\Helpful\Str::lower("Example Text");

echo "\n\n";
echo 'Example for method ltrim():'.PHP_EOL;
echo 'echo JW3B\Helpful\Str::ltrim("example text");'.PHP_EOL;
echo JW3B\Helpful\Str::ltrim("example text");

echo "\n\n";
echo 'Example for method p():'.PHP_EOL;
echo 'echo JW3B\Helpful\Str::p([\'some\', \'array\']);'.PHP_EOL;
echo JW3B\Helpful\Str::p(['some', 'array']);

//echo "\n\n";
//echo 'Example for method parse_my_url():'.PHP_EOL;
//echo 'echo JW3B\Helpful\Str::parse_my_url();'.PHP_EOL;
//echo JW3B\Helpful\Str::parse_my_url();

echo "\n\n";
echo 'Example for method randomString():'.PHP_EOL;
echo 'echo JW3B\Helpful\Str::randomString(12);'.PHP_EOL;
echo JW3B\Helpful\Str::randomString(12);

echo "\n\n";
echo 'Example for method removePound():'.PHP_EOL;
echo 'echo JW3B\Helpful\Str::removePound("#example #text");'.PHP_EOL;
echo JW3B\Helpful\Str::removePound("#example #text");

echo "\n\n";
echo 'Example for method rtrim():'.PHP_EOL;
echo 'echo JW3B\Helpful\Str::rtrim("example text");'.PHP_EOL;
echo JW3B\Helpful\Str::rtrim("example text");

echo "\n\n";
echo 'Example for method snake():'.PHP_EOL;
echo 'echo JW3B\Helpful\Str::snake("example text");'.PHP_EOL;
echo JW3B\Helpful\Str::snake("example text");

echo "\n\n";
echo 'Example for method studly():'.PHP_EOL;
echo 'echo JW3B\Helpful\Str::studly("example text");'.PHP_EOL;
echo JW3B\Helpful\Str::studly("example text");

echo "\n\n";
echo 'Example for method substr():'.PHP_EOL;
echo 'echo JW3B\Helpful\Str::substr("example text", 3, null, null);'.PHP_EOL;
echo JW3B\Helpful\Str::substr("example text", 3);

echo "\n\n";
echo 'Example for method swap():'.PHP_EOL;
echo 'echo JW3B\Helpful\Str::swap([\'text\' => \'class\'], "example text");'.PHP_EOL;
echo JW3B\Helpful\Str::swap(['text' => 'class'], "example text");

echo "\n\n";
echo 'Example for method title():'.PHP_EOL;
echo 'echo JW3B\Helpful\Str::title("example text");'.PHP_EOL;
echo JW3B\Helpful\Str::title("example text");

echo "\n\n";
echo 'Example for method toBase64():'.PHP_EOL;
echo 'echo JW3B\Helpful\Str::toBase64("example text");'.PHP_EOL;
echo JW3B\Helpful\Str::toBase64("example text");

echo "\n\n";
echo 'Example for method trim():'.PHP_EOL;
echo 'echo JW3B\Helpful\Str::trim("example text ");'.PHP_EOL;
echo JW3B\Helpful\Str::trim(" example text ");

echo "\n\n";
echo 'Example for method ucfirst():'.PHP_EOL;
echo 'echo JW3B\Helpful\Str::ucfirst("example text");'.PHP_EOL;
echo JW3B\Helpful\Str::ucfirst("example text");

echo "\n\n";
echo 'Example for method ucsplit():'.PHP_EOL;
echo 'echo JW3B\Helpful\Str::ucsplit("ExampleTextHere");'.PHP_EOL;
echo JW3B\Helpful\Str::p(JW3B\Helpful\Str::ucsplit("ExampleTextHere"));

echo "\n\n";
echo 'Example for method upper():'.PHP_EOL;
echo 'echo JW3B\Helpful\Str::upper("example text");'.PHP_EOL;
echo JW3B\Helpful\Str::upper("example text");

echo "\n\n";
echo 'Example for method wordWrap():'.PHP_EOL;
echo 'echo JW3B\Helpful\Str::wordWrap("example text", 3, "...");'.PHP_EOL;
echo JW3B\Helpful\Str::wordWrap("example text", 3, '...');
