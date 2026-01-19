<?php
/**
 * TOPページテンプレート
 *
 * @package Ishi_Kai_Theme
 */

get_header();
?>

<main id="main" class="site-main front-page">
    <!-- ヒーローセクション -->
    <section class="hero-section">
        <div class="hero-inner container">
            <div class="hero-content">
                <h1 class="hero-title"><?php bloginfo('name'); ?></h1>
                <?php
                $description = get_bloginfo('description', 'display');
                if ($description) :
                ?>
                    <p class="hero-description"><?php echo esc_html($description); ?></p>
                <?php endif; ?>
                <div class="hero-buttons">
                    <a href="<?php echo esc_url(home_url('/about/')); ?>" class="btn btn-primary">団体概要</a>
                    <a href="<?php echo esc_url(home_url('/events/')); ?>" class="btn btn-outline-white">イベント情報</a>
                </div>
            </div>
        </div>
    </section>

    <!-- お知らせセクション -->
    <section class="news-section section">
        <div class="container">
            <header class="section-header">
                <h2 class="section-title">お知らせ</h2>
                <p class="section-subtitle">News</p>
            </header>

            <div class="news-list">
                <?php
                $news_query = new WP_Query(array(
                    'post_type'      => 'news',
                    'posts_per_page' => 5,
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                ));

                if ($news_query->have_posts()) :
                    while ($news_query->have_posts()) : $news_query->the_post();
                ?>
                    <article class="news-item">
                        <time class="news-date" datetime="<?php echo esc_attr(get_the_date(DATE_W3C)); ?>">
                            <?php echo esc_html(get_the_date()); ?>
                        </time>
                        <h3 class="news-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h3>
                    </article>
                <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                ?>
                    <p class="no-posts">お知らせはまだありません。</p>
                <?php endif; ?>
            </div>

            <div class="section-footer">
                <a href="<?php echo esc_url(get_post_type_archive_link('news')); ?>" class="btn btn-outline">お知らせ一覧へ</a>
            </div>
        </div>
    </section>

    <!-- イベントセクション -->
    <section class="events-section section section-alt">
        <div class="container">
            <header class="section-header">
                <h2 class="section-title">イベント情報</h2>
                <p class="section-subtitle">Events</p>
            </header>

            <div class="events-grid">
                <?php
                $events_query = new WP_Query(array(
                    'post_type'      => 'event',
                    'posts_per_page' => 3,
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                ));

                if ($events_query->have_posts()) :
                    while ($events_query->have_posts()) : $events_query->the_post();
                ?>
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
                            <a href="<?php the_permalink(); ?>" class="btn btn-sm btn-outline">詳細を見る</a>
                        </div>
                    </article>
                <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                ?>
                    <p class="no-posts">イベントはまだありません。</p>
                <?php endif; ?>
            </div>

            <div class="section-footer">
                <a href="<?php echo esc_url(get_post_type_archive_link('event')); ?>" class="btn btn-outline">イベント一覧へ</a>
            </div>
        </div>
    </section>

    <!-- ブログセクション -->
    <section class="blog-section section">
        <div class="container">
            <header class="section-header">
                <h2 class="section-title">ブログ</h2>
                <p class="section-subtitle">Blog</p>
            </header>

            <div class="posts-grid">
                <?php
                $blog_query = new WP_Query(array(
                    'post_type'      => 'post',
                    'posts_per_page' => 3,
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                ));

                if ($blog_query->have_posts()) :
                    while ($blog_query->have_posts()) : $blog_query->the_post();
                ?>
                    <article class="post-card">
                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>" class="post-card-thumbnail">
                                <?php the_post_thumbnail('medium_large'); ?>
                            </a>
                        <?php endif; ?>
                        <div class="post-card-content">
                            <header class="post-card-header">
                                <h3 class="post-card-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3>
                                <div class="post-card-meta">
                                    <?php ishikai_posted_on(); ?>
                                </div>
                            </header>
                            <div class="post-card-excerpt">
                                <?php the_excerpt(); ?>
                            </div>
                            <footer class="post-card-footer">
                                <a href="<?php the_permalink(); ?>" class="btn btn-sm btn-outline">続きを読む</a>
                            </footer>
                        </div>
                    </article>
                <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                ?>
                    <p class="no-posts">ブログ記事はまだありません。</p>
                <?php endif; ?>
            </div>

            <div class="section-footer">
                <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" class="btn btn-outline">ブログ一覧へ</a>
            </div>
        </div>
    </section>
</main>

<?php
get_footer();
