<?php
/**
 * Template Name: イベント一覧ページ
 *
 * イベント情報ページ用のテンプレート
 *
 * @package Ishi_Kai_Theme
 */

get_header();
?>

<main id="main" class="site-main page-events">
    <div class="container">
        <?php ishikai_breadcrumb(); ?>

        <header class="page-header">
            <h1 class="page-title">イベント情報</h1>
            <p class="page-subtitle">Events</p>
        </header>

        <?php
        // 固定ページのコンテンツがあれば表示
        if (have_posts()) :
            while (have_posts()) : the_post();
                if (get_the_content()) :
        ?>
            <div class="page-intro">
                <?php the_content(); ?>
            </div>
        <?php
                endif;
            endwhile;
        endif;
        ?>

        <!-- 今後のイベント -->
        <section class="events-upcoming">
            <h2 class="events-section-title">今後のイベント</h2>

            <?php
            $upcoming_events = new WP_Query(array(
                'post_type'      => 'event',
                'posts_per_page' => -1,
                'orderby'        => 'date',
                'order'          => 'DESC',
            ));

            if ($upcoming_events->have_posts()) :
            ?>
                <div class="events-grid">
                    <?php while ($upcoming_events->have_posts()) : $upcoming_events->the_post(); ?>
                        <article class="event-card">
                            <?php if (has_post_thumbnail()) : ?>
                                <a href="<?php the_permalink(); ?>" class="event-card-thumbnail">
                                    <?php the_post_thumbnail('medium_large'); ?>
                                </a>
                            <?php endif; ?>
                            <div class="event-card-content">
                                <time class="event-card-date" datetime="<?php echo esc_attr(get_the_date(DATE_W3C)); ?>">
                                    <?php echo esc_html(get_the_date()); ?>
                                </time>
                                <h3 class="event-card-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3>
                                <div class="event-card-excerpt">
                                    <?php the_excerpt(); ?>
                                </div>
                                <a href="<?php the_permalink(); ?>" class="btn btn-sm btn-primary">詳細を見る</a>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>
            <?php
                wp_reset_postdata();
            else :
            ?>
                <div class="no-events">
                    <p>現在予定されているイベントはありません。</p>
                    <p>新しいイベントが決まり次第、こちらでお知らせします。</p>
                </div>
            <?php endif; ?>
        </section>

        <!-- 過去のイベント -->
        <section class="events-past">
            <h2 class="events-section-title">過去のイベント</h2>
            <p class="section-description">過去に開催したイベントの一覧です。</p>

            <?php
            $past_events = new WP_Query(array(
                'post_type'      => 'event',
                'posts_per_page' => 6,
                'orderby'        => 'date',
                'order'          => 'DESC',
                'offset'         => 0,
            ));

            if ($past_events->have_posts()) :
            ?>
                <div class="events-list-compact">
                    <?php while ($past_events->have_posts()) : $past_events->the_post(); ?>
                        <article class="event-item-compact">
                            <time class="event-date" datetime="<?php echo esc_attr(get_the_date(DATE_W3C)); ?>">
                                <span class="event-date-month"><?php echo esc_html(get_the_date('n月')); ?></span>
                                <span class="event-date-day"><?php echo esc_html(get_the_date('j')); ?></span>
                                <span class="event-date-year"><?php echo esc_html(get_the_date('Y')); ?></span>
                            </time>
                            <div class="event-info">
                                <h3 class="event-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>

                <div class="section-footer">
                    <a href="<?php echo esc_url(get_post_type_archive_link('event')); ?>" class="btn btn-outline">すべてのイベントを見る</a>
                </div>
            <?php
                wp_reset_postdata();
            else :
            ?>
                <p class="no-events">過去のイベントはありません。</p>
            <?php endif; ?>
        </section>
    </div>
</main>

<?php
get_footer();
