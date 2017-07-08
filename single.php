<?php get_header(); ?>

<?php while ( have_posts() ): the_post(); ?>

  <main id="main" class="main-single">

    <article id="post-<?php the_ID(); ?>" <?php post_class( 'main-inner' ); ?>>

      <?php get_template_part( 'parts/title-box' ); ?>

      <div class="container-outer">

        <div class="container">

          <div class="content">

            <div class="content-inner">

              <div class="content-inside">

                <footer class="post-meta content-box">
                  <?php if ( has_post_format() ): ?><span class="post-format"><?php echo esc_html( get_post_format() ); ?></span><?php endif; ?>
                  <?php if ( get_the_modified_time('c') != get_the_time('c') && cd_is_meta_modified() ): ?>
                    <?php if ( cd_is_meta_date() ): ?> <span class="post-date"><?php the_date(); ?></span><?php endif; ?>
                    <time class="post-modified" datetime="<?php the_modified_time('c'); ?>"><?php the_modified_date(); ?></time>
                  <?php endif; ?>
                  <?php if ( get_the_modified_time('c') == get_the_time('c') && cd_is_meta_date() ): ?>
                    <time class="post-date" datetime="<?php get_the_date('c'); ?>"><?php the_date(); ?></time>
                  <?php endif; ?>
                  <?php if ( cd_is_meta_cat() ): ?><p class="post-category"><?php the_category(' / '); ?> </p><?php endif; ?>
                  <?php if ( cd_is_meta_author() ): ?><span class="post-author"><?php the_author_posts_link(); ?></span><?php endif; ?>
                  <?php if ( cd_is_meta_com() && comments_open() && cd_is_post_single_comment() ): ?><span class="post-comment"><?php comments_popup_link('0', '1', '%'); ?></span><?php endif; ?>
                </footer>


                <div class="entry content-box">
                  <div class="entry-inner"><?php the_content(); ?></div>
                  <?php wp_link_pages( $defaults = array( 'before' => '<div class="post-pages">', 'after'=> '</div>', 'link_before' => '<span class="page-number">', 'link_after' => '</span>' ) ); ?>
                  <div class="btm-post-meta">
                    <?php if ( cd_is_meta_btm_cat() ): ?><p class="post-btm-cats"><span class="meta-label"><?php esc_html_e( 'Categories:', 'coldbox' ) ?></span><?php the_category('&#8203;'); ?> </p><?php endif; ?>
                    <?php if ( cd_is_meta_btm_tag() ): ?><?php the_tags( '<p class="post-btm-tags"> <span class="meta-label">' . __( 'Tags:', 'coldbox' ) . '</span>','',' </p>'); ?><?php endif; ?>
                  </div>
                  <?php if ( cd_is_author_box() ): ?><?php get_template_part( 'parts/author-box' ); ?><?php endif; ?>
                </div>


                <?php cd_single_bottom_contents(); // Call the bottom parts ?>

              </div><!--/.content-inside-->

            </div><!--/.content-inner-->

          </div><!--/.content-->

          <?php get_sidebar(); ?>

        </div><!--/.container-->

      </div><!--/.container-outer-->

    </article>

  </main>

<?php endwhile; ?>

<?php get_footer(); ?>
