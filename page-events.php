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
            $today = date('Y-m-d\TH:i');
            $upcoming_events = new WP_Query(array(
                'post_type'      => 'event',
                'posts_per_page' => -1,
                'meta_key'       => 'event_datetime_start',
                'orderby'        => 'meta_value',
                'order'          => 'ASC',
                'meta_query'     => array(
                    array(
                        'key'     => 'event_datetime_start',
                        'value'   => $today,
                        'compare' => '>=',
                        'type'    => 'DATETIME',
                    ),
                ),
            ));

            if ($upcoming_events->have_posts()) :
            ?>
                <div class="events-grid">
                    <?php while ($upcoming_events->have_posts()) : $upcoming_events->the_post();
                        // カスタムフィールドの取得
                        $event_datetime_start = get_post_meta(get_the_ID(), 'event_datetime_start', true);
                        $event_datetime_end = get_post_meta(get_the_ID(), 'event_datetime_end', true);
                        $event_location = get_post_meta(get_the_ID(), 'event_location', true);
                        $event_fee = get_post_meta(get_the_ID(), 'event_fee', true);

                        // 日時を日本語形式にフォーマット
                        $event_datetime_display = '';
                        $datetime_attr = '';
                        if ($event_datetime_start) {
                            $weekdays = array('日', '月', '火', '水', '木', '金', '土');
                            $start_timestamp = strtotime($event_datetime_start);
                            $start_weekday = $weekdays[date('w', $start_timestamp)];
                            $event_datetime_display = date('Y年n月j日', $start_timestamp) . '（' . $start_weekday . '）' . date('H:i', $start_timestamp);
                            $datetime_attr = date('Y-m-d\TH:i', $start_timestamp);

                            if ($event_datetime_end) {
                                $end_timestamp = strtotime($event_datetime_end);
                                if (date('Y-m-d', $start_timestamp) === date('Y-m-d', $end_timestamp)) {
                                    $event_datetime_display .= '〜' . date('H:i', $end_timestamp);
                                } else {
                                    $end_weekday = $weekdays[date('w', $end_timestamp)];
                                    $event_datetime_display .= '〜' . date('Y年n月j日', $end_timestamp) . '（' . $end_weekday . '）' . date('H:i', $end_timestamp);
                                }
                            }
                        }
                    ?>
                        <article class="event-card">
                            <?php if (has_post_thumbnail()) : ?>
                                <a href="<?php the_permalink(); ?>" class="event-card-thumbnail">
                                    <?php the_post_thumbnail('medium_large'); ?>
                                </a>
                            <?php endif; ?>
                            <div class="event-card-content">
                                <?php if ($event_datetime_display) : ?>
                                    <time class="event-card-date" datetime="<?php echo esc_attr($datetime_attr); ?>">
                                        <?php echo esc_html($event_datetime_display); ?>
                                    </time>
                                <?php endif; ?>
                                <h3 class="event-card-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3>
                                <?php if ($event_location) : ?>
                                    <p class="event-card-location">
                                        <span class="dashicons dashicons-location"></span>
                                        <?php echo esc_html(wp_trim_words($event_location, 20, '...')); ?>
                                    </p>
                                <?php endif; ?>
                                <?php if ($event_fee) : ?>
                                    <p class="event-card-fee"><?php echo esc_html($event_fee); ?></p>
                                <?php endif; ?>
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
                'meta_key'       => 'event_datetime_start',
                'orderby'        => 'meta_value',
                'order'          => 'DESC',
                'meta_query'     => array(
                    array(
                        'key'     => 'event_datetime_start',
                        'value'   => $today,
                        'compare' => '<',
                        'type'    => 'DATETIME',
                    ),
                ),
            ));

            if ($past_events->have_posts()) :
            ?>
                <div class="events-list-compact">
                    <?php while ($past_events->have_posts()) : $past_events->the_post();
                        $event_datetime_start = get_post_meta(get_the_ID(), 'event_datetime_start', true);
                        $event_location = get_post_meta(get_the_ID(), 'event_location', true);

                        // 日付フォーマット
                        $date_month = '';
                        $date_day = '';
                        $date_year = '';
                        $datetime_attr = '';
                        if ($event_datetime_start) {
                            $timestamp = strtotime($event_datetime_start);
                            $date_month = date('n月', $timestamp);
                            $date_day = date('j', $timestamp);
                            $date_year = date('Y', $timestamp);
                            $datetime_attr = date('Y-m-d', $timestamp);
                        }
                    ?>
                        <article class="event-item-compact">
                            <?php if ($event_datetime_start) : ?>
                                <time class="event-date" datetime="<?php echo esc_attr($datetime_attr); ?>">
                                    <span class="event-date-month"><?php echo esc_html($date_month); ?></span>
                                    <span class="event-date-day"><?php echo esc_html($date_day); ?></span>
                                    <span class="event-date-year"><?php echo esc_html($date_year); ?></span>
                                </time>
                            <?php endif; ?>
                            <div class="event-info">
                                <h3 class="event-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3>
                                <?php if ($event_location) : ?>
                                    <p class="event-location-compact"><?php echo esc_html(wp_trim_words($event_location, 10, '...')); ?></p>
                                <?php endif; ?>
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
