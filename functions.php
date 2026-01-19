<?php
/**
 * Ishi-kai Theme Functions
 *
 * @package Ishi_Kai_Theme
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

// デバッグ: functions.phpが読み込まれているか確認
add_action('admin_notices', function() {
    echo '<div class="notice notice-success"><p><strong>Ishi-kai Theme:</strong> functions.php v1.1 が正常に読み込まれています</p></div>';
});

/**
 * Theme Setup
 */
function ishikai_theme_setup() {
    // タイトルタグのサポート
    add_theme_support('title-tag');

    // アイキャッチ画像のサポート
    add_theme_support('post-thumbnails');

    // カスタムロゴのサポート
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 300,
        'flex-height' => true,
        'flex-width'  => true,
    ));

    // HTML5マークアップのサポート
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));

    // カスタム背景のサポート
    add_theme_support('custom-background', array(
        'default-color' => 'f8f6f3',
    ));

    // エディタースタイルのサポート
    add_theme_support('editor-styles');
    add_editor_style('assets/css/editor-style.css');

    // レスポンシブ埋め込みのサポート
    add_theme_support('responsive-embeds');

    // ブロックエディタースタイルのサポート
    add_theme_support('wp-block-styles');

    // アラインメントワイド/フルのサポート
    add_theme_support('align-wide');

    // ナビゲーションメニューの登録
    register_nav_menus(array(
        'primary'   => __('メインメニュー', 'ishi-kai-theme'),
        'footer'    => __('フッターメニュー', 'ishi-kai-theme'),
    ));

    // テキストドメインの読み込み
    load_theme_textdomain('ishi-kai-theme', get_template_directory() . '/languages');
}
add_action('after_setup_theme', 'ishikai_theme_setup');

/**
 * コンテンツ幅の設定
 */
function ishikai_content_width() {
    $GLOBALS['content_width'] = apply_filters('ishikai_content_width', 1200);
}
add_action('after_setup_theme', 'ishikai_content_width', 0);

/**
 * スタイルとスクリプトの読み込み
 */
function ishikai_enqueue_scripts() {
    // Google Fonts - Noto Sans JP & Noto Serif JP
    wp_enqueue_style(
        'ishikai-google-fonts',
        'https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700&family=Noto+Serif+JP:wght@400;600;700&display=swap',
        array(),
        null
    );

    // メインスタイルシート
    wp_enqueue_style(
        'ishikai-main-style',
        get_template_directory_uri() . '/assets/css/main.css',
        array('ishikai-google-fonts'),
        filemtime(get_template_directory() . '/assets/css/main.css')
    );

    // テーマスタイルシート
    wp_enqueue_style(
        'ishikai-style',
        get_stylesheet_uri(),
        array('ishikai-main-style'),
        filemtime(get_stylesheet_directory() . '/style.css')
    );

    // メインJavaScript
    wp_enqueue_script(
        'ishikai-main-script',
        get_template_directory_uri() . '/assets/js/main.js',
        array(),
        filemtime(get_template_directory() . '/assets/js/main.js'),
        true
    );

    // コメント返信スクリプト
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'ishikai_enqueue_scripts');

/**
 * カスタム投稿タイプの登録
 */
function ishikai_register_post_types() {
    // イベント投稿タイプ
    register_post_type('event', array(
        'labels' => array(
            'name'               => __('イベント', 'ishi-kai-theme'),
            'singular_name'      => __('イベント', 'ishi-kai-theme'),
            'add_new'            => __('新規追加', 'ishi-kai-theme'),
            'add_new_item'       => __('新規イベントを追加', 'ishi-kai-theme'),
            'edit_item'          => __('イベントを編集', 'ishi-kai-theme'),
            'new_item'           => __('新規イベント', 'ishi-kai-theme'),
            'view_item'          => __('イベントを表示', 'ishi-kai-theme'),
            'search_items'       => __('イベントを検索', 'ishi-kai-theme'),
            'not_found'          => __('イベントが見つかりませんでした', 'ishi-kai-theme'),
            'not_found_in_trash' => __('ゴミ箱にイベントはありません', 'ishi-kai-theme'),
            'all_items'          => __('すべてのイベント', 'ishi-kai-theme'),
            'menu_name'          => __('イベント', 'ishi-kai-theme'),
        ),
        'public'              => true,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_rest'        => true,
        'query_var'           => true,
        'rewrite'             => array('slug' => 'event'),
        'capability_type'     => 'post',
        'has_archive'         => true,
        'hierarchical'        => false,
        'menu_position'       => 5,
        'menu_icon'           => 'dashicons-calendar-alt',
        'supports'            => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
    ));

    // お知らせ投稿タイプ
    register_post_type('news', array(
        'labels' => array(
            'name'               => __('お知らせ', 'ishi-kai-theme'),
            'singular_name'      => __('お知らせ', 'ishi-kai-theme'),
            'add_new'            => __('新規追加', 'ishi-kai-theme'),
            'add_new_item'       => __('新規お知らせを追加', 'ishi-kai-theme'),
            'edit_item'          => __('お知らせを編集', 'ishi-kai-theme'),
            'new_item'           => __('新規お知らせ', 'ishi-kai-theme'),
            'view_item'          => __('お知らせを表示', 'ishi-kai-theme'),
            'search_items'       => __('お知らせを検索', 'ishi-kai-theme'),
            'not_found'          => __('お知らせが見つかりませんでした', 'ishi-kai-theme'),
            'not_found_in_trash' => __('ゴミ箱にお知らせはありません', 'ishi-kai-theme'),
            'all_items'          => __('すべてのお知らせ', 'ishi-kai-theme'),
            'menu_name'          => __('お知らせ', 'ishi-kai-theme'),
        ),
        'public'              => true,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_rest'        => true,
        'query_var'           => true,
        'rewrite'             => array('slug' => 'news'),
        'capability_type'     => 'post',
        'has_archive'         => true,
        'hierarchical'        => false,
        'menu_position'       => 6,
        'menu_icon'           => 'dashicons-megaphone',
        'supports'            => array('title', 'editor', 'thumbnail', 'excerpt'),
    ));
}
add_action('init', 'ishikai_register_post_types');

