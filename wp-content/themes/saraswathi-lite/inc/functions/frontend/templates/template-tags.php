<?php
/**
 *
 * Custom template tags for this theme.
 *
 * Mainly functions that output some kind of HTML.
 *
 * Located in local directory '/wp-content/themes/saraswathi/inc/functions/frontend/templates/'
 *
 * @since Saraswathi Lite 1.0.0
 *
 * @package Saraswathi Lite







 ***********************************
 *	Table of Contents
 *
 *	1.0 - Navigation
 *	2.0 - Header
 *	3.0 - Single
 *			3.1	-	Entry Header
 *			3.2	-	Entry Content
 *			3.3	- Entry Footer
 *	4.0	-	Archive
 *			4.1	-	Archive Header
 *			4.2	-	Summary Media
 *					4.2.1	-	Image
 *					4.2.2	-	Video Format
 *					4.2.3	-	Gallery Format
 *					4.2.4   -   Link Format
 *					4.2.5	-	Quote Format
 *			4.3	-	Summary Header
 *			4.4 -   Summary Meta
 *			4.5	- Summary Footer
 *			4.6	-	Summary Content
 *  5.0 - Widget Areas
 *	6.0	-	Footer
 *	7.0	-	Schema
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}



/**
*	1.0 - Navigation
*/



if ( ! function_exists( 'saraswathi_paging_nav' ) ) :
	/**
	 * Display navigation to next/previous set of posts when applicable.
	 */
	function saraswathi_paging_nav() {
		global $wp_query, $wp_rewrite;
		// Don't print empty markup if there's only one page.
		if ( $wp_query->max_num_pages < 2 && ! is_archive() ) {
			return;
		}

		$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
		$pagenum_link = get_pagenum_link();
		$query_args   = array();
		$url_parts    = explode( '?',$pagenum_link );

		/**
	 * Filter the list of post types for showing paging navigation.
	 *
	 * @since 1.0.0
	 *
	 * @param array  $type An array of post types.
	 */
		$posttypes 		= apply_filters( 'saraswathi_paging_nav_posttypes',array( 'post', 'saras-portfolio' ) );
		if ( ! in_array( get_post_type(), $posttypes ) ) {
			return;
		}
		if ( isset( $url_parts[1] ) ) {
			wp_parse_str( $url_parts[1], $query_args );
		}

		$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
		$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

		$format  = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
		$format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%','paged' ) : '?paged=%#%';

		$args = array(
			'mid_size' => 1,
			'prev_text' => __( '<span class="meta-nav"></span>','saraswathi-lite' ),
			'next_text' => __( '<span class="meta-nav"></span>','saraswathi-lite' ),
			);
		the_posts_pagination( $args );

	}
	add_action( 'saraswathi_after_entry_content','saraswathi_paging_nav' );
endif;

if ( ! function_exists( 'saraswathi_post_nav' ) ) :
	/**
	 * Display navigation to next/previous post when applicable.
	 */
	function saraswathi_post_nav() {
		// Don't print empty markup if there's nowhere to navigate.
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '',true );
		$next     = get_adjacent_post( false, '',false );

		if ( ! $next && ! $previous || is_archive() ) {
			return;
		}

		/**
	 * Filter the list of post types for showing post navigation.
	 *
	 * @since 1.0.0
	 *
	 * @param array  $type An array of post types.
	 */
		$posttypes = apply_filters( 'saraswathi_post_nav_posttypes',array( 'product', 'saras-portfolio' ) );
		$prevthumb = $nextthumb = $prevauthor = $nextauthor = '';
		if ( $previous &&  has_post_thumbnail( $previous->ID ) ) {

			$prevthumb 		= get_the_post_thumbnail( $previous->ID, 'thumbnail' );

		} elseif ( $previous && 'image' === get_post_format() || 'gallery' === get_post_format() ) {

			$args = array( 'post_type' => 'attachment','numberposts' => 1,'post_status' => null,'post_parent' => $previous->ID );

			$attachments = get_posts( $args );

			if ( ! empty($attachments) ) {

				$prevthumb 		= wp_get_attachment_image( $attachments[0]->ID, 'thumbnail' );
			}
		}
		if ( $next && has_post_thumbnail( $next->ID ) ) {

			$nextthumb 		= get_the_post_thumbnail( $next->ID, 'thumbnail' );

		} elseif ( $next && 'image' === get_post_format() || 'gallery' === get_post_format() ) {

			$args = array( 'post_type' => 'attachment','numberposts' => 1,'post_status' => null,'post_parent' => $next->ID );

			$attachments = get_posts( $args );

			if ( ! empty($attachments) ) {

				$nextthumb 		= wp_get_attachment_image( $attachments[0]->ID, 'thumbnail' );
			}
		}

		if ( $previous ) {

			$prevauthor		= sprintf( __( '<small class="block">by %1$s</small>','saraswathi-lite' ),
				get_the_author_meta( 'display_name', get_post_field( 'post_author', $previous->ID ) )
			);
		}
		if ( $next ) {

			$nextauthor		= sprintf( __( '<small class="block">by %1$s</small>','saraswathi-lite' ),
				get_the_author_meta( 'display_name', get_post_field( 'post_author', $next->ID ) )
			);
		}

		$prevback	= sprintf( __( '<h6 class="title">%1$s%3$s</h6>%2$s','saraswathi-lite' ),
			_x( '%title','Previous post link','saraswathi-lite' ),
			$prevthumb,
			$prevauthor
		);

		$nextback	= sprintf( __( '<h6 class="title">%1$s%3$s</h6>%2$s','saraswathi-lite' ),
			_x( '%title','Next post link','saraswathi-lite' ),
			$nextthumb,
			$nextauthor
		);

		$obj = get_post_type_object( get_post_type() );

		$archivelink	= '<div class="archive-link"><a href="'.get_post_type_archive_link( get_post_type() ).'" title="Visit '.$obj->labels->singular_name.' archive"></a></div>';

		$prev = '<span class="meta-nav front" title="%title"></span><div class="back">'.$prevback.'</div>';
		$next = '<span class="meta-nav front" title="%title"></span><div class="back">'.$nextback.'</div>';

		if ( function_exists( 'get_the_post_navigation' ) && 'post' === get_post_type() && is_single() ) {

			$args = array(
				'prev_text' => $prev,
				'next_text' => $next,
				'screen_reader_text' => __( 'Post navigation','saraswathi-lite' ),
			);

			echo get_the_post_navigation( $args );

		} elseif ( is_singular( $posttypes ) ) {
?>
<nav class="navigation post-navigation" role="navigation">
	<h2 class="screen-reader-text"><?php __( 'Post navigation','saraswathi-lite' ); ?></h2>
	<div class="nav-links">
		<?php
			previous_post_link( '<div class="nav-previous">%link</div>', $prev );
			echo $archivelink;
			next_post_link( '<div class="nav-next text-right">%link</div>', $next );
		?>
	</div><!-- .nav-links -->
</nav><!-- .navigation -->
<?php	}
	}
	add_action( 'saraswathi_after_entry_content','saraswathi_post_nav' );
endif;

