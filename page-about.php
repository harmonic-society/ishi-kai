<?php
/**
 * Template Name: 団体概要ページ
 *
 * 団体概要ページ用のテンプレート
 *
 * @package Ishi_Kai_Theme
 */

get_header();
?>

<main id="main" class="site-main page-about">
    <div class="container">
        <?php ishikai_breadcrumb(); ?>

        <?php while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('page-content'); ?>>
                <header class="page-header">
                    <h1 class="page-title"><?php the_title(); ?></h1>
                    <p class="page-subtitle">About Us</p>
                </header>

                <!-- メインビジュアル -->
                <?php if (has_post_thumbnail()) : ?>
                    <div class="about-hero">
                        <?php the_post_thumbnail('full'); ?>
                    </div>
                <?php endif; ?>

                <!-- 団体紹介 -->
                <section class="about-section about-intro">
                    <div class="about-intro-content">
                        <?php the_content(); ?>
                    </div>
                </section>

                <!-- 理念・活動方針 -->
                <section class="about-section about-philosophy">
                    <h2 class="about-section-title">理念・活動方針</h2>
                    <div class="philosophy-grid">
                        <div class="philosophy-item">
                            <div class="philosophy-icon">
                                <span class="dashicons dashicons-heart"></span>
                            </div>
                            <h3>相互理解</h3>
                            <p>会員同士が互いの考えを尊重し、理解を深め合うことを大切にしています。</p>
                        </div>
                        <div class="philosophy-item">
                            <div class="philosophy-icon">
                                <span class="dashicons dashicons-groups"></span>
                            </div>
                            <h3>交流促進</h3>
                            <p>定期的な集まりやイベントを通じて、会員間の絆を深める活動を行っています。</p>
                        </div>
                        <div class="philosophy-item">
                            <div class="philosophy-icon">
                                <span class="dashicons dashicons-megaphone"></span>
                            </div>
                            <h3>情報発信</h3>
                            <p>私たちの活動や考えを広く発信し、社会との対話を大切にしています。</p>
                        </div>
                    </div>
                </section>

                <!-- 団体情報 -->
                <section class="about-section about-info">
                    <h2 class="about-section-title">団体情報</h2>
                    <dl class="info-list">
                        <div class="info-item">
                            <dt>団体名</dt>
                            <dd><?php bloginfo('name'); ?></dd>
                        </div>
                        <div class="info-item">
                            <dt>設立</dt>
                            <dd><!-- 設立年を入力 --></dd>
                        </div>
                        <div class="info-item">
                            <dt>代表</dt>
                            <dd><!-- 代表者名を入力 --></dd>
                        </div>
                        <div class="info-item">
                            <dt>所在地</dt>
                            <dd><!-- 所在地を入力 --></dd>
                        </div>
                        <div class="info-item">
                            <dt>連絡先</dt>
                            <dd><!-- 連絡先を入力 --></dd>
                        </div>
                    </dl>
                </section>

                <?php if (get_edit_post_link()) : ?>
                    <footer class="entry-footer">
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
                    </footer>
                <?php endif; ?>
            </article>
        <?php endwhile; ?>
    </div>
</main>

<?php
get_footer();
