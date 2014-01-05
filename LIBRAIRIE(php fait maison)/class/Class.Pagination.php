<?php

class Pagination{
	
	
	
	public static function getPagination($nb_res, $page, $class_ul, $pagination_url) {
	
		$nbparpage = ($_SESSION['nbparpage'] == '' )?$GLOBALS['_data_']['nbparpage']:$_SESSION['nbparpage'];
		
	if($nb_res > 0){	
		
		
		
		$nb_pages = ceil($nb_res / $nbparpage); 
		if ($page > $nb_pages) {
			$page = $nb_pages;
		}
		
		if( $nb_pages > 1 ){
		
		// 1
		// 1 | 2
		// 1 | ... | 2 | ... | 3
		// min | ... | (current-1) | current | (current+1) | ... | max
		// (current-1) == min & (current+1) == max => min | ... | current | ... | max
		// (current-1) == min => min | ... | current | (current+1) | ... | max
		// (current+1) == max => min | ... | (current-1) | current | ... | max
		$pagination = '<span class="page_intitule">Page</span>';
 		
		if ($nb_pages == 2) {
			// 1 | 2
			if ($page == 1) {
				//$pagination .= '<span class="fleche_precedent"><img src="css/images/fleche_precedent_off.gif" alt="" /></span>';
				$pagination .= '<span class="page_on">1</span>';
				$pagination .= '<a href="'.$pagination_url.'&p=2" class="page">2</a>';
				$pagination .= '<span class="fleche_suivante"><a href="'.$pagination_url.'&p=2"><img src="css/images/fleche_suivant.gif" alt="" /></a></span>';	
			}
			else {
				$pagination .= '<a href="'.$pagination_url.'&p=1" class="page">1</a>';
				$pagination .= '<span class="page_on">2</span>';
				$pagination .= '<span class="fleche_suivant">&nbsp;<img src="css/images/fleche_suivant_off.gif" alt="" /></span>';
				//$pagination .= '<li class="precedent"><a href="'.$pagination_url.'&p=1"></a></span>';
				
			}
		}
		else {
			
			if ($page > 1) {
				$pagination .= '<span class="fleche_precedente"><a href="'.$pagination_url.'&p='.($page - 1).'"><img src="css/images/fleche_precedent.gif" alt="" /></a></span>';
			}
						
			//$pagination .= '&nbsp;';
			if ($page == 1) {
				// 1 | 2 | ... | nb_pages
				$pagination .= '<span class="page_on" >1</span>';
				$pagination .= '<a href="'.$pagination_url.'&p=2" class="page">2</a></span>';
				$pagination .= '<span>&hellip;</span>';
				$pagination .= '<a href="'.$pagination_url.'&p='.$nb_pages.'" class="page">'.$nb_pages.'</a></span>';	
								
			}
			elseif ($page == $nb_pages) {
				// 1 | ... | (nb_pages-1) | nb_pages
				$pagination .= '<a href="'.$pagination_url.'&p=1" class="page">1</a>';
				//$pagination .= '<span class="fleche_precedente_off"><img src="css/images/fleche_precedent_off.gif" alt="" /></span>';
				$pagination .= '<span>&hellip;</span>';
				$pagination .= '<a href="'.$pagination_url.'&p='.($nb_pages-1).'" class="page">'.($nb_pages-1).'</a>';	
				$pagination .= '<span class="page_on"><strong>'.$nb_pages.'</strong></span>';	
				
			}
			elseif (($page - 1 == 1) && ($page + 1 == $nb_pages)) {
				// 1 | ... | page | ... | nb_pages
								
				$pagination .= '<a href="'.$pagination_url.'&p=1" class="page">1</a></span>';
				$pagination .= '<span>&hellip;</span>';
				$pagination .= '<span class="page_on" >'.$page.'</span>';
				$pagination .= '<span>&hellip;</span>';
				$pagination .= '<a href="'.$pagination_url.'&p='.($page+1).'" class="page">'.($page+1).'</a></span>';
			}
			elseif ($page - 1 == 1) {
				// 1 | ... | page | (page+1) | ... | nb_pages
				$pagination .= '<a href="'.$pagination_url.'&p=1" class="page">1</a>';
				$pagination .= '<span>&hellip;</span>';
				$pagination .= '<span class="page_on">'.$page.'</span>';
				$pagination .= '<a href="'.$pagination_url.'&p='.($page+1).'" class="page">'.($page+1).'</a>';
				$pagination .= '<span>&hellip;</span>';
				$pagination .= '<a href="'.$pagination_url.'&p='.$nb_pages.'" class="page">'.$nb_pages.'</a>';	
								
			}
			elseif ($page + 1 == $nb_pages) {
				// 1 | ... | (page-1) | page | ... | nb_pages
				$pagination .= '<a href="'.$pagination_url.'&p=1" class="page">1</a>';
				$pagination .= '<span>&hellip;</span>';
				$pagination .= '<a href="'.$pagination_url.'&p='.($page-1).'" class="page">'.($page-1).'</a>';
				$pagination .= '<span class="page_on">'.$page.'</span>';
				$pagination .= '<span>&hellip;</span>';
				$pagination .= '<a href="'.$pagination_url.'&p='.$nb_pages.'" class="page">'.$nb_pages.'</a>';	
								
			}
			else {
				// 1 | ... | (page-1) | page | (page+1) | ... | nb_pages
				$pagination .= '<a href="'.$pagination_url.'&p=1" class="page">1</a>';
				$pagination .= '<span>&hellip;</span>';
				$pagination .= '<a href="'.$pagination_url.'&p='.($page-1).'" class="page">'.($page-1).'</a>';
				$pagination .= '<span class="page_on">'.$page.'</span>';
				$pagination .= '<a href="'.$pagination_url.'&p='.($page+1).'" class="page">'.($page+1).'</a>';
				$pagination .= '<span>&hellip;</span>';
				$pagination .= '<a href="'.$pagination_url.'&p='.$nb_pages.'" class="page">'.$nb_pages.'</a>';	
								
				
			}
			//$pagination .= '&nbsp;</span>';
			if ($page < $nb_pages) {
				$pagination .= '&nbsp;<span class="suivant"><a href="'.$pagination_url.'&p='.($page + 1). '"><img src="css/images/fleche_suivant.gif" alt="" /></a></span>';
			}
			
			
		}
		
		}
		else{
			$pagination = '';
		}
	}
	return $pagination;
}
}
 
?>