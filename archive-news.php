<?php
/**
 * お知らせアーカイブテンプレート
 *
 * @package Ishi_Kai_Theme
 */

get_header();
?>

<main id="main" class="site-main archive-news">
    <div class="container">
        <?php ishikai_breadcrumb(); ?>

        <header class="page-header">
            <h1 class="page-title">お知らせ一覧</h1>
            <p class="page-subtitle">News</p>
            <p class="page-description">石井会からのお知らせ一覧です。</p>
        </header>

        <?php if (have_posts()) : ?>
            <div class="news-archive-list">
                <?php while (have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('news-archive-item'); ?>>
                        <time class="news-date" datetime="<?php echo esc_attr(get_the_date(DATE_W3C)); ?>">
                            <span class="news-date-year"><?php echo esc_html(get_the_date('Y')); ?></span>
                            <span class="news-date-month-day"><?php echo esc_html(get_the_date('n/j')); ?></span>
                        </time>
                        <div class="news-content">
                            <h2 class="news-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            <?php if (has_excerpt()) : ?>
                                <div class="news-excerpt">
                                    <?php the_excerpt(); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>

            <?php ishikai_pagination(); ?>

        <?php else : ?>
            <div class="no-results">
                <h2>お知らせが見つかりません</h2>
                <p>現在お知らせはありません。</p>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">ホームに戻る</a>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php
get_footer();
