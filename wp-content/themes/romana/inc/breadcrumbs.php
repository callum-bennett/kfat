<?php // Breadcrumbs
function romana_custom_breadcrumbs() {
    // Settings
    $romana_separator          = ' / ';
    $romana_breadcrums_id      = esc_attr('breadcrumbs');
    $romana_home_title         = esc_html__('Home','romana');
    // If you have any custom post types with custom taxonomies, put the taxonomy name below (e.g. product_cat)
    $romana_custom_taxonomy    = 'product_cat';
    // Get the query & post information
    global $post,$wp_query;
    // Do not display on the homepage
    if ( !is_front_page() ) {
        // Build the breadcrums
        echo '<div class="breadcrumb">';
        // Home page
        echo '<a class="bread-link bread-home" href="' . esc_url(home_url()) . '" title="' . esc_attr($romana_home_title) . '">' . esc_html($romana_home_title) . '</a>';
        echo ' '.$romana_separator.' ';
        if ( is_archive() && !is_tax() && !is_category() && !is_tag() ) {
            echo '<span class="bread-current bread-archive">' . esc_html__('Archive','romana') . '</span>';
        } else if ( is_archive() && is_tax() && !is_category() && !is_tag() ) {
            // If post is a custom post type
            $romana_post_type = get_romana_post_type();
            // If it is a custom post type display name and link
            if($romana_post_type != 'post') {
                $romana_post_type_object = get_romana_post_type_object($romana_post_type);
                $romana_post_type_archive = get_romana_post_type_archive_link($romana_post_type);
                echo '<a class="bread-cat bread-custom-post-type-' . $romana_post_type . '" href="' . esc_url($romana_post_type_archive) . '" title="' . $romana_post_type_object->labels->name . '">' . $romana_post_type_object->labels->name . '</a>';
                echo ' '.$romana_separator;
            }
            $romana_custom_tax_name = get_queried_object()->name;
            echo '<span class="bread-current bread-archive">' . $romana_custom_tax_name . '</span>';
        } else if ( is_single() ) {
            // If post is a custom post type
            $romana_post_type = get_post_type();
            // If it is a custom post type display name and link
            if($romana_post_type != 'post' && $romana_post_type != 'attachment') {
                $romana_post_type_object = get_romana_post_type_object($romana_post_type);
                $romana_post_type_archive = get_romana_post_type_archive_link($romana_post_type);
                echo '<a class="bread-cat bread-custom-post-type-' . $romana_post_type . '" href="' . esc_url($romana_post_type_archive) . '" title="' . $romana_post_type_object->labels->name . '">' . $romana_post_type_object->labels->name . '</a>';
                echo $romana_separator;
            }
            // Get post category info
            $romana_category = get_the_category();
            if(!empty($romana_category)) {
                // Get last category post is in
                $romana_last_category = end($romana_category);
                // Get parent any categories and create array
                $romana_get_cat_parents = rtrim(get_category_parents($romana_last_category->term_id, true, ','),',');
                $romana_cat_parents = explode(',',$romana_get_cat_parents);
                // Loop through parent categories and store in variable $cat_display
                $cat_display = '';
                foreach($romana_cat_parents as $parents) {
                    $cat_display .= $parents;
                    $cat_display .= $romana_separator;
                }
            }
            // If it's a custom post type within a custom taxonomy
            $taxonomy_exists = taxonomy_exists($romana_custom_taxonomy);
            if(empty($romana_last_category) && !empty($romana_custom_taxonomy) && $taxonomy_exists) {
                $taxonomy_terms = get_the_terms( $post->ID, $romana_custom_taxonomy );
                $cat_id         = $taxonomy_terms[0]->term_id;
                $cat_nicename   = $taxonomy_terms[0]->slug;
                $cat_link       = get_term_link($taxonomy_terms[0]->term_id, $romana_custom_taxonomy);
                $cat_name       = $taxonomy_terms[0]->name;
            }
            // Check if the post is in a category
            if(!empty($romana_last_category)) {
                echo $cat_display;
                echo '<span class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</span>';
            // Else if post is in a custom taxonomy
            } else if(!empty($cat_id)) {
                echo '<a class="bread-cat bread-cat-' . $cat_id . ' bread-cat-' . $cat_nicename . '" href="' . esc_url($cat_link) . '" title="' . $cat_name . '">' . $cat_name . '</a></li>';
                echo $romana_separator;
                echo '<span class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</span>';
            } else {
                echo '<span class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</span>';
            }
        } else if ( is_category() ) {
            // Category page
            echo '<li class="item-current item-cat"><span class="bread-current bread-cat">' . single_cat_title('', false) . '</span></li>';
        } else if ( is_page() ) {
            // Standard page
            if( $post->post_parent ){
                // If child page, get parents 
                $anc = get_post_ancestors( $post->ID );
                // Get parents in the right order
                $anc = array_reverse($anc);
                $parents = '';   
                // Parent page loop
                foreach ( $anc as $ancestor ) {
                    $parents .= '<a class="bread-parent bread-parent-' . $ancestor . '" href="' . get_permalink($ancestor) . '" title="' . get_the_title($ancestor) . '">' . get_the_title($ancestor) . '</a>';
                    $parents .= $romana_separator;
                }
                // Display parent pages
                echo $parents;
                // Current page
                echo '<span title="' . get_the_title() . '"> ' . get_the_title() . '</span>';
            } else {
                // Just display current page if not parents
                echo '<span class="bread-current bread-' . $post->ID . '"> ' . get_the_title() . '</span>';
            }
        } else if ( is_tag() ) {
            // Tag page
            // Get tag information
            $term_id        = get_query_var('tag_id');
            $taxonomy       = 'post_tag';
            $args           = 'include=' . $term_id;
            $terms          = get_terms( $taxonomy, $args );
            $get_term_id    = $terms[0]->term_id;
            $get_term_slug  = $terms[0]->slug;
            $get_term_name  = $terms[0]->name;
            // Display the tag name
            echo '<span class="bread-current bread-tag-' . $get_term_id . ' bread-tag-' . $get_term_slug . '">' . $get_term_name . '</span>';
        } elseif ( is_day() ) {
            // Day archive
            // Year link
            echo '<a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . esc_html__('Archives','romana').'</a>';
            echo $romana_separator;
            // Month link
            echo '<a class="bread-month bread-month-' . get_the_time('m') . '" href="' . get_month_link( get_the_time('Y'), get_the_time('m') ) . '" title="' . get_the_time('M') . '">' . get_the_time('M') . esc_html__('Archives','romana').'</a>';
            echo $romana_separator;
            // Day display
            echo '<span class="bread-current bread-' . get_the_time('j') . '"> ' . get_the_time('jS') . ' ' . get_the_time('M') . esc_html__('Archives','romana').'</span>';
        } else if ( is_month() ) {
            // Month Archive
            // Year link
            echo '<a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . esc_html__('Archives','romana').'</a>';
            echo $romana_separator;
            // Month display
            echo '<span class="bread-month bread-month-' . get_the_time('m') . '" title="' . get_the_time('M') . '">' . get_the_time('M') . esc_html__('Archives','romana').'</span>';
        } else if ( is_year() ) {
            // Display year archive
            echo '<span class="bread-current bread-current-' . get_the_time('Y') . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . esc_html__('Archives','romana').'</span>';
        } else if ( is_author() ) {
            // Auhor archive
            // Get the author information
            global $author;
            $userdata = get_userdata( $author );
            // Display author name
            echo '<span class="bread-current bread-current-' . $userdata->user_nicename . '" title="' . $userdata->display_name . '">' . esc_html__('Author: ','romana') . $userdata->display_name . '</span>';
        } else if ( get_query_var('paged') ) {
            // Paginated archives
            echo '<span class="bread-current bread-current-' . get_query_var('paged') . '" title="'.esc_attr__('Page ','romana'). get_query_var('paged') . '">'.esc_html__('Page','romana') . ' ' . get_query_var('paged') . '</span>';
        } else if ( is_search() ) {
            // Search results page
            echo '<span class="bread-current bread-current-' . get_search_query() . '" title="'.esc_attr__('Search results for: ','romana') . get_search_query() . '">'. esc_html__('Search results for: ','romana') . get_search_query() . '</span>';
        } elseif ( is_404() ) {
            // 404 page
            esc_html_e('Error 404','romana');
        }
        echo '</div>';
    }
}