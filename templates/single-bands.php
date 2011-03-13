<?php get_header(); ?>
<div id="content" class="narrowcolumn">
		
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
<div class="post" id="post-<?php the_ID(); ?>">
	Meta-Loop:
	<?php the_meta(); ?>
	

	<h2><img src="<?php echo get_post_meta($post->ID, 'logo_img', true); ?>" alt="<?php the_title(); ?>"/></h2>
	<p class="bandinfo"><?php the_terms($post->ID, 'genre', '', ', ', ' ' ); ?></p>
	
	<div class="entry">
		<?php the_content('<p class="serif">Den ganzen Beitrag lesen  &#187;</p>'); ?>
		<?php wp_link_pages(array('before' => '<p><strong>Seiten:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
	    
		<img src="<?php echo get_post_meta($post->ID, 'pic_img', true); ?>" alt="<?php the_title(); ?> band photo"/>
		
		
		
		<p class="postmetadata alt">
			<small>
						Geschrieben
						am <?php the_time('l,') ?> den <?php the_time('j. F Y') ?> um <?php the_time('H:i') ?> Uhr und unter
						<?php the_category(', ') ?> abgelegt.
						Du bist voll dabei im Web 2.0? Dann verfolge die Kommentare mit unserem schicken <?php comments_rss_link('RSS 2.0'); ?>-Futter.
						
						<?php if (('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
							// Both Comments and Pings are open ?>
							Du willst mitereden? Dann schreibe einen gew&ouml;hnlichen <a href="#respond">Kommentar</a> oder w&uuml;rdige uns mit einem <a href="<?php trackback_url(); ?>" rel="trackback">R&uuml;ckverweis</a> in deinem Blog.
						
						<?php } elseif (!('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
							// Only Pings are Open ?>
							Kommentare sind derzeit geschlossen, Du kannst dennoch einen <a href="<?php trackback_url(); ?> " rel="trackback">R&uuml;ckverweis</a> in deinem Blog setzen.
						
						<?php } elseif (('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
							// Comments are open, Pings are not ?>
							Du kannst zum Ende springen und einen Kommentar hinterlassen. Pingen ist im Augenblick nicht erlaubt.
			
						<?php } elseif (!('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
							// Neither Comments, nor Pings are open ?>
							Kommentare und Pings sind derzeit nicht am Start.			
						
						<?php } edit_post_link('Beitrag bearbeiten.','<strong>|</strong> ',''); ?>
						
					</small>
				</p>
	
			</div>
		</div>
		
	<?php comments_template(); ?>
	
	<?php endwhile; else: ?>
	
		<p>Es gibt leider keine Beitr&auml;ge, die deinen Kriterien entsprechen.</p>
	
<?php endif; ?>
	
	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
