<?php
/**
 * イベント詳細テンプレート
 *
 * @package Ishi_Kai_Theme
 */

get_header();
?>

<main id="main" class="site-main">
    <div class="container">
        <?php ishikai_breadcrumb(); ?>

        <?php while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('single-event'); ?>>
                <header class="entry-header">
                    <div class="entry-meta-top">
                        <span class="post-type-label">イベント</span>
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

                <div class="event-details-box">
                    <h2 class="event-details-title">イベント詳細</h2>
                    <dl class="event-details-list">
                        <div class="event-detail-item">
                            <dt>開催日</dt>
                            <dd><?php echo esc_html(get_the_date()); ?></dd>
                        </div>
                        <?php
                        $event_time = get_post_meta(get_the_ID(), 'event_time', true);
                        if ($event_time) :
                        ?>
                            <div class="event-detail-item">
                                <dt>時間</dt>
                                <dd><?php echo esc_html($event_time); ?></dd>
                            </div>
                        <?php endif; ?>

                        <?php
                        $event_location = get_post_meta(get_the_ID(), 'event_location', true);
                        if ($event_location) :
                        ?>
                            <div class="event-detail-item">
                                <dt>場所</dt>
                                <dd><?php echo esc_html($event_location); ?></dd>
                            </div>
                        <?php endif; ?>

                        <?php
                        $event_capacity = get_post_meta(get_the_ID(), 'event_capacity', true);
                        if ($event_capacity) :
                        ?>
                            <div class="event-detail-item">
                                <dt>定員</dt>
                                <dd><?php echo esc_html($event_capacity); ?></dd>
                            </div>
                        <?php endif; ?>

                        <?php
                        $event_fee = get_post_meta(get_the_ID(), 'event_fee', true);
                        if ($event_fee) :
                        ?>
                            <div class="event-detail-item">
                                <dt>参加費</dt>
                                <dd><?php echo esc_html($event_fee); ?></dd>
                            </div>
                        <?php endif; ?>
                    </dl>
                </div>

                <div class="entry-content">
                    <?php the_content(); ?>
                </div>

                <footer class="entry-footer">
                    <div class="event-cta">
                        <p>イベントへの参加をご希望の方は、お問い合わせください。</p>
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

            <!-- イベントナビゲーション -->
            <nav class="post-navigation" aria-label="イベントナビゲーション">
                <div class="nav-links">
                    <?php
                    $prev_post = get_previous_post();
                    $next_post = get_next_post();
                    ?>

                    <?php if ($prev_post) : ?>
                        <div class="nav-previous">
                            <span class="nav-subtitle">前のイベント</span>
                            <a href="<?php echo esc_url(get_permalink($prev_post)); ?>" rel="prev">
                                <?php echo esc_html($prev_post->post_title); ?>
                            </a>
                        </div>
                    <?php endif; ?>

                    <?php if ($next_post) : ?>
                        <div class="nav-next">
                            <span class="nav-subtitle">次のイベント</span>
                            <a href="<?php echo esc_url(get_permalink($next_post)); ?>" rel="next">
                                <?php echo esc_html($next_post->post_title); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </nav>

            <div class="back-to-archive">
                <a href="<?php echo esc_url(get_post_type_archive_link('event')); ?>" class="btn btn-outline">
                    イベント一覧に戻る
                </a>
            </div>
        <?php endwhile; ?>
    </div>
</main>

<?php
get_footer();
