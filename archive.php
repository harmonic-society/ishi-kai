<?php
/**
 * アーカイブ一覧テンプレート
 *
 * @package Ishi_Kai_Theme
 */

get_header();
?>

<main id="main" class="site-main">
    <div class="container">
        <?php ishikai_breadcrumb(); ?>

        <?php if (have_posts()) : ?>
            <header class="page-header">
                <?php
                the_archive_title('<h1 class="page-title">', '</h1>');
                the_archive_description('<div class="archive-description">', '</div>');
                ?>
            </header>

            <div class="content-with-sidebar">
                <div class="main-content">
                    <div class="posts-grid">
                        <?php while (have_posts()) : the_post(); ?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class('post-card'); ?>>
                                <?php if (has_post_thumbnail()) : ?>
                                    <a href="<?php the_permalink(); ?>" class="post-card-thumbnail">
                                        <?php the_post_thumbnail('medium_large'); ?>
                                    </a>
                                <?php endif; ?>

                                <div class="post-card-content">
                                    <header class="post-card-header">
                                        <h2 class="post-card-title">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h2>
                                        <div class="post-card-meta">
                                            <?php ishikai_posted_on(); ?>
                                            <?php ishikai_entry_categories(); ?>
                                        </div>
                                    </header>

                                    <div class="post-card-excerpt">
                                        <?php the_excerpt(); ?>
                                    </div>

                                    <footer class="post-card-footer">
                                        <a href="<?php the_permalink(); ?>" class="btn btn-outline">続きを読む</a>
                                    </footer>
                                </div>
                            </article>
                        <?php endwhile; ?>
                    </div>

                    <?php ishikai_pagination(); ?>
                </div>

                <?php get_sidebar(); ?>
            </div>

        <?php else : ?>
            <div class="no-results">
                <h1 class="page-title">コンテンツが見つかりません</h1>
                <p>お探しのコンテンツは見つかりませんでした。</p>
                <?php get_search_form(); ?>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php
get_footer();