if ( ! function_exists( 'saraswathi_comment_nav' ) ) :
	/**
	 * Display navigation to next/previous comments when applicable.
	 *
	 * @since Saraswathi Lite 1.0.0
	 */
	function saraswathi_comment_nav() {
		// Are there comments to navigate through?
		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
		?>
		<nav class="navigation saras-navport comment-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php _e( 'Comment navigation','saraswathi-lite' ); ?></h2>
		<div class="nav-links">
            
			<?php
			if ( $prev_link = get_previous_comments_link( __( 'Older Comments','saraswathi-lite' ) ) ) :
				printf( '<div class="nav-previous" title="Older Comments"><div class="front"><span class="meta-nav" title="Older Comments"></span></div><div class="back">%s</div></div>',$prev_link );
				endif;

			if ( $next_link = get_next_comments_link( __( 'Newer Comments','saraswathi-lite' ) ) ) :
				printf( '<div class="nav-next" title="Newer comments"><div class="front"><span class="meta-nav" title="Newer Comments"></span></div><div class="back">%s</div></div>',$next_link );
				endif;
			?>
			</div><!-- .nav-links -->
		</nav><!-- .comment-navigation -->
		<?php
		endif;
	}
endif;




/**
*	2.0 - Header
*/


/**
* Creates the pingback URL.
*
* @since Saraswathi Lite 1.0.0
*
* @echo pingback.
*/

function saraswati_pingback_header() {
  if ( is_singular() && pings_open() ) {
    echo '<link rel="pingback" href="', bloginfo( 'pingback_url' ), '">';
  }
}
add_action( 'wp_head', 'saraswati_pingback_header' );


if ( ! function_exists( 'saraswathi_header' ) ) :
	/**
	 * Creates the header.
	 *
	 * @since Saraswathi Lite 1.0.0
	 *
	 * @echo header.
	 */
	function saraswathi_header() {
		
		if ( 'grid' === saraswathi_get_theme_mod( 'saras_saraswathi_site_layout', 'grid' ) ) {
			$classes   = 'saras-grid none max width';
		} else { 
			$classes = 'none'; 
		}
?>
<header id="masthead" <?php saraswathi_topbar_class( array( 'site-header', 'saras-header' ) ); ?> role="banner" itemscope itemtype="http://schema.org/WPHeader">
<div <?php  saraswathi_topbar_class( array( 'saras-topbar' ) ); ?>>
	<div <?php saraswathi_topbar_class( array( 'saras-topbar-container', 'none') ); ?>>
		<?php saraswathi_title_area(); ?>						
				<div <?php saraswathi_topbar_class( array( 'top-bar-section', $classes) ); ?> >		
					<nav id="site-navigation" class="saras-nav" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">	
						<?php do_action( 'saraswathi_header_main_menu' ); ?>							
					</nav>	<!-- #site-navigation -->
					<?php
					// Add menu toggle and search toggle to widget area .
					saraswathi_header_buttons();
					?>
				</div>
		<div id="#search-container"  class="saras-search">
			<?php	get_search_form( true );	?>
		</div>
		<div class="header-content">
			<?php	do_action( 'saraswathi_header_content' );	?>
		</div>
			</div><!-- .saras-topbar-container -->
		</div><!-- .saras-topbar -->
</header><!-- #masthead -->
<?php
	}
endif;




if ( ! function_exists( 'saraswathi_header_main_menu' ) ) :
	/**
	 * Creates the main menu navigation for theme.
	 *
	 * @since Saraswathi Lite 1.0.0
	 *
	 * @echo menu.
	 */
	function saraswathi_header_main_menu() {

			saraswathi_main_menu();
	}
	add_action( 'saraswathi_header_main_menu','saraswathi_header_main_menu' );
endif;



if ( ! function_exists( 'saraswathi_skip_to_content' ) ) :
	/**
	 * Creates the accessbility link.
	 *
	 * @since Saraswathi Lite 1.0.0
	 *
	 * @echo skip to content hyperlinks.
	 */
	function saraswathi_skip_to_content () {
		echo '<a class="skip-link screen-reader-text" href="#content">';
			_e( 'Skip to content', 'saraswathi-lite' );
			echo '</a>';
	}
	add_action( 'saraswathi_before_header','saraswathi_skip_to_content' );
endif;

if ( ! function_exists( 'saraswathi_overlay' ) ) :
	/**
	 * Creates the neccessary container for overaly.
	 *
	 * @since Saraswathi Lite 1.0.0
	 *
	 * @echo overlay container.
	 */
	function saraswathi_overlay() {
		?>

<div class="saras-overlay"></div>
<?php
	}
	add_action( 'saraswathi_before_content_after_header','saraswathi_overlay' );
endif;

if ( ! function_exists( 'saraswathi_title_area' ) ) :
 /**
	 * Creates the header icons.
	 *
	 * @since Saraswathi Lite 1.0.0
	 *
	 * @echo header buttons as hyperlinks.
	 */
	function saraswathi_title_area() {

		?>
<div class="title-area center">
		<div class="site-branding">
		<?php if ( has_custom_logo() ) { the_custom_logo(); } else { ?>
		<?php //the_custom_logo(); ?>
		<?php $description = get_bloginfo( 'description', 'display' ); ?>
		<div class="site-branding-text">
		<h1 class="site-title" itemprop="headline"><a class="brands logo" title="<?php
		if ( $description || is_customize_preview() ) {
		echo $description; 
		}
		?>" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
		</div><!-- .site-branding-text -->
		<?php }  ?>
</div><!-- .site-branding -->
</div><!-- .title-area -->

<?php
	}
endif;



if ( ! function_exists( 'saraswathi_header_buttons' ) ) :
	/**
	 * Creates the header icons.
	 *
	 * @since Saraswathi Lite 1.0.0
	 *
	 * @echo header buttons as hyperlinks.
	 */
	function saraswathi_header_buttons() {
	?>
	<div class="saras-header-buttons">  
							<?php if ( saraswathi_get_theme_mod( 'saras_saraswathi_enable_topbar_search',1 ) ) : ?>	
							<div class="saras-search-toggle">
								
								<button type="button" class="saras-close-toggle ally">
									<span class="saras-icon-close icon"></span>
									<span class="screen-reader-text">
										<?php _e( 'Close Search','saraswathi-lite' ); ?>
									</span>
								</button>		
								<button type="button" class="ally">
									<span class="saras-icon-search icon"></span>
									<span class="screen-reader-text">
										<?php _e( 'Open Search','saraswathi-lite' ); ?>
									</span>
								</button>	
							</div>	
							<?php endif; ?>	
							<div class="saras-nav-toggle">
								<button type="button" class="ally">
									<span class="saras-icon-menu icon"></span>
									<span class="screen-reader-text"><?php	_e( 'Toggle Navigation Menu','saraswathi-lite' );	?>
									</span>
								</button>	
							</div>	
						</div>
<?php	}
endif;




/**
*	3.0 - Single
*/

/**
*	3.1	-	Entry Header
*/

