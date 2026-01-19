<?php
/**
 * 投稿詳細テンプレート（ブログ）
 *
 * @package Ishi_Kai_Theme
 */

get_header();
?>

<main id="main" class="site-main single-blog">
    <div class="container">
        <?php ishikai_breadcrumb(); ?>

        <?php while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('blog-single'); ?>>
                <header class="blog-single-header">
                    <div class="blog-single-meta">
                        <time class="blog-single-date" datetime="<?php echo esc_attr(get_the_date(DATE_W3C)); ?>">
                            <?php echo esc_html(get_the_date('Y.m.d')); ?>
                        </time>
                        <?php
                        $categories = get_the_category();
                        if ($categories) :
                            foreach ($categories as $category) :
                        ?>
                            <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" class="blog-single-category">
                                <?php echo esc_html($category->name); ?>
                            </a>
                        <?php
                            endforeach;
                        endif;
                        ?>
                    </div>
                    <h1 class="blog-single-title"><?php the_title(); ?></h1>
                </header>

                <?php if (has_post_thumbnail()) : ?>
                    <div class="blog-single-thumbnail">
                        <?php the_post_thumbnail('full'); ?>
                    </div>
                <?php endif; ?>

                <div class="blog-single-content">
                    <?php
                    the_content();

                    wp_link_pages(array(
                        'before' => '<div class="page-links">' . __('ページ:', 'ishi-kai-theme'),
                        'after'  => '</div>',
                    ));
                    ?>
                </div>

                <footer class="blog-single-footer">
                    <?php
                    $tags_list = get_the_tag_list('', '');
                    if ($tags_list) :
                    ?>
                        <div class="blog-single-tags">
                            <span class="tags-icon"><span class="dashicons dashicons-tag"></span></span>
                            <?php echo $tags_list; ?>
                        </div>
                    <?php endif; ?>

                    <div class="blog-single-share">
                        <span class="share-label">この記事をシェア</span>
                        <div class="share-buttons">
                            <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" target="_blank" rel="noopener noreferrer" class="share-btn share-twitter" aria-label="Xでシェア">
                                X
                            </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank" rel="noopener noreferrer" class="share-btn share-facebook" aria-label="Facebookでシェア">
                                Facebook
                            </a>
                            <a href="https://line.me/R/msg/text/?<?php echo urlencode(get_the_title() . ' ' . get_permalink()); ?>" target="_blank" rel="noopener noreferrer" class="share-btn share-line" aria-label="LINEでシェア">
                                LINE
                            </a>
                        </div>
                    </div>

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
            <nav class="blog-navigation" aria-label="投稿ナビゲーション">
                <?php
                $prev_post = get_previous_post();
                $next_post = get_next_post();
                ?>

                <div class="blog-nav-links">
                    <?php if ($prev_post) : ?>
                        <a href="<?php echo esc_url(get_permalink($prev_post)); ?>" class="blog-nav-item blog-nav-prev" rel="prev">
                            <span class="blog-nav-label">前の記事</span>
                            <span class="blog-nav-title"><?php echo esc_html($prev_post->post_title); ?></span>
                        </a>
                    <?php else : ?>
                        <span class="blog-nav-item blog-nav-prev blog-nav-empty"></span>
                    <?php endif; ?>

                    <?php if ($next_post) : ?>
                        <a href="<?php echo esc_url(get_permalink($next_post)); ?>" class="blog-nav-item blog-nav-next" rel="next">
                            <span class="blog-nav-label">次の記事</span>
                            <span class="blog-nav-title"><?php echo esc_html($next_post->post_title); ?></span>
                        </a>
                    <?php else : ?>
                        <span class="blog-nav-item blog-nav-next blog-nav-empty"></span>
                    <?php endif; ?>
                </div>
            </nav>

            <div class="back-to-archive">
                <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" class="btn btn-outline">
                    ブログ一覧に戻る
                </a>
            </div>
        <?php endwhile; ?>
    </div>
</main>

<?php
get_footer();
