<?php
/**
 * The template for displaying Tag pages.
 *
 * Used to display archive-type pages for posts in a tag.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header('resume'); ?>

	<section id="primary" class="site-content">
		<div id="content" role="main">

		<?php if ( have_posts() ) : ?>
			<header class="archive-header">
				<h1 class="archive-title"><?php printf( __( 'Tag Archives: %s', 'twentytwelve' ), '<span>' . single_tag_title( '', false ) . '</span>' ); ?></h1>

			<?php if ( tag_description() ) : // Show an optional tag description ?>
				<div class="archive-meta"><?php echo tag_description(); ?></div>
			<?php endif; ?>
			</header><!-- .archive-header -->

			<?php
			/* Start the regular Loop */
			while (have_posts()) : the_post();  ?>	

			<div id="cada-noticia" <?php post_class(array("category-regular","post-thumb")); ?>>
				<a class="link-categoria" href="<?php echo get_permalink(); ?>">
			<?php 
			if ( has_post_thumbnail() ) {
				the_post_thumbnail('category-regular', array('class'	=> "category-image"));
			}
			else {
				echo '<img class="category-image" src="' . get_bloginfo( 'stylesheet_directory' ) . '/img/thumbnail-default-small.png" />';
			}
			?>
				
				<h1 class="entry-title-query noticias"><?php the_title(); ?></h1>
				</a>
				<div class="entry-content-post-home">
					<?php the_excerpt(); ?>
				</div>
				
				<a href="<?php the_permalink(); ?>" rel="bookmark" class="leia-mais noticias-bg"><span class="mais">+</span>
				</a>
				
		</div>		
			<?php endwhile; ?>

			
			<?php twentytwelve_content_nav( 'nav-below' ); ?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

		</div><!-- #content -->
	</section><!-- #primary -->

	<?php if ( is_active_sidebar( 'sidebar-noticias-widget' ) ) : ?>
	<div id="secondary" class="noticias-sidebar" role="complementary">
			<?php dynamic_sidebar( 'sidebar-noticias-widget' ); ?>
	</div><!-- #secondary -->
	<?php endif; ?>
<?php get_footer(); ?>