if ( ! function_exists( 'saraswathi_entry_header' ) ) :
	/**
	 * Prints HTML with header title and meta information for the categories, tags.
	 *
	 * @since Saraswathi Lite 1.0.0
	 */
	function saraswathi_entry_header() {

			echo '<header class="entry-header">';
			echo '<div class="entry-meta">';

			if ( ! saraswathi_get_theme_mod( 'saras_disable_entry_date' ) ) {

				if ( in_array( get_post_type(), array( 'post', 'attachment' ) ) ) {

					$time_string = '<time class="entry-date published" datetime="%1$s" itemprop="datePublished">%2$s</time>';
					if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
						$time_string = '<time class="entry-date published" datetime="%1$s" itemprop="datePublished">%2$s</time><time class="updated" datetime="%3$s" itemprop="dateModified">%4$s</time>';
					}
					$time_string = sprintf( $time_string,
						esc_attr( get_the_date() ),
						get_the_date(),
						esc_attr( get_the_modified_date() ),
						get_the_modified_date()
					);
					if ( ! empty($time_string) ) {
						printf( '<span class="posted-on"><span class="screen-reader-text">%1$s</span>%2$s</span>',
							_x( 'Posted on','Used before publish date.','saraswathi-lite' ),
							$time_string
						);
					}
				} else {
					$time_string = '<time class="entry-date published" datetime="%1$s" itemprop="datePublished">%2$s</time>';
					if ( get_the_time() !== get_the_modified_time() ) {
						$time_string = '<time class="entry-date published" datetime="%1$s" itemprop="datePublished">%2$s</time> <time class="updated" datetime="%3$s" itemprop="dateModified">%4$s</time>';
					}
					$time_string = sprintf( $time_string,
						esc_attr( get_the_date() ),
						get_the_date(),
						esc_attr( get_the_modified_date() ),
						get_the_modified_date()
					);
					echo '<span class="updated" itemprop="dateModified">'.$time_string.'</span>';
				}
			}

			if ( ! saraswathi_get_theme_mod( 'saras_disable_entry_category' ) ) {

				$categories_list = get_the_category_list( ',' );
				if ( $categories_list && saraswathi_categorized_blog() ) {
					printf( '<span class="cat-links"><span class="screen-reader-text">%1$s</span>%2$s</span>',
						_x( 'Categories','Used before category names.','saraswathi-lite' ),
						$categories_list
					);
				}
			}
			$sarasMeta = get_post_meta(get_the_id(), 'saras_hide_title', true );
	        $hideTitle = isset( $sarasMeta ) ? $sarasMeta : 0;
			if(!$hideTitle){
			echo '</div>';
			the_title( '<h1 class="entry-title" itemprop="headline">','</h1>' );
			echo '</header><!-- .entry-header -->';
			}


	}
endif;

/**
*	3.2	-	Entry Content
*/

if ( ! function_exists( 'saraswathi_get_content' ) ) :
	/**
	 * Return the content.
	 *
	 * Does the required actions and chooses the content output.
	 *
	 * @since Saraswathi Lite 1.0.0
	 *
	 * @echo Content.
	 */
	function saraswathi_get_content() {

		if ( is_singular() ) {
			do_action( 'saraswathi_before_the_content' );
			echo '<div class="entry-content">';
			do_action( 'saraswathi_start_of_content' );

			the_content( sprintf(
				__( 'Continue reading %s <span class="meta-nav">&rarr;</span>','saraswathi-lite' ),
				the_title( '<span class="screen-reader-text">"','"</span>',false )
			));
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:','saraswathi-lite' ),
				'after'  => '</div><!--.entry-content-->',
			));
			do_action( 'saraswathi_end_of_content' );
			echo '</div>';
			do_action( 'saraswathi_after_the_content' );
		}
	}
endif;

/**
*	3.3	- Entry Footer
*/

if ( ! function_exists( 'saraswathi_entry_footer' ) ) :
	/**
	 * Prints HTML with footer meta information for post content.
	 *
	 * @since Saraswathi Lite 1.0.0
	 */
	function saraswathi_entry_footer() {

		echo '<footer class="entry-footer"><div class="entry-meta">';

		if ( is_sticky() && is_home() && ! is_paged() ) {
			printf( '<span class="sticky-post">%s</span>',__( 'Featured','saraswathi-lite' ) );
		}
		if ( ! saraswathi_get_theme_mod( 'saras_disable_entry_format' ) ) {
				$format = get_post_format();
			if ( current_theme_supports( 'post-formats',$format ) ) {
					$icon = 'saras-icon-';
				if ( 'image' === $format ) {
					$icon .= 'image';
				} elseif ( 'video' === $format ) {
					$icon .= 'film';
				}

				printf( '<span class="entry-format">%1$s<a href="%2$s"><i class="%3$s"></i></a></span>',
					sprintf( '<span class="screen-reader-text">%s </span>',_x( 'Format','Used before post format.','saraswathi-lite' ) ),
					esc_url( get_post_format_link( $format ) ),
					$icon
				);
			}
		}
		if ( ! saraswathi_get_theme_mod( 'saras_disable_entry_tags' ) ) {
			$tags_list = get_the_tag_list( '' );
			if ( $tags_list ) {
				printf( '<span class="tags-links"><span class="screen-reader-text">%1$s</span>%1$s: %2$s</span>',
					_x( 'Tags','Used before tag names.','saraswathi-lite' ),
					$tags_list
				);
			}
		}

		if ( is_attachment() && wp_attachment_is_image() ) {
			// Retrieve attachment metadata.
			$metadata = wp_get_attachment_metadata();

			printf( '<span class="full-size-link" title="%5$s"><span class="screen-reader-text">%1$s</span><a href="%2$s" class="img-link" itemprop="url">%3$s &times; %4$s</a></span>',
				_x( 'Full size','Used before full size attachment link.','saraswathi-lite' ),
				esc_url( wp_get_attachment_url() ),
				$metadata['width'],
				$metadata['height'],
				_x( 'Click Here To View Full Size Image','Used for full size attachment link title.','saraswathi-lite' )
			);
		}

		if ( ! saraswathi_get_theme_mod( 'saras_disable_entry_comment' ) ) {
			$commenttext = __( 'Leave a comment','saraswathi-lite' );
			if ( is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) && $commenttext ) {
				echo '<span class="comments-link">';
				comments_popup_link( $commenttext, __( '<span itemprop="commentCount">1</span> Comment','saraswathi-lite' ), __( '<span itemprop="commentCount">%</span> Comments','saraswathi-lite' ) );
				echo '</span>';
			}
		}
		echo '</div></footer><!-- .entry-footer -->';
	}
endif;


if ( ! function_exists( 'saraswathi_author_meta' ) ) :
	/**
	 * Prints HTML with author meta information for post content.
	 *
	 * @since Saraswathi Lite 1.0.0
	 */
	function saraswathi_author_meta() {

		if ( ! saraswathi_get_theme_mod( 'saras_disable_entry_author' ) ) {
			if ( 'post' === get_post_type() ) {
				if ( is_singular() && is_multi_author() && !is_archive() ) {
					echo '<div class="author-meta">';
					if ( get_avatar( get_the_author_meta( 'email' ), '100' ) ) {
						echo get_avatar( get_the_author_meta( 'email' ), '100' );
					}
					echo '<div class="author-info">';
					printf( '%1$s',
						sprintf( '<span class="screen-reader-text">%2$s</span><h3><span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" itemprop="author">%2$s</a></span></h3>',
							esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
							esc_html( get_the_author() ),
						_x( 'Author','Used before post author name.','saraswathi-lite' )) );
					printf( __( '<span class="author-desc">%1$s</span>','saraswathi-lite' ), esc_html( get_the_author_meta( 'description' ) ) );
					echo '</div></div>';
				}
			}
		}

	}
	add_action( 'saraswathi_after_entry_content','saraswathi_author_meta' );
endif;


/**
*	4.0	-	Archive
*/

/**
*	4.1	-	Archive Header
*/

