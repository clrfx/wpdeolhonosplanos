<?php global $download_monitor; ?>
<div id="download-page-featured" class="download_group">
	<h3><?php _e( 'Featured', 'dlm_page_addon' ); ?></h3>
	<ul>
		<?php while ( $downloads->have_posts() ) : $downloads->the_post(); ?>

			<li><?php $download_monitor->get_template_part( 'content-download', $format, $this->plugin_path() . 'templates/' ); ?></li>

		<?php endwhile; ?>
	</ul>
</div>