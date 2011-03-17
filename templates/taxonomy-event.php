<?php get_header();?>
	<div id="content" class="narrowcolumn">
	<?php query_posts($query_string . '&orderby=title&order=ASC'); ?>
	<?php if (have_posts()) : ?>

	<div class="navigation">
		<div class="alignleft"><?php next_posts_link('&laquo; Vorherige Eintr&auml;ge') ?></div>
		<div class="alignright"><?php previous_posts_link('N&auml;chste Eintr&auml;ge &raquo;') ?></div>
	</div>

	<?php while (have_posts()) : the_post(); ?>
	<div class="post bandsummary">
		<h2 id="post-<?php the_ID(); ?>">
			<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
				<img src="<?php the_logo_url(); ?>" alt="<?php the_title(); ?>"/>
			</a>
		</h2>
		
		<div class="bandinfo">
			<p><?php the_genres(); ?> (<?php the_country(); ?>)</p>
		</div>
		
		<p>
			<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
				mehr Informationen
			</a>
		</p>
	</div>

	<?php endwhile; ?>

	<div class="navigation">
		<div class="alignleft"><?php next_posts_link('&laquo; Vorherige Eintr&auml;ge') ?></div>
		<div class="alignright"><?php previous_posts_link('N&auml;chste Eintr&auml;ge &raquo;') ?></div>
	</div>

<?php else : ?>

	<h2 class="center">Nichts gefunden.</h2>
	<?php include (TEMPLATEPATH . '/searchform.php'); ?>

<?php endif; ?>
	
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