if ( ! function_exists( 'saraswathi_archive_title' ) ) :
	/**
	 *
	 * Display the archive title based on the queried object.
	 *
	 * @param string $before Optional. Content to prepend to the title. Default empty.
	 * @param string $after  Optional. Content to append to the title. Default empty.
	 */
	function saraswathi_archive_title( $title, $before = '',$after = '' ) {

		if ( is_category() ) {

			$title = sprintf( __( '<span title="%1$s %2$s" class="saras-icon-storage"><span>%1$s</span></span>','saraswathi-lite' ), ucfirst( single_cat_title( '',false ) ), _x( 'Category Archive','Used for category archive title attribute.','saraswathi-lite' ) );

		} elseif ( is_tag() ) {

			$title = sprintf( __( '<span title="%1$s %2$s" class="saras-icon-tag"><span>%1$s</span></span>','saraswathi-lite' ), ucfirst( single_tag_title( '',false ) ), _x( 'Tag Archive','Used for tag archive title attribute.','saraswathi-lite' ) );

		} elseif ( is_author() ) {

			$title = sprintf( __( '<span title="%2$s %1$s">Author: <span class="vcard">%1$s</span></span>','saraswathi-lite' ), ucfirst( get_the_author() ), _x( 'Posts By Author:','Used for author archive title attribute.','saraswathi-lite' ) );

		} elseif ( is_year() ) {

			$title = sprintf( __( '<span title="%2$s %1$s" class="saras-icon-schedule"><span>%1$s</span></span>','saraswathi-lite' ), ucfirst( get_the_date( _x( 'Y','yearly archives date format','saraswathi-lite' ) ) ), _x( 'All The Posts From The Year','Used for year archive title attribute.','saraswathi-lite' ) );

		} elseif ( is_month() ) {

			$title = sprintf( __( '<span title="%2$s %1$s" class="saras-icon-schedule"><span>%1$s</span></span>','saraswathi-lite' ), ucfirst( get_the_date( _x( 'F Y','monthly archives date format','saraswathi-lite' ) ) ), _x( 'All The Posts From The Month Of','Used for month archive title attribute.','saraswathi-lite' ) );

		} elseif ( is_day() ) {

			$title = sprintf( __( '<span title="%2$s %1$s" class="saras-icon-schedule"><span>%1$s</span></span>','saraswathi-lite' ), ucfirst( get_the_date( _x( 'F j, Y','daily archives date format','saraswathi-lite' ) ) ), _x( 'All The Posts From The Day','Used for date archive title attribute.','saraswathi-lite' ) );

		} elseif ( is_tax( 'post_format','post-format-aside' ) ) {

			$title = sprintf( __( '<span title="%2$s" class="saras-icon-storage"><span>%1$s</span></span>','saraswathi-lite' ), _x( 'Aside','Used for aside archive text.','saraswathi-lite' ), _x( 'Aside Archive','Used for aside archive title attribute.','saraswathi-lite' ) );

		} elseif ( is_tax( 'post_format','post-format-gallery' ) ) {

			$title = sprintf( __( '<span title="%2$s" class="saras-icon-gallery"><span>%1$s</span></span>','saraswathi-lite' ), _x( 'Gallery','Used for gallery archive text.','saraswathi-lite' ), _x( 'Gallery Archive','Used for gallery archive title attribute.','saraswathi-lite' ) );

		} elseif ( is_tax( 'post_format','post-format-image' ) ) {

			$title = sprintf( __( '<span title="%2$s" class="saras-icon-image"><span>%1$s</span></span>','saraswathi-lite' ), _x( 'Image','Used for image archive text.','saraswathi-lite' ), _x( 'Image Archive','Used for image archive title attribute.','saraswathi-lite' ) );

		} elseif ( is_tax( 'post_format','post-format-video' ) ) {

			$title = sprintf( __( '<span title="%2$s" class="saras-icon-film"><span>%1$s</span></span>','saraswathi-lite' ), _x( 'Video','Used for video archive text.','saraswathi-lite' ), _x( 'Video Archive','Used for video archive title attribute.','saraswathi-lite' ) );

		} elseif ( is_tax( 'post_format','post-format-quote' ) ) {

			$title = sprintf( __( '<span title="%2$s" class="saras-icon-quote-close"><span>%1$s</span></span>','saraswathi-lite' ), _x( 'Quote','Used for quote archive text.','saraswathi-lite' ), _x( 'Quote Archive','Used for quote archive title attribute.','saraswathi-lite' ) );

		} elseif ( is_tax( 'post_format','post-format-link' ) ) {

			$title = sprintf( __( '<span title="%2$s" class="saras-icon-link"><span>%1$s</span></span>','saraswathi-lite' ), _x( 'Link','Used for link archive text.','saraswathi-lite' ), _x( 'Link Archive','Used for link archive title attribute.','saraswathi-lite' ) );

		} elseif ( is_tax( 'post_format','post-format-status' ) ) {

			$title = sprintf( __( '<span title="%2$s" class="saras-icon-comment"><span>%1$s</span></span>','saraswathi-lite' ), _x( 'Status','Used for status archive text.','saraswathi-lite' ), _x( 'Status Archive','Used for status archive title attribute.','saraswathi-lite' ) );

		} elseif ( is_tax( 'post_format','post-format-audio' ) ) {

			$title = sprintf( __( '<span title="%2$s" class="saras-icon-sound"><span>%1$s</span></span>','saraswathi-lite' ), _x( 'Audio','Used for audio archive text.','saraswathi-lite' ), _x( 'Audio Archive','Used for audio archive title attribute.','saraswathi-lite' ) );

		} elseif ( is_tax( 'post_format','post-format-chat' ) ) {

			$title = sprintf( __( '<span title="%2$s" class="saras-icon-person"><span>%1$s</span></span>','saraswathi-lite' ), _x( 'Chat','Used for chat archive text.','saraswathi-lite' ), _x( 'Chat Archive','Used for chat archive title attribute.','saraswathi-lite' ) );

		} elseif ( is_post_type_archive() ) {

			$title = sprintf( __( '<span title="%1$s %2$s" class="saras-icon-storage"><span>%1$s</span></span>','saraswathi-lite' ), ucfirst( post_type_archive_title( '',false ) ), _x( 'Archive','Used for post type archive title attribute.','saraswathi-lite' ) );

		} elseif ( is_tax() ) {

			$tax = get_taxonomy( get_queried_object()->taxonomy );

			/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
			$title = sprintf( __( '<span title="%1$s: %2$s %3$s" class="saras-icon-storage"><span>%2$s</span></span>','saraswathi-lite' ), ucfirst( $tax->labels->singular_name ), ucfirst( single_term_title( '',false ) ), _x( 'Archive','Used for post type archive title attribute.','saraswathi-lite' ) );

		} else {

			$title = sprintf( __( '<span title="%2$s" class="saras-icon-storage"><span>%1$s</span></span>','saraswathi-lite' ),_x( 'Archive','Used for archive title attribute.','saraswathi-lite' ) );

		}

	
			return $title;

	}
endif;


add_filter( 'get_the_archive_title', 'saraswathi_archive_title' );
/**
*	4.2	-	Summary Media
*/

