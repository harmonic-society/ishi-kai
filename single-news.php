<?php
/**
 * お知らせ詳細テンプレート
 *
 * @package Ishi_Kai_Theme
 */

get_header();
?>

<main id="main" class="site-main">
    <div class="container">
        <?php ishikai_breadcrumb(); ?>

        <?php while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('single-news'); ?>>
                <header class="entry-header">
                    <div class="entry-meta-top">
                        <span class="post-type-label post-type-news">お知らせ</span>
                        <time class="entry-date" datetime="<?php echo esc_attr(get_the_date(DATE_W3C)); ?>">
                            <?php echo esc_html(get_the_date()); ?>
                        </time>
                    </div>
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                </header>

                <?php if (has_post_thumbnail()) : ?>
                    <div class="entry-thumbnail">
                        <?php the_post_thumbnail('large'); ?>
                    </div>
                <?php endif; ?>

                <div class="entry-content">
                    <?php the_content(); ?>
                </div>

                <footer class="entry-footer">
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

            <!-- お知らせナビゲーション -->
            <nav class="post-navigation" aria-label="お知らせナビゲーション">
                <div class="nav-links">
                    <?php
                    $prev_post = get_previous_post();
                    $next_post = get_next_post();
                    ?>

                    <?php if ($prev_post) : ?>
                        <div class="nav-previous">
                            <span class="nav-subtitle">前のお知らせ</span>
                            <a href="<?php echo esc_url(get_permalink($prev_post)); ?>" rel="prev">
                                <?php echo esc_html($prev_post->post_title); ?>
                            </a>
                        </div>
                    <?php endif; ?>

                    <?php if ($next_post) : ?>
                        <div class="nav-next">
                            <span class="nav-subtitle">次のお知らせ</span>
                            <a href="<?php echo esc_url(get_permalink($next_post)); ?>" rel="next">
                                <?php echo esc_html($next_post->post_title); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </nav>

            <div class="back-to-archive">
                <a href="<?php echo esc_url(get_post_type_archive_link('news')); ?>" class="btn btn-outline">
                    お知らせ一覧に戻る
                </a>
            </div>
        <?php endwhile; ?>
    </div>
</main>

<?php
get_footer();
