<?php
/**
 * Inner part of the index pages when selecting standard style
 *
 * @since 1.0.0
 * @package Coldbox
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-inner">

		<figure class="post-thumbnail">
			<?php cd_standard_thumbnail(); ?>
		</figure>

		<div class="post-content">

			<div class="post-header">

				<h2 class="post-title">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h2>

				<p class="post-meta">
					<?php if ( cd_index_meta_date() ) : ?>
						<span class="post-date"><?php echo get_the_date(); ?></span>
					<?php endif; ?>

					<?php if ( 'post' === get_post_type() && cd_index_meta_cat() ) : ?>
						<span class="post-category"><?php the_category( ' / ' ); ?></span>
					<?php endif; ?>

					<?php if ( comments_open() && cd_is_post_single_comment() && cd_index_meta_comment() ) : ?>
						<span class="post-comment"><?php comments_popup_link( '0', '1', '%' ); ?></span>
					<?php endif; ?>
				</p>

				<?php if ( get_the_excerpt() !== '' ) : ?>
					<div class="post-excerpt"><?php the_excerpt(); ?></div>
				<?php endif; ?>

			</div>

			<p class="more"><a href="<?php the_permalink(); ?>"><?php esc_html_e( 'READ MORE', 'coldbox' ); ?><i class="fa"></i></a></p>

		</div>

	</div><!--/.post-inner-->
</article>