if ( ! function_exists( 'saraswathi_featured_media' ) ) :
	/**
	 * Display the Featured media based on post format on archive pages.
	 *
	 * @todo Remove this function when WordPress 4.3 is released.
	 *
	 * @param string $before Optional. Content to prepend to the media. Default empty.
	 * @param string $after  Optional. Content to append to the media. Default empty.
	 * @param array $args 	 Array of arguments for post layout.
	 */

	function saraswathi_featured_media( $args = null, $before = null, $after	 = null ) {

		$size						=	( $args['size']	)	?	$args['size']	:	saraswathi_get_theme_mod( 'saras_featured_media_size','large' );

			saraswathi_sanitize_output_text( $before );
	?>
	<div id="media-load" class="media-container <?php saraswathi_customizer_output_class( $size ); ?>">
	<?php
	if ( 'video' === get_post_format() ) {

		saraswathi_summary_featured_video();

	} elseif ( 'image' === get_post_format() ) {

		saraswathi_summary_featured_image(	$size	);

	} elseif ( has_post_thumbnail() ) {

		saraswathi_summary_featured_image(	$size	);
	}
	?>
	</div>
	<?php
		saraswathi_sanitize_output_text( $after );
	}
endif;


if ( ! function_exists( 'saraswathi_featured_media_empty' ) ) :
	/**
	 * Check if the featured media container has any content or empty.
	 *
	 * Returns empty null if nothing is found..
	 */
	function saraswathi_featured_media_empty() {

		ob_start();
		saraswathi_featured_media();
		$content = force_balance_tags( ob_get_clean() ); // Make sure user typo's are avoid as much as possible.
		if (	empty(	$content	)	) {
			return false;
		}
		$dom = new domDocument; // Represents an entire HTML or XML document; serves as the root of the document tree.
		$dom->loadHTML( mb_convert_encoding( $content, 'HTML-ENTITIES', 'UTF-8' ) ); // Load our content to dom to parse as an object
		$dom->preserveWhiteSpace = false; // Make sure WordPress formatting is taken into account.
		$dom->formatOutput = false;
		$dom->encoding = 'UTF-8';
		$dom->substituteEntities = false;
		$dom->strictErrorChecking = false;
		$media = $dom->getElementById( 'media-load' );
		if (	1 === $media->childNodes->length ) {
			return true;
		} else {
			return false;
		}
	}
endif;

/**
*	4.2.1	-	Image
*/

if ( ! function_exists( 'saraswathi_featured_image' ) ) :
	/**
	 * Gets the featured image for display.
	 *
	 * Display the image based on format.
	 *
	 * @param string $size Size of media wanted.
	 */
	function saraswathi_featured_image( $size = null ) {

		if ( empty ( $size ) ) {
			$size = saraswathi_get_theme_mod( 'saras_featured_media_size','large' );
		}

		if ( has_post_thumbnail() ) {

			echo saraswathi_post_thumbnail( $size );

		} elseif ( 'image' === get_post_format() ) {
			$args = array(
			'post_type' => 'attachment',
			'numberposts' => 1,
			'post_status' => null,
			'post_parent' => get_the_ID(),
			);

			$attachments = get_posts( $args );

			if ( ! empty($attachments) ) {
				clean_attachment_cache( $attachments[0]->ID );
				echo  wp_get_attachment_image( $attachments[0]->ID, $size );
			}
		}
	}
endif;

if ( ! function_exists( 'saraswathi_featured_full_image_src' ) ) :
	/**
	 * Gets the full image src of featured image.
	 *
	 * Retrives full image link based on format.
	 */
	function saraswathi_featured_full_image_src() {

		if ( 'image' === get_post_format() ) {
			$args = array(
			'post_type' => 'attachment',
			'numberposts' => 1,
			'post_status' => null,
			'post_parent' => get_the_ID(),
			);
			$attachments = get_posts( $args );
			
			$image_src = isset($attachments[0]) ? wp_get_attachment_image_src( $attachments[0]->ID, 'full' ): null;
			
		} elseif ( has_post_thumbnail() ) {
			
			$image_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
		}

		return $image_src[0];
	}
endif;

if ( ! function_exists( 'saraswathi_summary_featured_image' ) ) :
	/**
	 * Gets the image box for display within featured media container.
	 *
	 * Display the image box based on format.
	 *
	 * @param string $size Size of media wanted.
	 */
	function saraswathi_summary_featured_image( $size = null ) {
			
			$size						=	( $size	)	?	$size	:	saraswathi_get_theme_mod( 'saras_featured_media_size','large' );
			$image_src = saraswathi_featured_full_image_src();
		if ( '' !== $image_src ) {
			saraswathi_featured_image( $size );
		}
	}
endif;

/**
*	4.2.2	-	Video Format
*/

if ( ! function_exists( 'saraswathi_summary_featured_video' ) ) :
	/**
	 * Gets the video for display within featured media container.
	 *
	 * Display the video based on format.
	 */
	function saraswathi_summary_featured_video() {

		$customfields = get_post_custom_keys();

		if ( 'video' === get_post_format() ) {
			$i = 1;
			/**
		* Loop through custom fields to find oembeds
		*
		* $media holds the video embed
		*/
			foreach ( $customfields as $customfield ) {
				if ( strpos( $customfield,'oembed' ) && ! strpos( $customfield,'time' ) ) {
					$embed_array = get_post_custom_values( $customfield );
				}
			}
			/**
			* Echo only the first oembed
			*/
			echo '<div class="video-wrapper">';
			foreach ( $embed_array as $embed ) {
				if ( 1 === $i ) {
					echo $embed;
				}
				$i++;
			}
			echo '</div>';
		}
	}
endif;


/**
*	4.3	-	Summary Header
*/

if ( ! function_exists( 'saraswathi_summary_header' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function saraswathi_summary_header() {

		echo '<header class="summary-header entry-header" itemprop="headline">';
		the_title( sprintf( '<h4 class="summary-title entry-title"><a href="%s" rel="bookmark" itemprop="name">',esc_url( get_permalink() ) ), '</a></h4>' );
		echo  '</header><!-- .summary-header -->';
	}
endif;

/**
 *	4.4	-	Summary Meta
 */

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function saraswathi_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'saraswathi_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'saraswathi_categories',$all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so saraswathi_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so saraswathi_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in saraswathi_categorized_blog.
 */
function saraswathi_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'saraswathi_categories' );
}
add_action( 'edit_category','saraswathi_category_transient_flusher' );
add_action( 'save_post',    'saraswathi_category_transient_flusher' );

if ( ! function_exists( 'saraswathi_excerpt_posted_on' ) ) :
	/**
	 * Prints posted date in the quired format
	 *
	 * @param array $args array of arguments for post layout. 
	 */
	function saraswathi_excerpt_posted_on( $args = null  ) {
				// Get the right size for avatar.
		
		$small_media    = array( 'thumbnail', 'medium' );
		$large_media    = array( 'large' , 'full' );
		
		
			$title = $class = '';

			if ( 'post' === get_post_type() ) {

				if ( in_array( $args['size'] , $large_media ) && 'regular' === $args['layout'] ) {
					$title = '<span class="box-title">Published</span>';
				}
					$class	= 'muted';
			}

			$time_string = ' <time class="entry-date published" datetime="%1$s" itemprop="datePublished">%2$s</time>';
			$time_string = sprintf( $time_string,
				esc_attr( get_the_date() ),
				esc_html( get_the_date() )
			);
			printf( __( '<span class="time-box %4$s"> %3$s %2$s <span class="posted-on" itemprop="datePublished"><span class="screen-reader-text">%1$s</span>%1$s</span></span>','saraswathi-lite' ),$time_string, _x( '<i class="saras-icon-time"></i> ','Used before summary date.','saraswathi-lite' ), $title, $class );

	}
