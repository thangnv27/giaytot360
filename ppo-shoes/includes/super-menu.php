<?php 
/**
 * observer super menu
**/ 
?>
<?php
class ob_super_menu extends Walker_Nav_Menu {
	function start_lvl(&$output, $depth = 0, $args = array()) {
		$output .= "\n<ol id=\"megamenu-category\">\n";
	}
	function end_lvl(&$output, $depth = 0, $args = array()) {
		$output .= "</ol>\n";
	}
	function start_el(&$output, $item, $depth = 0, $args = array(), $current_object_id = 0) {
		global $wp_query;
		$cat = $item->object_id;
		$indent = ($depth) ? str_repeat ( "\t", $depth ) : '';
		$class_names = $value = '';
		$classes = empty ( $item->classes ) ? array () : ( array ) $item->classes;
		$class_names = join ( ' ', apply_filters ( 'nav_menu_css_class', array_filter ( $classes ), $item ) );
		$class_names = ' class="' . esc_attr ( $class_names ) . '"';
		$output .= $indent . '<li class="p-menu" data-id="'.$cat.'" rel="' . $item->object_id . '" id="menu-item-' . $item->ID . '"' . $value . $class_names . '>';		
		$attributes = ! empty ( $item->attr_title ) ? ' title="' . esc_attr ( $item->attr_title ) . '"' : '';
		$attributes .= ! empty ( $item->target ) ? ' target="' . esc_attr ( $item->target ) . '"' : '';
		$attributes .= ! empty ( $item->xfn ) ? ' rel="' . esc_attr ( $item->xfn ) . '"' : '';
		$attributes .= ! empty ( $item->url ) ? ' href="' . esc_attr ( $item->url ) . '"' : '';
		$item_output = $args->before;
		$item_output .= '<a' . $attributes . ' title="'.$item->title.'" class="m_sumen"><span class="t_sume">';
		$item_output .= $args->link_before . apply_filters ( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</span></a>';	
		$item_output .= $args->after;	
		$children = get_posts ( array (
				'post_type' => 'nav_menu_item',
				'nopaging' => true,
				'numberposts' => 1,
				'meta_key' => '_menu_item_menu_item_parent',
				'meta_value' => $item->ID 
		) );		
		if (wp_is_mobile() == false && $depth == 0 && $item->object == 'category' && ! empty ( $children )) {
		} elseif ($item->object != 'category' && ! empty ( $children )) {
			$item_output .= '<div class="submenu-megamenu" style="display: none;"><div id="'.$item->ID.'" class=" wrap-megamenu" style="width:446px">';
		} elseif ($depth == 0 && $item->object == 'category' && empty ( $children )) {
		}	
		if ($depth == 0 && empty ( $children ) && $item->object == 'category') {
		} elseif ($depth <= 1 && $item->object == 'category') {		
			$cat = $item->object_id;				
		} 
		elseif ($depth == 0 && $item->object == 'page') {
		}		
		$output .= apply_filters ( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
	function end_el(&$output, $item, $depth = 0, $args = array(), $current_object_id = 0) {
	}
}