/**
 * ウィジェットエリアの登録
 */
function ishikai_widgets_init() {
    register_sidebar(array(
        'name'          => __('サイドバー', 'ishi-kai-theme'),
        'id'            => 'sidebar-1',
        'description'   => __('メインサイドバーに表示されるウィジェット', 'ishi-kai-theme'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => __('フッター1', 'ishi-kai-theme'),
        'id'            => 'footer-1',
        'description'   => __('フッター左側に表示されるウィジェット', 'ishi-kai-theme'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));

    register_sidebar(array(
        'name'          => __('フッター2', 'ishi-kai-theme'),
        'id'            => 'footer-2',
        'description'   => __('フッター中央に表示されるウィジェット', 'ishi-kai-theme'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));

    register_sidebar(array(
        'name'          => __('フッター3', 'ishi-kai-theme'),
        'id'            => 'footer-3',
        'description'   => __('フッター右側に表示されるウィジェット', 'ishi-kai-theme'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'ishikai_widgets_init');

/**
 * 抜粋の長さを変更
 */
function ishikai_excerpt_length($length) {
    return 80;
}
add_filter('excerpt_length', 'ishikai_excerpt_length');

/**
 * 抜粋の省略記号を変更
 */
function ishikai_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'ishikai_excerpt_more');

/**
 * カスタムページネーション
 */
function ishikai_pagination() {
    global $wp_query;

    $big = 999999999;

    $pages = paginate_links(array(
        'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
        'format'    => '?paged=%#%',
        'current'   => max(1, get_query_var('paged')),
        'total'     => $wp_query->max_num_pages,
        'type'      => 'array',
        'prev_text' => '&laquo; 前へ',
        'next_text' => '次へ &raquo;',
    ));

    if (is_array($pages)) {
        echo '<nav class="pagination" role="navigation" aria-label="ページナビゲーション">';
        echo '<ul class="pagination-list">';
        foreach ($pages as $page) {
            echo '<li class="pagination-item">' . $page . '</li>';
        }
        echo '</ul>';
        echo '</nav>';
    }
}

/**
 * 投稿日時のフォーマット
 */
function ishikai_posted_on() {
    $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';

    $time_string = sprintf(
        $time_string,
        esc_attr(get_the_date(DATE_W3C)),
        esc_html(get_the_date())
    );

    echo '<span class="posted-on">' . $time_string . '</span>';
}

/**
 * カテゴリーリストの出力
 */
function ishikai_entry_categories() {
    $categories_list = get_the_category_list(', ');
    if ($categories_list) {
        echo '<span class="cat-links">' . $categories_list . '</span>';
    }
}

/**
 * カスタマイザー設定
 */
add_action('customize_register', function($wp_customize) {
    // ヒーローセクション
    $wp_customize->add_section('ishikai_hero', array(
        'title'    => 'ヒーロー設定',
        'priority' => 20,
    ));

    // ヒーロー画像
    $wp_customize->add_setting('ishikai_hero_image', array(
        'default' => '',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'ishikai_hero_image_control', array(
        'label'   => 'ヒーロー画像',
        'section' => 'ishikai_hero',
        'settings' => 'ishikai_hero_image',
    )));

    // ヒーロータイトル
    $wp_customize->add_setting('ishikai_hero_title', array(
        'default' => '',
    ));

    $wp_customize->add_control('ishikai_hero_title_control', array(
        'label'   => 'ヒーロータイトル',
        'section' => 'ishikai_hero',
        'settings' => 'ishikai_hero_title',
        'type'    => 'text',
    ));

    // ヒーローサブタイトル
    $wp_customize->add_setting('ishikai_hero_subtitle', array(
        'default' => '',
    ));

    $wp_customize->add_control('ishikai_hero_subtitle_control', array(
        'label'   => 'ヒーローサブタイトル',
        'section' => 'ishikai_hero',
        'settings' => 'ishikai_hero_subtitle',
        'type'    => 'textarea',
    ));

    // ===========================================
    // 団体情報セクション
    // ===========================================
    $wp_customize->add_section('ishikai_org_info', array(
        'title'    => '団体情報',
        'priority' => 25,
    ));

    // 設立年
    $wp_customize->add_setting('ishikai_org_established', array(
        'default' => '',
    ));

    $wp_customize->add_control('ishikai_org_established_control', array(
        'label'    => '設立',
        'section'  => 'ishikai_org_info',
        'settings' => 'ishikai_org_established',
        'type'     => 'text',
    ));

    // 代表者名
    $wp_customize->add_setting('ishikai_org_representative', array(
        'default' => '',
    ));

    $wp_customize->add_control('ishikai_org_representative_control', array(
        'label'    => '代表',
        'section'  => 'ishikai_org_info',
        'settings' => 'ishikai_org_representative',
        'type'     => 'text',
    ));

    // 所在地
    $wp_customize->add_setting('ishikai_org_address', array(
        'default' => '',
    ));

    $wp_customize->add_control('ishikai_org_address_control', array(
        'label'    => '所在地',
        'section'  => 'ishikai_org_info',
        'settings' => 'ishikai_org_address',
        'type'     => 'textarea',
    ));

    // 連絡先
    $wp_customize->add_setting('ishikai_org_contact', array(
        'default' => '',
    ));

    $wp_customize->add_control('ishikai_org_contact_control', array(
        'label'    => '連絡先',
        'section'  => 'ishikai_org_info',
        'settings' => 'ishikai_org_contact',
        'type'     => 'textarea',
    ));
});

/**
 * パンくずリストの出力
 */
function ishikai_breadcrumb() {
    if (is_front_page()) {
        return;
    }

    echo '<nav class="breadcrumb" aria-label="パンくずリスト">';
    echo '<ol class="breadcrumb-list">';
    echo '<li class="breadcrumb-item"><a href="' . esc_url(home_url('/')) . '">ホーム</a></li>';

    if (is_singular('event')) {
        echo '<li class="breadcrumb-item"><a href="' . esc_url(get_post_type_archive_link('event')) . '">イベント</a></li>';
        echo '<li class="breadcrumb-item current" aria-current="page">' . esc_html(get_the_title()) . '</li>';
    } elseif (is_singular('news')) {
        echo '<li class="breadcrumb-item"><a href="' . esc_url(get_post_type_archive_link('news')) . '">お知らせ</a></li>';
        echo '<li class="breadcrumb-item current" aria-current="page">' . esc_html(get_the_title()) . '</li>';
    } elseif (is_single()) {
        $categories = get_the_category();
        if (!empty($categories)) {
            echo '<li class="breadcrumb-item"><a href="' . esc_url(get_category_link($categories[0]->term_id)) . '">' . esc_html($categories[0]->name) . '</a></li>';
        }
        echo '<li class="breadcrumb-item current" aria-current="page">' . esc_html(get_the_title()) . '</li>';
    } elseif (is_page()) {
        global $post;
        if ($post->post_parent) {
            $ancestors = get_post_ancestors($post->ID);
            $ancestors = array_reverse($ancestors);
            foreach ($ancestors as $ancestor) {
                echo '<li class="breadcrumb-item"><a href="' . esc_url(get_permalink($ancestor)) . '">' . esc_html(get_the_title($ancestor)) . '</a></li>';
            }
        }
        echo '<li class="breadcrumb-item current" aria-current="page">' . esc_html(get_the_title()) . '</li>';
    } elseif (is_post_type_archive('event')) {
        echo '<li class="breadcrumb-item current" aria-current="page">イベント</li>';
    } elseif (is_post_type_archive('news')) {
        echo '<li class="breadcrumb-item current" aria-current="page">お知らせ</li>';
    } elseif (is_category()) {
        echo '<li class="breadcrumb-item current" aria-current="page">' . esc_html(single_cat_title('', false)) . '</li>';
    } elseif (is_archive()) {
        echo '<li class="breadcrumb-item current" aria-current="page">' . esc_html(get_the_archive_title()) . '</li>';
    } elseif (is_search()) {
        echo '<li class="breadcrumb-item current" aria-current="page">検索結果: ' . esc_html(get_search_query()) . '</li>';
    } elseif (is_404()) {
        echo '<li class="breadcrumb-item current" aria-current="page">ページが見つかりません</li>';
    }

    echo '</ol>';
    echo '</nav>';
}
