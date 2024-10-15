<?php

namespace JW3B\Helpful;

use JW3B\Helpful\Str;

class HTML {

	/**
	 * Generates an SVG image with a specified width, height, and text.
	 *
	 * @param int $width Width of the SVG image.
	 * @param int $height Height of the SVG image.
	 * @param string $text Text to display in the SVG.
	 * @return string HTML string of the SVG image.
	 */
	public static function svg_img(int $width = 100, int $height = 100, string $text = ''): string
	{
		$text = htmlspecialchars($text, ENT_QUOTES); // Escape output for security
		return '<svg width="' . $width . '" height="' . $height . '">
			<rect x="0" y="0" width="' . $width . '" height="' . $height . '" fill="white"/>
			<text x="50%" y="50%" dominant-baseline="middle" text-anchor="middle" stroke="black" stroke-width="1px" fill="currentColor">' . $text . '</text>
		</svg>';
	}

	/**
	 * Generates a breadcrumb navigation.
	 *
	 * @param array $pgs Array of page links and titles.
	 * @param array $right Array of right-aligned page links.
	 * @param string $add_class Additional CSS classes for styling.
	 * @return void
	 */
	public static function breadcrumb(array $pgs, array $right = [], string $add_class = ''): void
	{
		$breadcrumb = '<ol class="breadcrumb' . htmlspecialchars($add_class, ENT_QUOTES) . '">';
		if (is_array($pgs)) {
			foreach ($pgs as $k => $v) {
				if (is_array($v)) {
					$breadcrumb .= '<li class="active">' . htmlspecialchars($v[0], ENT_QUOTES) . '</li>';
				} else {
					$breadcrumb .= '<li><a href="' . htmlspecialchars($k, ENT_QUOTES) . '">' . htmlspecialchars($v, ENT_QUOTES) . '</a></li>';
				}
			}
		}
		if (is_array($right)) {
			foreach ($right as $k => $v) {
				if (is_array($v)) {
					$breadcrumb .= '<li class="pull-right active">' . htmlspecialchars($v[0], ENT_QUOTES) . '</li>';
				} else {
					$breadcrumb .= '<li class="pull-right"><a href="' . htmlspecialchars($k, ENT_QUOTES) . '">' . htmlspecialchars($v, ENT_QUOTES) . '</a></li>';
				}
			}
		}
		$breadcrumb .= '</ol>';
		return $breadcrumb;
	}

	/**
	 * Sets up links from a comma-separated list of tags.
	 *
	 * @param string $tags Comma-separated list of tags.
	 * @param string $b4Link Base URL before the tag.
	 * @param string $afterLink URL suffix after the tag.
	 * @param string $sep Separator used to split the tags.
	 * @return string HTML string of links.
	 */
	public function setUpLinks(string $tags, string $b4Link, string $afterLink = '/', string $sep = ','): string
	{
		$tt = explode($sep, $tags);
		$links = [];
		foreach ($tt as $k2) {
			if ($k2 !== '') {
				$rp = $this->removePound($k2);
				$links[] = '<a href="' . htmlspecialchars($b4Link . Str::clean_url($rp) . $afterLink, ENT_QUOTES) . '">' . htmlspecialchars($rp, ENT_QUOTES) . '</a>';
			}
		}
		return implode(', ', $links); // Join links with a comma and space
	}

	/**
	 * Generates a tag cloud from an associative array of tags and their frequencies.
	 *
	 * @param array $tags Associative array of tags and their frequency counts.
	 * @param string $b4Link Base URL before the tag.
	 * @param string $afterLink URL suffix after the tag.
	 * @return string HTML string of the tag cloud or a message if no tags are found.
	 */
	public function tagCloud(array $tags, string $b4Link, string $afterLink = '/'): string
	{
		if (!is_array($tags) || count($tags) === 0) {
			return 'No Tags Found';
		}

		$t = 0;
		arsort($tags); // Highest value first, DESC
		$Rtags = [];
		foreach ($tags as $k => $v) {
			$Rtags[$k] = $v;
			$t++;
			if ($t === 100) break; // Limit to 100 tags
		}

		ksort($Rtags); // Sort tags in alphabetical order
		$max_size = 250; // Max font size in %
		$min_size = 80;  // Min font size in %
		$max_qty = max($Rtags);
		$min_qty = min($Rtags);
		$spread = $max_qty - $min_qty;

		if ($spread === 0) { // Avoid division by zero
			$spread = 1;
		}

		$step = ($max_size - $min_size) / $spread;
		$ret = '';

		foreach ($Rtags as $k => $v) {
			$size = $min_size + (($v - $min_qty) * $step);
			$rp = $this->removePound($k);
			$ret .= '<a href="' . htmlspecialchars($b4Link . Str::clean_url($rp) . $afterLink, ENT_QUOTES) . '" class="load-page" title="' . htmlspecialchars($rp, ENT_QUOTES) . ' tagged ' . htmlspecialchars($v, ENT_QUOTES) . ' times" rel="tag" style="font-size: ' . $size . '%">' . htmlspecialchars($rp, ENT_QUOTES) . '</a> ';
		}
		return $ret;
	}

