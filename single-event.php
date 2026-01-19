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
            <?php
            // カスタムフィールドの取得
            $event_datetime = get_post_meta(get_the_ID(), 'event_datetime', true);
            $event_location = get_post_meta(get_the_ID(), 'event_location', true);
            $event_summary = get_post_meta(get_the_ID(), 'event_summary', true);
            $event_schedule = get_post_meta(get_the_ID(), 'event_schedule', true);
            $event_target = get_post_meta(get_the_ID(), 'event_target', true);
            $event_fee = get_post_meta(get_the_ID(), 'event_fee', true);
            $event_capacity = get_post_meta(get_the_ID(), 'event_capacity', true);
            $event_registration = get_post_meta(get_the_ID(), 'event_registration', true);
            $event_organizer = get_post_meta(get_the_ID(), 'event_organizer', true);
            $event_contact = get_post_meta(get_the_ID(), 'event_contact', true);
            $event_notes = get_post_meta(get_the_ID(), 'event_notes', true);
            ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class('single-event'); ?>>
                <header class="entry-header">
                    <div class="entry-meta-top">
                        <span class="post-type-label">イベント</span>
                        <?php if ($event_datetime) : ?>
                            <span class="event-datetime-badge"><?php echo esc_html($event_datetime); ?></span>
                        <?php endif; ?>
                    </div>
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                </header>

                <?php if (has_post_thumbnail()) : ?>
                    <div class="entry-thumbnail">
                        <?php the_post_thumbnail('large'); ?>
                    </div>
                <?php endif; ?>

                <!-- イベント基本情報 -->
                <div class="event-details-box">
                    <h2 class="event-details-title">イベント情報</h2>
                    <dl class="event-details-list">
                        <?php if ($event_datetime) : ?>
                        <div class="event-detail-item">
                            <dt>日時</dt>
                            <dd><?php echo nl2br(esc_html($event_datetime)); ?></dd>
                        </div>
                        <?php endif; ?>

                        <?php if ($event_location) : ?>
                        <div class="event-detail-item">
                            <dt>場所</dt>
                            <dd><?php echo nl2br(esc_html($event_location)); ?></dd>
                        </div>
                        <?php endif; ?>

                        <?php if ($event_fee) : ?>
                        <div class="event-detail-item">
                            <dt>参加費</dt>
                            <dd><?php echo nl2br(esc_html($event_fee)); ?></dd>
                        </div>
                        <?php endif; ?>

                        <?php if ($event_capacity) : ?>
                        <div class="event-detail-item">
                            <dt>定員</dt>
                            <dd><?php echo esc_html($event_capacity); ?></dd>
                        </div>
                        <?php endif; ?>

                        <?php if ($event_organizer) : ?>
                        <div class="event-detail-item">
                            <dt>主催</dt>
                            <dd><?php echo esc_html($event_organizer); ?></dd>
                        </div>
                        <?php endif; ?>
                    </dl>
                </div>

                <!-- 概要 -->
                <?php if ($event_summary) : ?>
                <div class="event-section">
                    <h2 class="event-section-title">概要</h2>
                    <div class="event-section-content">
                        <?php echo nl2br(esc_html($event_summary)); ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- 対象者 -->
                <?php if ($event_target) : ?>
                <div class="event-section">
                    <h2 class="event-section-title">こんな方におすすめ</h2>
                    <div class="event-section-content">
                        <?php echo nl2br(esc_html($event_target)); ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- 当日の流れ -->
                <?php if ($event_schedule) : ?>
                <div class="event-section">
                    <h2 class="event-section-title">当日の流れ</h2>
                    <div class="event-section-content">
                        <?php echo nl2br(esc_html($event_schedule)); ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- 投稿本文 -->
                <?php if (get_the_content()) : ?>
                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
                <?php endif; ?>

                <!-- 申込方法 -->
                <?php if ($event_registration) : ?>
                <div class="event-section event-registration-section">
                    <h2 class="event-section-title">お申し込み</h2>
                    <div class="event-section-content">
                        <?php echo nl2br(esc_html($event_registration)); ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- 注意事項 -->
                <?php if ($event_notes) : ?>
                <div class="event-section event-notes-section">
                    <h2 class="event-section-title">注意事項</h2>
                    <div class="event-section-content">
                        <?php echo nl2br(esc_html($event_notes)); ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- 問い合わせ先 -->
                <?php if ($event_contact) : ?>
                <div class="event-section event-contact-section">
                    <h2 class="event-section-title">お問い合わせ</h2>
                    <div class="event-section-content">
                        <?php echo nl2br(esc_html($event_contact)); ?>
                    </div>
                </div>
                <?php endif; ?>

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