endif;

if ( ! function_exists( 'saraswathi_excerpt_author' ) ) :
	/**
	 * Prints posted date in the quired format
	 *
	 * @param array $args array of arguments for post layout. 
	 */
	function saraswathi_excerpt_author( $args = null  ) {
		
			$title = '';
			// Get the right size for avatar.
			$small_media    = array( 'thumbnail', 'medium' );
			$large_media    = array( 'large' , 'full' );
			$size = '';
			
			if ( in_array( $args['size'] , $large_media ) && 'regular' === $args['layout'] ) {
				$size = 100;
				$title = '<span class="box-title">Author</span>';
			} else {
				$title = 'by';
			}

			// Now get the avatar.
			if ( get_avatar( get_the_author_meta( 'email' ), get_the_author() ) && ! empty( $size ) ) {
				$avatar = get_avatar( get_the_author_meta( 'email' ), $size );
			} else {
				$avatar = get_the_author_link();
			}

			printf( __( '<span class="vcard-box muted"> %2$s <span class="author-byline">%1$s</span></span>','saraswathi-lite' ),
				sprintf( '<span class="author vcard" itemprop="author"><a class="url fn n muted" href="%1$s" title="%2$s">%3$s</a></span>',esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),esc_html( get_the_author() ), $avatar ), $title
			);

	}
endif;

if ( ! function_exists( 'saraswathi_excerpt_category' ) ) :
	/**
	 * Get the categories list neatly organised.
	 *
	 * @param array $args array of arguments for post layout.
	 */
	function saraswathi_excerpt_category( $args = null ) {

			$title = $class = $linkclass = '';
			$small_media    = array( 'thumbnail', 'medium' );
			$large_media    = array( 'large' , 'full' );

			if ( in_array( $args['size'] , $large_media ) && 'regular' === $args['layout'] ) {
				$title = '<span class="box-title">Category</span> ';
			}

			if ( in_array( $args['size'] , $large_media ) && 'regular' !== $args['layout'] ) {
				$class = '';
			} else {
				$class	= '';
			}

		// A comma seperated category list.
			$categories_list = get_the_category_list( _x( '<span class="cat-divider"></span>','Used between list items, there is a space after the comma.','saraswathi-lite' ) );
			if ( $categories_list && saraswathi_categorized_blog() ) {
				printf( '<span class="cat-box %4$s">%3$s<span class="cat-links %4$s %5$s"><span class="screen-reader-text">%1$s</span>%6$s %2$s</span></span>',
					_x( 'Categories','Used before category names.','saraswathi-lite' ),
					$categories_list, $title, $class, $linkclass,_x( '<i class="saras-icon-category"></i> ','Used before summary category.','saraswathi-lite' )
				);
			}

	}
endif;


if ( ! function_exists( 'saraswathi_excerpt_more' ) && ! is_admin() ) :
	/**
	 * Replaces "[...]" (appended to automatically generated excerpts) with ... and a 'Continue reading' link.
	 *
	 * @since Saraswathi Lite 1.0.0
	 *
	 * @param string $more the more text.
	 *
	 * @return string 'Continue reading' link prepended with an ellipsis.
	 *
	 * @param array $args array of arguments for post layout.
	 */
	function saraswathi_excerpt_more( $more, $args = null ) {

			if ( is_admin() ) {
				return $more;
			}
	
			$small_media    = array( 'thumbnail', 'medium' );
			$large_media    = array( 'large' , 'full' );

			$more_text = $more_link = '';

			if ( in_array( saraswathi_get_theme_mod( 'saras_featured_media_size','large' ) , $large_media ) ) {
				$more_link = '<p><a href="%1$s" class="more-link muted">%2$s</a></p>';
				$more_text = _x( 'Read More <span class="meta-nav">&rarr;</span>','Used before summary read more link for regular large media layout','saraswathi-lite' );
			} else if ( in_array( saraswathi_get_theme_mod( 'saras_featured_media_size','large' ) , $small_media ) ) {
				$more_link = '<a href="%1$s" class="more-link">%2$s</a>';
				$more_text = _x( 'Read More <span class="meta-nav">&rarr;</span>','Used before summary read more link for regular small media layout','saraswathi-lite' );
			}

			$more = sprintf( $more_link,
				esc_url( get_permalink( get_the_ID() ) ),
				/* translators: %s: Name of current post */
				$more_text.' <span class="screen-reader-text">' . get_the_title( get_the_ID() ) . '</span>'	);
			return $more;
		}

	add_filter( 'excerpt_more','saraswathi_excerpt_more' );
endif;


/**
*	4.5	-	Summary Footer
*/