	/**
	 * Generates pagination links based on current page and total items.
	 *
	 * @param int $pageNum Current page number.
	 * @param int $totalPerPage Total items per page.
	 * @param int $howMany Total number of items.
	 * @param string $b4page Base URL before the page number.
	 * @param string $afterPage URL suffix after the page number.
	 * @param string $hideLast Option to hide the last page link.
	 * @param array $extra Additional parameters for pagination.
	 * @return string HTML string of pagination links.
	 */
	public static function browse(int $pageNum, int $totalPerPage, int $howMany, string $b4page, string $afterPage = "", string $hideLast = '', array $extra = []): string
	{
		$divClass = isset($extra['divClass']) ? ' ' . htmlspecialchars($extra['divClass'], ENT_QUOTES) : ' justify-content-center';
		$b4 = isset($extra['b4']) ? htmlspecialchars($extra['b4'], ENT_QUOTES) : '';
		$afterPg = isset($extra['after']) ? htmlspecialchars($extra['after'], ENT_QUOTES) : '';
		$ret = '<nav aria-label="Paging Current Section">' . $b4 . '
			<ul class="pagination' . $divClass . '">';
		$maxPage = ceil($howMany / $totalPerPage);
		// First page
		if ($pageNum === 1) {
			$ret .= '<li class="page-item disabled"><a class="page-link">' . l('Prev') . '</a></li>
			<li class="page-item active"><a class="page-link">1</a></li>';
		} else {
			$prev = $pageNum - 1;
			$ret .= '<li class="page-item"><a class="page-link" href="' . htmlspecialchars($b4page . $prev . $afterPage, ENT_QUOTES) . '">' . l('Prev') . '</a></li>
			<li class="page-item"><a class="page-link" href="' . htmlspecialchars($b4page . '1' . $afterPage, ENT_QUOTES) . '" title="' . l('Go To Page') . ' 1">1</a></li>';
		}
		for ($x = $pageNum - 3; $x < $pageNum + 3; $x++) {
			if ($x > 1 && $x < $maxPage) {
				if ($x === $pageNum) {
					$ret .= '<li class="page-item active"><a class="page-link">' . $x . '</a></li>';
				} else {
					$ret .= '<li class="page-item"><a class="page-link" href="' . htmlspecialchars($b4page . $x . $afterPage, ENT_QUOTES) . '" title="' . l('Go To Page') . ' ' . $x . '">' . $x . '</a></li>';
				}
			}
		}
		if ($maxPage !== 0 && $hideLast === '') {
			if ($pageNum === $maxPage) {
				$ret .= '<li class="page-item disabled"><a class="page-link">' . $maxPage . '</a></li>';
			} else {
				$ret .= '<li class="page-item"><a class="page-link" href="' . htmlspecialchars($b4page . $maxPage . $afterPage, ENT_QUOTES) . '" title="' . l('Go To Page') . ' ' . $maxPage . '">' . $maxPage . '</a></li>';
			}
		}
		if ($pageNum < $maxPage) {
			$ret .= '<li class="page-item"><a class="page-link" href="' . htmlspecialchars($b4page . ($pageNum + 1) . $afterPage, ENT_QUOTES) . '">' . l('Next') . '</a></li>';
		} else {
			$ret .= '<li class="page-item disabled"><a class="page-link">' . l('Next') . '</a></li>';
		}
		$ret .= '</ul></nav>';
		return $ret;
	}

	// I didnt feel like writing my own AGAIN...
	// http://css-tricks.com/snippets/php/pagination-function/
	/*<ul class="pagination">
	<li class="disabled"><a href="#">&laquo;</a></li>
	<li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
	...
	</ul>
	*/
	/**
 	* Generates a pagination HTML structure.
 	*
 	* @param int $item_count The total number of items.
 	* @param int $limit The number of items per page.
 	* @param int $cur_page The current page number.
 	* @param string $link The URL pattern for pagination links.
 	*
 	* @return string|null The generated HTML for pagination, or null if there are no pages to display.
 	*/
	public function pagination(int $item_count, int $limit, int $cur_page, string $link): ?string
	{
		$page_count = ceil($item_count / $limit);
		$current_range = [
			($cur_page - 2 < 1 ? 1 : $cur_page - 2),
			($cur_page + 2 > $page_count ? $page_count : $cur_page + 2)
		];

		// First and Last pages
		$first_page = $cur_page > 3
			? '<li><a href="' . htmlspecialchars(sprintf($link, 1), ENT_QUOTES) . '">1</a></li>'
			. ($cur_page < 5 ? '' : '<li class="disabled"><a href="#">...</a></li>')
			: null;

		$last_page = $cur_page < $page_count - 2
			? ($cur_page > $page_count - 4 ? '' : '<li class="disabled"><a href="#">...</a></li>')
			. '<li><a href="' . htmlspecialchars(sprintf($link, $page_count), ENT_QUOTES) . '">' . $page_count . '</a></li>'
			: null;

		// Previous and next page
		$previous_page = $cur_page > 1
			? '<li><a href="' . htmlspecialchars(sprintf($link, ($cur_page - 1)), ENT_QUOTES) . '">&laquo;</a></li>'
			: null;

		$next_page = $cur_page < $page_count
			? '<li><a href="' . htmlspecialchars(sprintf($link, ($cur_page + 1)), ENT_QUOTES) . '">&raquo;</a></li>'
			: null;

		// Display pages that are in range
		$pages = [];
		for ($x = $current_range[0]; $x <= $current_range[1]; ++$x) {
			$active = $x == $cur_page ? ' class="active"' : '';
			$pages[] = '<li' . $active . '><a href="' . htmlspecialchars(sprintf($link, $x), ENT_QUOTES) . '">' . $x . '</a></li>';
		}

		if ($page_count > 1) {
			return '<ul class="pagination">' . $previous_page . $first_page . implode('', $pages) . $last_page . $next_page . '</ul>';
		}

		return null; // Return null if no pages to display
	}
}