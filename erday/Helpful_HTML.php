<?php
namespace JW3B\erday;
use JW3B\erday\Helpful;

class Helpful_HTML extends Helpful {

	public static function svg_img($width='100', $height='100', $text=''){
		return '<svg width="'.$width.'" height="'.$height.'">
			<rect x="0" y="0" width="'.$width.'" height="'.$height.'" fill="white"/>
			<text x="50%" y="50%" dominant-baseline="middle" text-anchor="middle" stroke="black" stroke-width="1px" fill="currentColor">'.$text.'</text>
		</svg>';
	}

	public static function breadcrumb($pgs, $right=false, $add_class=''){
		echo '<ol class="breadcrumb'.$add_class.'">';
		if(is_array($pgs)){
			foreach($pgs as $k => $v){
				if(is_array($v)){
					echo '<li class="active">'.$v[0].'</li>';
				} else {
					echo '<li><a href="'.$k.'">'.$v.'</a></li>';
				}
			}
		}
		if(is_array($right)){
			foreach($right as $k => $v){
				if(is_array($v)){
					echo '<li class="pull-right active">'.$v[0].'</li>';
				} else {
					echo '<li class="pull-right"><a href="'.$k.'">'.$v.'</a></li>';
				}
			}
		}
		echo '</ol>';
	}

	public function setUpLinks($tags, $b4Link, $afterLink='/', $sep=','){
		$tt = explode($sep, $tags);
		$tags = '';
		foreach($tt as $k2){
			if($k2 != ''){
				$rp = $this->removePound($k2);
				$tags .= '<a href="'.$b4Link.$this->clean_url($rp).$afterLink.'">'.$rp.'</a>, ';
			}
		}
		$tags = substr($tags, 0, -2);
		return $tags;
	}

	// ['tags' => 10, 'like' => 5]
	public function tagCloud($tags, $b4Link, $afterLink='/'){
		if(is_array($tags)){
			$t = 0;
			arsort($tags); // hightest value first, DESC
			foreach($tags as $k => $v){
				$Rtags[$k] = $v;
				$t++;
				if($t == 100) break;
			}
			$c = count($Rtags);
			ksort($Rtags); // abc order
			$max_size = 250; // max font size in %
			$min_size = 80; // min font size in %
			$max_qty = max(array_values($Rtags));
			$min_qty = min(array_values($Rtags));
			$spread = $max_qty - $min_qty;
			if (0 == $spread) { // we don't want to divide by zero
				$spread = 1;
			}
			$step = ($max_size - $min_size)/($spread);
			$ret = '';
			foreach($Rtags as $k => $v){
				$size = $min_size + (($v - $min_qty) * $step);
				$rp = $this->removePound($k);
				$ret .= '<a href="'.$b4Link.Helpful::clean_url($rp).$afterLink.'" class="load-page" title="'.$rp.' tagged '.$v.' times" rel="tag" style="font-size: '.$size.'%">'.$rp.'</a> ';
			}
		} else { $ret = 'No Tags Found'; }
		return $ret;
	}

	public static function browse($pageNum, $totalPerPage, $howMany, $b4page, $afterPage="", $hideLast='', $extra=array()){
		$divClass = (isset($extra['divClass'])) ? ' '.$extra['divClass'] : ' justify-content-center';
		$b4 = (isset($extra['b4'])) ? $extra['b4'] : '';
		$afterPg = isset($extra['after']) ? $extra['after'] : '';
		$ret = '<nav aria-label="Paging Current Section">'.$b4.'
			<ul class="pagination'.$divClass.'">';
		$maxPage = ceil($howMany/$totalPerPage);
		// first page
		if ($pageNum == 1) {
			$ret .= '<li class="page-item disabled"><a class="page-link">'.l('Prev').'</a></li>
			<li class="page-item active"><a class="page-link">1</a></li>';
		} else {
			$prev = $pageNum-1;
			$ret .= '<li class="page-item"><a class="page-link" href="'.$b4page.$prev.$afterPage.'">'.l('Prev').'</a></li>
			<li class="page-item"><a class="page-link" a href="'.$b4page.'1'.$afterPage.'" title="'.l('Go To Page').' 1">1</a></li>';
		}

		for($x=$pageNum-3; $x<$pageNum+3; $x++){
			if ($x > 1 && $x < $maxPage){
				if ($x == $pageNum) {
					$ret .= '<li class="page-item active"><a class="page-link">'.$x.'</a></li>';
				} else {
					$ret .= '<li class="page-item"><a class="page-link" href="'.$b4page.$x.$afterPage.'" title="'.l('Go To Page').' '.$x.'">'.$x.'</a></li>';
				}
			}
		}
		//lets hide the last page if the last page is the first page :)
		if($maxPage != 0 && $hideLast == ''){
			if($maxPage != 1){
				// last page
				if($pageNum == $maxPage){
					$ret .= '<li class="page-item active"><a class="page-link">'.$maxPage.'</a></li>
					<li class="page-item disabled"><a class="page-link">'.l('Next').'</a></li>';
				} else {
					$next = $pageNum+1;
					$ret .= '<li class="page-item"><a class="page-link" href="'.$b4page.$maxPage.$afterPage.'" title="'.l('Go To Page').' '.$maxPage.'">'.$maxPage.'</a></li>
					<li class="page-item"><a class="page-link" href="'.$b4page.$next.$afterPage.'">'.l('Next').'</a></li>';
				}
			} else {
				$ret .= '<li class="disabled page-item disabled"><a class="page-link">'.l('Next').'</a></li>';
			}
		} else {
			$ret .= '<li class="disabled page-item"><a class="page-link">'.l('Next').'</a></li>';
		}
		$ret .= '</ul>'.$afterPg.'</nav>';
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
	public function pagination($item_count, $limit, $cur_page, $link){
		$page_count = ceil($item_count/$limit);
		$current_range = array(($cur_page-2 < 1 ? 1 : $cur_page-2), ($cur_page+2 > $page_count ? $page_count : $cur_page+2));
		// First and Last pages
		$first_page = $cur_page > 3 ? '<li><a href="'.sprintf($link, '1').'">1</a></li>'.($cur_page < 5 ? '' : '<li class="disabled"><a href="#">...</a></li>') : null;
		$last_page = $cur_page < $page_count-2 ? ($cur_page > $page_count-4 ? '' : '<li class="disabled"><a href="#">...</a></li>').'<li><a href="'.sprintf($link, $page_count).'">'.$page_count.'</a></li>' : null;
		// Previous and next page
		$previous_page = $cur_page > 1 ? '<li><a href="'.sprintf($link, ($cur_page-1)).'">&laquo;</a></li>' : null;
		$next_page = $cur_page < $page_count ? '<li><a href="'.sprintf($link, ($cur_page+1)).'">&raquo;</a></li>' : null;
		// Display pages that are in range
		for($x=$current_range[0];$x <= $current_range[1]; ++$x){
			$active = $x == $cur_page ? ' class="active"' : '';
			$pages[] = '<li'.$active.'><a href="'.sprintf($link, $x).'">'.$x.'</a></li>';
		}
		if($page_count > 1)
			return '<ul class="pagination">'.$previous_page.$first_page.implode('', $pages).$last_page.$next_page.'</ul>';
	}
}