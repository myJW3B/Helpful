<?php

declare(strict_types=1);

namespace JW3B\Tests;

use JW3B\Helpful\HTML;
use PHPUnit\Framework\TestCase;

class HelpfulHtmlTest extends TestCase
{
	public function testSvgImgGeneratesCorrectSvg()
	{
		$result = Helpful_HTML::svg_img(200, 100, 'Test');
		$expected = '<svg width="200" height="100"><rect x="0" y="0" width="200" height="100" fill="white"/><text x="50%" y="50%" dominant-baseline="middle" text-anchor="middle" stroke="black" stroke-width="1px" fill="currentColor">Test</text></svg>';

		$this->assertSame($expected, $result);
	}

	public function testBreadcrumbGeneratesCorrectHtml()
	{
		$pages = [
			'/home' => 'Home',
			'/about' => 'About',
		];
		$result = Helpful_HTML::breadcrumb($pages);
		$expected = '<ol class="breadcrumb"><li><a href="/home">Home</a></li><li><a href="/about">About</a></li></ol>';

		$this->assertStringContainsString($expected, $result);
	}

	public function testSetUpLinksGeneratesCorrectLinks()
	{
		$tags = 'tag1,tag2,tag3';
		$result = (new Helpful_HTML())->setUpLinks($tags, '/tags/', '/');
		$expected = '<a href="/tags/tag1/">tag1</a>, <a href="/tags/tag2/">tag2</a>, <a href="/tags/tag3/">tag3</a>';

		$this->assertSame($expected, $result);
	}

	// Add more tests for other methods...
}
