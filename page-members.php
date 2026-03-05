<?php
/**
 * Template Name: メンバー紹介ページ
 *
 * メンバー紹介ページ用のテンプレート
 *
 * @package Ishi_Kai_Theme
 */

get_header();
?>

<main id="main" class="site-main page-members">
    <div class="container">
        <?php ishikai_breadcrumb(); ?>

        <article class="page-content">
            <header class="page-header">
                <h1 class="page-title">メンバー紹介</h1>
                <p class="page-subtitle">Members</p>
            </header>

            <section class="members-grid">
                <!-- もろきゅう -->
                <div class="member-card">
                    <div class="member-photo">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Gemini_Generated_Image_lw63aglw63aglw63.png" alt="もろきゅう" loading="lazy">
                    </div>
                    <div class="member-info">
                        <h2 class="member-name">もろきゅう</h2>
                        <p class="member-role">AI開発</p>
                        <p class="member-bio">
                            一橋大学商学部卒業後、アクセンチュアを経てフリーライターとして200名超の経営者を取材。2023年、千葉市にてHarmonic Society株式会社を設立。AI業務改善・Web制作・DX推進など中小企業のデジタル活用を支援する。現在はちば経済産業新聞（千葉日報デジタル発行）の編集長として、千葉県内の中小企業に特化した経済・産業情報の発信にも携わる。「戦略×現場」の視点で企業の課題解決に取り組む。
                        </p>
                    </div>
                </div>

                <!-- しば -->
                <div class="member-card">
                    <div class="member-photo">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Gemini_Generated_Image_otsi18otsi18otsi.png" alt="しば" loading="lazy">
                    </div>
                    <div class="member-info">
                        <h2 class="member-name">しば</h2>
                        <p class="member-role">クリエイター</p>
                        <p class="member-bio">
                            慶應義塾大学卒業後、金融機関、マスコミにてオウンドメディアの企画・編集を経て、フリーランスとして独立。経営者への取材などを行う。現在はコミュニティマネージャーやファシリテーターとしても活動。
                        </p>
                    </div>
                </div>

                <!-- ゆきこ -->
                <div class="member-card">
                    <div class="member-photo">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/TOP_別ページ.jpg" alt="ゆきこ" loading="lazy">
                    </div>
                    <div class="member-info">
                        <h2 class="member-name">ゆきこ</h2>
                        <p class="member-role">地域繋がり✖️あったか 手描きデザイナー</p>
                        <p class="member-bio">
                            東海大学卒業後、ゲーム会社でデザイナーを経験。飲食関連でアルバイトしながらフリーランスとしてスタート。絵本風の手描きイラストで、地域社会問題と人をつなぎ、調和・事業拡大へと導きます。
                        </p>
                    </div>
                </div>
            </section>
        </article>
    </div>
</main>

<?php
get_footer();
