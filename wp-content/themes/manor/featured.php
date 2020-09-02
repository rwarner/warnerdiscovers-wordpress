<?php
/**
 * Template Name: Featured
 * 
 * Specifically used for the featured page, to get rid of the category title
 *
 */

get_header();
?>

<div class="container">
	<main id="primary" class="entries site-main" role="main">
		<?php if (have_posts())
	
			$args=array(
			'category_name' => 'featured');
		
			$wp_query = new WP_Query( $args );
			while ( $wp_query->have_posts() ) :
				$wp_query->the_post();
			endwhile;
		
			if ( have_posts() ) {
				while ( have_posts() ) {
					the_post();
					get_template_part( 'template-parts/loop/content', get_post_format() );
				}

				the_posts_pagination(
					array(
						'before_page_number' => '<span class="screen-reader-text">' . __( 'Page', 'manor' ) . '</span>',
					)
				);
			} 
		 ?>
	</main>
</div>

<?php
get_footer();

