<?php
/**
 * 投稿詳細テンプレート
 *
 * @package Ishi_Kai_Theme
 */

get_header();
?>

<main id="main" class="site-main">
    <div class="container">
        <?php ishikai_breadcrumb(); ?>

        <div class="content-with-sidebar">
            <div class="main-content">
                <?php while (have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
                        <header class="entry-header">
                            <h1 class="entry-title"><?php the_title(); ?></h1>
                            <div class="entry-meta">
                                <?php ishikai_posted_on(); ?>
                                <?php ishikai_entry_categories(); ?>
                            </div>
                        </header>

                        <?php if (has_post_thumbnail()) : ?>
                            <div class="entry-thumbnail">
                                <?php the_post_thumbnail('large'); ?>
                            </div>
                        <?php endif; ?>

                        <div class="entry-content">
                            <?php
                            the_content();

                            wp_link_pages(array(
                                'before' => '<div class="page-links">' . __('ページ:', 'ishi-kai-theme'),
                                'after'  => '</div>',
                            ));
                            ?>
                        </div>

                        <footer class="entry-footer">
                            <?php
                            $tags_list = get_the_tag_list('', ', ');
                            if ($tags_list) :
                            ?>
                                <div class="tags-links">
                                    <span class="tags-label">タグ:</span>
                                    <?php echo $tags_list; ?>
                                </div>
                            <?php endif; ?>

                            <?php if (get_edit_post_link()) : ?>
                                <?php
                                edit_post_link(
                                    sprintf(
                                        wp_kses(
                                            __('編集 <span class="sr-only">%s</span>', 'ishi-kai-theme'),
                                            array('span' => array('class' => array()))
                                        ),
                                        get_the_title()
                                    ),
                                    '<span class="edit-link">',
                                    '</span>'
                                );
                                ?>
                            <?php endif; ?>
                        </footer>
                    </article>

                    <!-- 投稿ナビゲーション -->
                    <nav class="post-navigation" aria-label="投稿ナビゲーション">
                        <div class="nav-links">
                            <?php
                            $prev_post = get_previous_post();
                            $next_post = get_next_post();
                            ?>

                            <?php if ($prev_post) : ?>
                                <div class="nav-previous">
                                    <span class="nav-subtitle">前の記事</span>
                                    <a href="<?php echo esc_url(get_permalink($prev_post)); ?>" rel="prev">
                                        <?php echo esc_html($prev_post->post_title); ?>
                                    </a>
                                </div>
                            <?php endif; ?>

                            <?php if ($next_post) : ?>
                                <div class="nav-next">
                                    <span class="nav-subtitle">次の記事</span>
                                    <a href="<?php echo esc_url(get_permalink($next_post)); ?>" rel="next">
                                        <?php echo esc_html($next_post->post_title); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </nav>

                    <?php
                    if (comments_open() || get_comments_number()) :
                        comments_template();
                    endif;
                    ?>
                <?php endwhile; ?>
            </div>

            <?php get_sidebar(); ?>
        </div>
    </div>
</main>

<?php
get_footer();
