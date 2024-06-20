<?php
namespace JW3B\erday;
use JW3B\erday\Helpful;

class Helpful_HTML extends Helpful {

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