if ( ! function_exists( 'saraswathi_summary_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 *
	 * @param array $args Array of parameters for post layout.
	 */
	function saraswathi_summary_footer( $args = null ) {
		$small_media    = array( 'thumbnail', 'medium' );
		$large_media    = array( 'large' , 'full' );
		
		if( is_search() ) {
			return;
		}

		echo '<footer class="summary-footer">';
		echo '<div class="summary-meta">';

		if ( in_array( $args['size'] , $small_media ) && 'regular' === $args['layout'] ) {
			saraswathi_excerpt_author(	$args	);
			saraswathi_excerpt_posted_on(	$args	);
			saraswathi_excerpt_category(	$args	);
		}

		if ( in_array( $args['size'] , $large_media ) && 'regular' === $args['layout'] ) {
			saraswathi_excerpt_author(	$args	);
			saraswathi_excerpt_posted_on(	$args	);
			saraswathi_excerpt_category(	$args	);
		}
		echo  '</div><!-- .summary-meta -->';
		echo '</footer><!-- .summary-footer -->';

	}
endif;


/**
*	4.6	-	Summary Content
*/

if ( ! function_exists( 'saraswathi_summary' ) ) :
	/**
	 * Summary of posts.
	 *
	 * Does the required actions and chooses the summary output.
	 *
	 * @since Saraswathi Lite 1.0.0
	 *
	 * @param array $args array of arguments for post layout.
	 *
	 * @arguments string $args['size'] Size of media wanted.
	 *
	 * @arguments string $args['layout'] Type of post layout.	 	
	 *
	 * @echo summary.
	 */
	function saraswathi_summary( $args = null ) {
		
		$small_media    = array( 'thumbnail', 'medium' );
		
		$large_media    = array( 'large' , 'full' );
		
		$size		=	( $args['size']	)	?	$args['size']	:	saraswathi_get_theme_mod( 'saras_featured_media_size','large' );
		
		$layout	=	(	$args['layout']	)	?	$args['layout']	:	'regular';	
		
		$toggleExcerpt	=	isset(	$args['excerpt']	)	?	$args['excerpt']	:	'true';	
		
		$toggleMedia	=	( ! is_search() && ! saraswathi_featured_media_empty() );	


		
		$width 					= '';
		$args['size']	=	$size;
		$args['layout']	=	$layout;
		if ( in_array( $args['size'] , $small_media ) && 'regular' === $args['layout'] ) {
			if ( $toggleMedia  ) {
				echo '<div class="media">';
				saraswathi_featured_media(	$args	);
				echo '</div>';
				$width = 'regular';
			} else {
				$width = 'full-width';
			}

			echo '<div class="summary '.$width.'">';
			// Footer.
			saraswathi_summary_footer(	$args	);
			// Header.
			saraswathi_summary_header(	$args	);
			// Content.
			if ( $toggleExcerpt ) {
				echo '<div class="summary-content entry-summary" itemprop="description">';
				the_excerpt( the_title( '<span class="screen-reader-text">"','"</span>' ) );
				echo '</div>';
			}
			echo '</div>';

		}

		if ( in_array( $args['size'] , $large_media ) && 'regular' === $args['layout'] ) {
				echo '<div class="media">';
				saraswathi_featured_media(	$args	);
				echo '</div>';
			echo '<div class="summary">';
			// Header.
			saraswathi_summary_header(	$args	);
			// Content
			if ( $toggleExcerpt ) {
				echo '<div class="summary-content entry-summary" itemprop="description">';
				the_excerpt( the_title( '<span class="screen-reader-text">"','"</span>' ) );
				echo '</div>';
			}
			echo '</div>';
			// Footer.
			saraswathi_summary_footer(	$args	);
		}
	}
endif;

if ( ! function_exists( 'saraswathi_get_summary_content' ) ) :
	/**
	 * The summary content.
	 *
	 * Does the required actions and chooses the content output.
	 *
	 * @since Saraswathi Lite 1.0.0
	 *
	 * @echo summary Content.
	 */
	function saraswathi_get_summary_content() {

		echo '<div class="summary-content entry-summary">';
		the_excerpt( sprintf( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>','saraswathi-lite' ),the_title( '<span class="screen-reader-text">"','"</span>',false ) ) );
		echo '</div>';

	}
endif;

/**
 * Add filter to change the length of excerpt to 30 characters.
 *
 * @param integer $length Number of characters needed in excerpt.
 */
function saraswathi_excerpt_length( $length ) {

	if ( is_admin() ) {
        return $length;
    }

	return 22;
}
add_filter( 'excerpt_length','saraswathi_excerpt_length' );

/**
*	5.0 - Widget Areas
*/

if ( ! function_exists( 'saraswathi_above_index_widgets' ) ) :
	/**
	 * Return the dynamic index widgets.
	 *
	 * @since Saraswathi Lite 1.0.0
	 *
	 * @return footer index area.
	 */
	function saraswathi_above_index_widgets() {
		if ( saraswathi_get_theme_mod( 'saras_enable_index_widgetarea',0 ) ) {
			echo '<div class="saras-widgetarea-above"><div class="index-widgets">';
			for ( $i = 1; $i <= saraswathi_get_theme_mod( 'saras_default_above_index_widgetarea_count','1' ); $i++ ) {
			
				echo '<div id="above-index-widget-'.$i.'" class="widget-area saras-widget-grid row-'.saraswathi_get_theme_mod( 'saras_default_above_index_widgetarea_count','1' ).' ">';
				dynamic_sidebar( 'above-index-widget-'.$i.'' );
				echo '</div>';
			}
			echo '</div> <!-- .index-widgets --></div> <!-- .saras-above-index-widget-area -->';
		}

	}
endif;


if ( ! function_exists( 'saraswathi_below_index_widgets' ) ) :
	/**
	 * Return the dynamic below content index widget area.
	 *
	 * @since Saraswathi Lite 1.0.0
	 *
	 * @return Index widget area.
	 */
	function saraswathi_below_index_widgets() {

		if ( saraswathi_get_theme_mod( 'saras_enable_index_widgetarea',0 ) ) {
			echo '<div class="saras-widgetarea-below"><div class="index-widgets"> ';
			for ( $i = 1; $i <= saraswathi_get_theme_mod( 'saras_default_below_index_widgetarea_count','1' ); $i++ ) {

				echo '<div id="below-index-widget-'.$i.'" class="widget-area saras-widget-grid row-'.saraswathi_get_theme_mod( 'saras_default_below_index_widgetarea_count','1' ).' ">';
				dynamic_sidebar( 'below-index-widget-'.$i.'' );
				echo '</div>';
			}
			echo '</div> <!-- .index-widgets --></div> <!-- .saras-below-index-widget-area -->';
		}
	}
endif;


if ( ! function_exists( 'saraswathi_widgets_position_above' ) ) :
	/**
	 * Creates widget area above content widgets
	 *
	 * @since Saraswathi Lite 1.0.0
	 *
	 * @echo above content widget area widgets.
	 */
	function saraswathi_widgets_position_above() {

		if ( is_front_page() ) {
			if ( saraswathi_get_theme_mod( 'saras_enable_index_widgetarea',0 ) && in_array(saraswathi_get_theme_mod( 'saras_default_content_widgetarea_position','both' ), array('above', 'both')) ) :
				saraswathi_above_index_widgets();
				endif;
		} 
	}
	add_action( 'saraswathi_after_primary_before_entry_content','saraswathi_widgets_position_above');
endif;

if ( ! function_exists( 'saraswathi_widgets_position_below' ) ) :
	/**
	 * Creates widget area below content widgets
	 *
	 * @since Saraswathi Lite 1.0.0
	 *
	 * @echo below content widget area widgets.
	 */
	function saraswathi_widgets_position_below() {

		if ( is_front_page() ) {
			if ( saraswathi_get_theme_mod( 'saras_enable_index_widgetarea',0 ) && in_array(saraswathi_get_theme_mod( 'saras_default_content_widgetarea_position','both' ), array('below', 'both')) ) :
				saraswathi_below_index_widgets();
				endif;
		}

	}
	add_action( 'saraswathi_after_entry_content','saraswathi_widgets_position_below' );
endif;

/**
*	6.0	-	Footer
*/

if ( ! function_exists( 'saraswathi_social_icons' ) ) :
	/**
	 * Return the social icons.
	 *
	 * @since Saraswathi Lite 1.0.0
	 *
	 * @see saraswathi_get_social_icons()
	 *
	 * @return social icons as hyperlinks.
	 */
	function saraswathi_social_icons(	$args	=	null	) {
		$html = '';
		
		$icons = isset($args['icons'])? $args['icons']	:	saraswathi_get_social_icons();

		if ( $icons ) {

			foreach ( $icons as $key => $value ) {

				if ( $value && saraswathi_is_url( $value ) ) {

					if ( 'twitter' === $key ) {

						$html .= '<a class="icon saras-icon-'.esc_attr($key).'" href="'.esc_url($value).'" target="_blank" title="'.__('Follow on twitter','saraswathi-lite').'" rel="nofollow"><span class="screen-reader-text">'.__('Follow on twitter','saraswathi-lite').'</span></a>';

					} elseif ( 'facebook' === $key  ) {

						$html .= '<a class="icon saras-icon-'.esc_attr($key).'" href="'.esc_url($value).'" target="_blank" title="'.__( 'Like on facebook','saraswathi-lite' ).'" rel="nofollow"><span class="screen-reader-text">'.__( 'Like on facebook','saraswathi-lite' ).'</span></a>';
					} elseif ( 'google' === $key ) {

						$html .= '<a class="icon saras-icon-'.esc_attr($key).'-plus" href="'.esc_url($value).'" target="_blank" title="'.__( 'Follow on google','saraswathi-lite' ).'" rel="publisher"><span class="screen-reader-text">'.__( 'Follow on google','saraswathi-lite' ).'</span></a>';
					} else {

						$html .= '<a class="icon '.esc_attr($key).'" href="'.esc_url($value).'" target="_blank" title="'.__( 'Visit ','saraswathi-lite' ).$key.'" rel="nofollow"><span class="screen-reader-text">'.__( 'Visit ','saraswathi-lite' ).$key.' </span></a>';
					}
				}
			}
		}
		return $html;
	}
endif;


if ( ! function_exists( 'saraswathi_footer_widgets' ) ) :
	/**
	 * Return the dynamic footer widgets.
	 *
	 * @since Saraswathi Lite 1.0.0
	 *
	 * @return footer widget area.
	 */
	function saraswathi_footer_widgets() {

		if ( saraswathi_get_theme_mod( 'saras_enable_footer_widgetarea',1 ) ) {
			echo '<div class="saras-footer-widgetarea"><div class="footer-widgets"> ';
			for ( $i = 1; $i <= 3; $i++ ) {
				echo '<div id="footer-widget-'.$i.'" class="widget-area saras-footer-grid col-3">';
				dynamic_sidebar( 'footer-widget-'.$i.'' );
				echo '</div>';
			}
			echo '</div> <!-- .footer-widgets --></div> <!-- .saras-footer-widgetarea -->';
		}
	}
endif;

if ( ! function_exists( 'saraswathi_footer' ) ) :
	/**
	 * Return the dynamic footer.
	 *
	 * @since Saraswathi Lite 1.0.0
	 *
	 * @echo footer widget area.
	 */
	function saraswathi_footer() {

		?>
	<div class="saras-footer-container">
		<div class="saras-footer-navarea">
		<?php
		saraswathi_footer_scroll_top();
		saraswathi_footer_menu_section();
		saraswathi_footer_buttons();
		?>
		</div> <!-- .saras-footer-nav-area -->
		<?php
		saraswathi_footer_widgets();
		saraswathi_footer_text_area();
		?>
	</div><!-- .saras-footer-container -->
	<?php
	}
endif;

if ( ! function_exists( 'saraswathi_footer_scroll_top' ) ) :
	/**
	 * Footer scroll to top.
	 *
	 * @since Saraswathi Lite 1.0.0
	 *
	 * @echo Footer scroll to top.
	 */
	function saraswathi_footer_scroll_top() {
		if ( saraswathi_get_theme_mod( 'saras_enable_footer_scrolltop',1 ) ) :
			echo  '<div class="scroll-top-container right">';
			echo '<button type="button" class="ally"><span class="scroll-top"></span>';
			echo '<span class="screen-reader-text">Scroll To Top</span></button></div> <!-- .scroll-top -->';
	endif;
	}
endif;


if ( ! function_exists( 'saraswathi_footer_menu_section' ) ) :
	/**
	 * Footer menu section.
	 *
	 * @since Saraswathi Lite 1.0.0
	 *
	 * @echo Footer menu section.
	 */
	function saraswathi_footer_menu_section() {
		   echo '<div class="footer-menu-section left">';
		   echo '<nav id="footer-navigation" class="saras-footer-nav left" role="navigation">';
		   saraswathi_footer_menu();
		   echo '</nav> <!-- #footer-navigation --></div> <!-- .footer-menu-section -->';
	}
endif;

if ( ! function_exists( 'saraswathi_footer_buttons' ) ) :
	/**
	 * Footer buttons.
	 *
	 * @since Saraswathi Lite 1.0.0
	 *
	 * @echo Footer buttons.
	 */
	function saraswathi_footer_buttons() {
		if ( '' !== saraswathi_social_icons() ) :
				echo '<div class="saras-footer-buttons left"><div class="saras-social-icons">';
				echo saraswathi_social_icons();
				echo '</div><!-- .saras-social-icons --></div>';
				endif;
	}
endif;


if ( ! function_exists( 'saraswathi_footer_text_area' ) ) :
	/**
	 * Footer text area.
	 *
	 * @since Saraswathi Lite 1.0.0
	 *
	 * @echo footer index area.
	 */
	function saraswathi_footer_text_area() {
		if ( saraswathi_get_theme_mod( 'saras_enable_footer_textarea',1 ) ) :
			echo '<div class="saras-footer-textarea">';
			echo '<div class="site-info">';
			saraswathi_sanitize_output_text( __( 'Developed with Saraswathi Lite Theme','saraswathi-lite' ) );
			echo '</div><!-- .site-info --></div><!-- .saras-footer-text-area -->';
	endif;
	}
endif;

/**
*	7.0	-	Schema
*/

if ( ! function_exists( 'saraswathi_body_tag_schema' ) ) :
	/**
	 * Embeds structed Data based on schema.org.
	 *
	 * @since Saraswathi Lite 1.0.0
	 *
	 * @echo schema structure data attribute.
	 */
	function saraswathi_body_tag_schema() {

		$schema = 'http://schema.org/';
		$type = 'WebPage';


		if ( is_archive( ) && 'post' === get_post_type()	) {

			$type	= 'Blog';
		} elseif ( is_search() ) {

			$type = 'SearchResultsPage';
		}
		 /**
	 * Filter the body schema itemtype.
	 *
	 * @since 1.0.0
	 *
	 * @param string $attr Change schema attribute type.
	 */
		$type	= apply_filters( 'saraswathi_body_tag_schema_type', $type );

		if ( ! empty	(	$type	)	) {

			$attr	= 'itemscope itemtype="' . $schema . $type . '"';
		}
		 /**
	 * Filter the body schema tag attributes for display in the body tag.
	 *
	 * @since 1.0.0
	 *
	 * @param string $attr Schema.org attribute.
	 */
		echo	apply_filters( 'saraswathi_body_tag_schema_attribute', $attr );

	}
endif;


if ( ! function_exists( 'saraswathi_main_tag_schema' ) ) :
	/**
	 * Embeds structed Data based on schema.org.
	 *
	 * @since Saraswathi Lite 1.0.0
	 *
	 * @echo schema structure data attribute.
	 */
	function saraswathi_main_tag_schema() {

		$attr = $prop	= '';
		// For single post types.
		$prop   = 'itemprop="mainContentOfPage"';

		// For post type archives.
		if ( is_archive( ) && 'post' === get_post_type()	) {

			$prop   = '';

		} elseif ( is_post_type_archive( 'saras-portfolio' )	) {

			$prop   = '';
		}

		/**
		* Filter the schema tag attributes for display in the main tag.
		*
		* @since 1.0.0
		*
		* @param string $attr Schema.org itemprop attribute.
		*/
		$attr	= apply_filters( 'saraswathi_main_tag_schema_attribute', $attr );

		if ( ! empty	(	$attr	)	) {
			echo $attr;
		}
	}
endif;


if ( ! function_exists( 'saraswathi_article_tag_schema' ) ) :
	/**
	 * Embeds structed Data based on schema.org.
	 *
	 * @since Saraswathi Lite 1.0.0
	 *
	 * @echo schema structure data attribute.
	 */
	function saraswathi_article_tag_schema() {

		$schema = 'http://schema.org/';
		$type	= '';
		if (	is_singular( 'post' ) || (	is_archive( ) && 'post' === get_post_type()	) ) {
			// For items that are deemed blogposts.
			$type = 'BlogPosting';
		}
		$attr	= 'itemscope itemtype="' . $schema . $type . '"';
		/**
		* Filter the schema tag attributes for display in the article tag.
		*
		* @since 1.0.0
		*
		* @param string $attr Schema.org attribute.
		*/
		echo apply_filters( 'saraswathi_article_tag_schema_attribute', $attr );
	}
endif;