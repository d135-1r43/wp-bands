<?php get_header(); ?>
<div id="content" class="narrowcolumn">
		
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
	<div class="post" id="post-<?php the_ID(); ?>">
		Meta-Loop:
		<?php the_meta(); ?>
		
		<div class="entry">
			<h2><img src="<?php the_logo_url(); ?>" alt="<?php the_title(); ?>"/></h2>
			<p class="bandinfo"><?php the_genres(); ?></p>
			
			<div class="socialmedia">
				<h4><?php the_title(); ?> in the Social Web</h4>
				<?php the_myspace_link(); ?>
				<?php the_facebook_link(); ?>
			</div>
			
			<h4>Audio Sample: <?php the_audio_title(); ?></h4>
			<?php the_audio_player(); ?>
		
			<?php the_content('<p class="serif">Den ganzen Beitrag lesen  &#187;</p>'); ?>
			<?php wp_link_pages(array('before' => '<p><strong>Seiten:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
	    
			<img src="<?php the_band_image_url(); ?>" alt="<?php the_title(); ?> band photo"/>
		</div>
	</div>	
	
	<?php endwhile; else: ?>
	
	<p>Es gibt leider keine Beitr&auml;ge, die deinen Kriterien entsprechen.</p>
	
	<?php endif; ?>
	
</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
