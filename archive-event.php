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
                <?php while (have_posts()) : the_post();
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
                    <article id="post-<?php the_ID(); ?>" <?php post_class('event-card'); ?>>
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
                            <h2 class="event-card-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
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
