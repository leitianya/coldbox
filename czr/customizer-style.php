<?php
if ( !function_exists ( 'cd_customizer_style' ) ) {
  function cd_customizer_style() {

    // Container Width
    if ( get_theme_mod( 'container_width', '1140' ) != '1140' ) {
      $container_width = get_theme_mod( 'container_width' );
      $czr_container_width = "
      .container {
        max-width: ${container_width}px;
      } ";
      wp_add_inline_style( 'czr', $czr_container_width );
    }

    if ( get_theme_mod( 'global_font_size_pc', '16' ) != '16' ) {
      $font_size_pc = get_theme_mod( 'global_font_size_pc' );
      $czr_font_size_pc = "
      body {
        font-size: ${font_size_pc}px;
      } ";
      wp_add_inline_style( 'czr', $czr_font_size_pc );
    }

    if ( get_theme_mod( 'global_font_size_mobile', '15' ) != '15' ) {
      $font_size_mobile = get_theme_mod( 'global_font_size_pc' );
      $czr_font_size_mobile = "
      @media screen and ( max-width: 767px ) {
        body {
          font-size: ${font_size_mobile}px;
        }
      } ";
      wp_add_inline_style( 'czr', $czr_font_size_mobile );

    }

    // Add decoration
    if ( get_theme_mod( 'decorate_htags', false ) ) {
      $czr_style_htags = "
      .entry h2 { margin-left: -40px; margin-right: -40px; padding: 1.3rem 30px; border-style: solid; border-width: 1px 0; overflow: hidden; }
      @media screen and (max-width: 640px) { .entry h2 { margin-left: -20px; margin-right: -20px; padding-left: 10px; padding-right: 10px; } }
      .entry h3 { margin-left: -10px; margin-right: -10px; padding: 0 5px .4rem; border-bottom: 2px solid rgba(0, 0, 0, .5); overflow: hidden; }
      .entry h4 { padding: 0 0 .4rem; border-bottom: 2px solid #bbb; overflow: hidden; }
      .entry h5 { padding: 0 0 .4rem; border-bottom: 1px dotted #bbb; overflow: hidden; } ";
      wp_add_inline_style( 'czr', $czr_style_htags );
    }


    // Link Color
    if ( get_theme_mod( 'link_color', '#00619f' ) != '#00619f' ) {
      $color_link = get_theme_mod( 'link_color' );
      $czr_color_link = "
      .entry a, .title-box a:hover, .post-meta a:hover, .post-meta.content-box a:hover, .post-btm-tags a:hover, p.post-btm-cats a:hover, .related-posts .post-category a,
      .related-posts .post:hover .post-title, .post-pages, .grid-view .post-inner a:hover .post-title, .standard-view .post-title:hover, ul.page-numbers,
      .widget #wp-calendar a, .widget .widgets-list-layout li:hover a, #comment-list .comment-author .fn a, #respond .logged-in-as a:hover, .comment-pages,
      .comment-pages a,.comment-pages span, .comment-body a, .comment-tabmenu .active > a {
        color: $color_link;
      }
      #comments input[type=submit], .post-tags a, .post-tags a, .main-archive .post-date, .action-bar {
        background-color: $color_link;
      }
      textarea:focus {
        border-color: $color_link;
      }
      .comment-pages > a:hover, .comment-pages span, .post-pages > a:hover>span,.post-pages>span, ul.page-numbers span.page-numbers.current, ul.page-numbers a.page-numbers:hover {
        border-bottom-color: $color_link;
      }
      ::selection { background-color: $color_link; }
      ::moz-selection { background-color: $color_link; }
      ";
      wp_add_inline_style( 'czr', $czr_color_link );
    }


    // Link Hover Color
    if( get_theme_mod( 'link_hover_color', '#0f5373' ) != '#0f5373' ) {
      $color_hover = get_theme_mod( 'link_hover_color' );
      $czr_color_hover = "
      .entry a:hover, .comment-body a:hover, .sidebar #wp-calender a:hover {
        color: $color_hover;
      } ";
      wp_add_inline_style( 'czr', $czr_color_hover );
    }


    // Header Background Color
    if( get_theme_mod( 'header_color', '#ffffff' ) != '#ffffff' ) {
      $color_header = get_theme_mod( 'header_color' );
      $czr_color_header = "
      #header {
        background-color: $color_header;
      } ";
      wp_add_inline_style( 'czr', $czr_color_header );
    }

    // Footer Background Color
    if ( get_theme_mod( 'footer_color', '#44463b' ) != '#44463b' ) {
      $color_footer = get_theme_mod( 'footer_color' );
      $czr_color_footer = "
      #footer {
        background-color: $color_footer;
      } ";
      wp_add_inline_style( 'czr', $czr_color_footer );
    }

    // Related Posts Columns
    if ( get_theme_mod( 'single_related_col', 2 ) != 2 ) {
      $rel_col = get_theme_mod( 'single_related_col' );
      $czr_rel_col = "
      .related-posts .related-article {
        width: calc(100% / $rel_col);
      } ";
      wp_add_inline_style( 'czr', $czr_rel_col );
    }

  }
}
add_action ( 'wp_enqueue_scripts', 'cd_customizer_style' );
