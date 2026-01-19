<?php
/**
 * 404エラーページテンプレート
 *
 * @package Ishi_Kai_Theme
 */

get_header();
?>

<main id="main" class="site-main error-404">
    <div class="container">
        <div class="error-content">
            <div class="error-code">404</div>
            <h1 class="error-title">ページが見つかりません</h1>
            <p class="error-description">
                お探しのページは削除されたか、URLが変更された可能性があります。<br>
                URLが正しく入力されているかご確認ください。
            </p>

            <div class="error-search">
                <p>サイト内検索をお試しください:</p>
                <?php get_search_form(); ?>
            </div>

            <div class="error-links">
                <h2>または以下のページをご覧ください</h2>
                <ul class="error-nav">
                    <li>
                        <a href="<?php echo esc_url(home_url('/')); ?>">
                            ホームに戻る
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo esc_url(home_url('/about/')); ?>">
                            団体概要
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo esc_url(get_post_type_archive_link('event')); ?>">
                            イベント情報
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo esc_url(get_post_type_archive_link('news')); ?>">
                            お知らせ
                        </a>
                    </li>
                </ul>
            </div>

            <div class="error-home-button">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary btn-lg">
                    ホームへ戻る
                </a>
            </div>
        </div>
    </div>
</main>

<?php
get_footer();
