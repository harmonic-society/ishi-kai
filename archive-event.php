<?php
/**
 * イベントアーカイブテンプレート
 *
 * @package Ishi_Kai_Theme
 */

get_header();
?>

<main id="main" class="site-main archive-event">
    <div class="container">
        <?php ishikai_breadcrumb(); ?>

        <header class="page-header">
            <h1 class="page-title">イベント一覧</h1>
            <p class="page-subtitle">Events</p>
            <p class="page-description">石井会で開催されるイベントの一覧です。</p>
        </header>

        <?php if (have_posts()) : ?>
            <div class="events-grid">
                <?php while (have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('event-card'); ?>>
                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>" class="event-card-thumbnail">
                                <?php the_post_thumbnail('medium_large'); ?>
                            </a>
                        <?php endif; ?>

                        <div class="event-card-content">
                            <time class="event-card-date" datetime="<?php echo esc_attr(get_the_date(DATE_W3C)); ?>">
                                <?php echo esc_html(get_the_date()); ?>
                            </time>
                            <h2 class="event-card-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            <div class="event-card-excerpt">
                                <?php the_excerpt(); ?>
                            </div>
                            <a href="<?php the_permalink(); ?>" class="btn btn-sm btn-primary">詳細を見る</a>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>

            <?php ishikai_pagination(); ?>

        <?php else : ?>
            <div class="no-results">
                <h2>イベントが見つかりません</h2>
                <p>現在予定されているイベントはありません。</p>
                <p>新しいイベントが決まり次第、こちらでお知らせします。</p>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">ホームに戻る</a>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php
get_footer();
