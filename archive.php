<?php
/**
 * アーカイブ一覧テンプレート（ブログ）
 *
 * @package Ishi_Kai_Theme
 */

get_header();
?>

<main id="main" class="site-main archive-blog">
    <div class="container">
        <?php ishikai_breadcrumb(); ?>

        <?php if (have_posts()) : ?>
            <header class="page-header">
                <?php
                the_archive_title('<h1 class="page-title">', '</h1>');
                ?>
                <p class="page-subtitle">Blog</p>
                <?php the_archive_description('<div class="page-description">', '</div>'); ?>
            </header>

            <div class="blog-list">
                <?php while (have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('blog-card'); ?>>
                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>" class="blog-card-thumbnail">
                                <?php the_post_thumbnail('large'); ?>
                            </a>
                        <?php endif; ?>

                        <div class="blog-card-body">
                            <div class="blog-card-meta">
                                <time class="blog-card-date" datetime="<?php echo esc_attr(get_the_date(DATE_W3C)); ?>">
                                    <?php echo esc_html(get_the_date('Y.m.d')); ?>
                                </time>
                                <?php
                                $categories = get_the_category();
                                if ($categories) :
                                    foreach ($categories as $category) :
                                ?>
                                    <span class="blog-card-category"><?php echo esc_html($category->name); ?></span>
                                <?php
                                    endforeach;
                                endif;
                                ?>
                            </div>

                            <h2 class="blog-card-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>

                            <div class="blog-card-excerpt">
                                <?php echo wp_trim_words(get_the_excerpt(), 80, '...'); ?>
                            </div>

                            <a href="<?php the_permalink(); ?>" class="blog-card-link">
                                続きを読む
                                <span class="arrow">→</span>
                            </a>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>

            <?php ishikai_pagination(); ?>

        <?php else : ?>
            <div class="no-results">
                <h1 class="page-title">記事が見つかりません</h1>
                <p>お探しの記事は見つかりませんでした。</p>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">ホームに戻る</a>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php
get_footer();
