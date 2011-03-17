<?php get_header();?>

	<div id="content" class="narrowcolumn">
		archive.php

		<?php if (have_posts()) : ?>

		<div class="navigation">
			<div class="alignleft"><?php next_posts_link('&laquo; Vorherige Eintr&auml;ge') ?></div>
			<div class="alignright"><?php previous_posts_link('N&auml;chste Eintr&auml;ge &raquo;') ?></div>
		</div>

		<?php while (have_posts()) : the_post(); ?>
		<div class="post">
				<h2 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
				<small><?php the_time('l,') ?> den <?php the_time('j. F Y') ?></small>
				
				<div class="entry">
					<?php the_content(); ?>
				</div>
		
				<p class="postmetadata"><?php the_tags('Tags: ', ', ', '<br />'); ?> Kategorie <?php the_category(', ') ?> <strong>|</strong> <?php comments_popup_link('0 Kommentar &#187;', '1 Kommentar &#187;', '% Kommentare &#187;'); ?> <?php edit_post_link('Bearbeiten','<strong>|</strong> ',''); ?></p>

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
