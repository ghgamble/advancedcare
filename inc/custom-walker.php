<?php
class AdvancedCare_Walker_Nav_Menu extends Walker_Nav_Menu {

    // Start Level
    function start_lvl( &$output, $depth = 0, $args = null ) {
        $output .= '<ul class="sub-menu" role="menu">';
    }

    // Start Element
    function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $classes = !empty( $item->classes ) && is_array( $item->classes ) ? implode( ' ', $item->classes ) : '';
        $has_children = in_array( 'menu-item-has-children', (array) $item->classes, true );
        
        // Begin <li>
        $output .= '<li class="' . esc_attr( $classes ) . '"';

        // Add ARIA for items with submenus
        if ( $has_children && $depth === 0 ) {
            $output .= ' aria-haspopup="true" aria-expanded="false"';
        }

        $output .= '>';

        // Begin <a>
        $output .= '<a href="' . esc_url( $item->url ) . '" role="menuitem" aria-label="' . esc_attr( $item->title ) . '"';

        // Add aria-expanded if dropdown exists (for JS toggle)
        if ( $has_children && $depth === 0 ) {
            $output .= ' aria-expanded="false"';
        }

        $output .= '>';

        // Add dropdown arrow inline SVG if parent item
        if ( $has_children && $depth === 0 ) {
            $output .= '<span class="dropdown-arrow" aria-hidden="true">
                <svg width="12" height="8" viewBox="0 0 12 8" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 1L6 6L11 1" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"/>
                </svg>
            </span>';
        }

        // Add the title text
        $output .= esc_html( $item->title );
        $output .= '</a>';
    }

    // End Element
    function end_el( &$output, $item, $depth = 0, $args = null ) {
        $output .= "</li>\n";
    }

    // End Level
    function end_lvl( &$output, $depth = 0, $args = null ) {
        $output .= "</ul>\n";
    }
}
?>
