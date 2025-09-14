<?php
if ( ! defined( 'ABSPATH' ) ) exit;

get_header();
while ( have_posts() ) :
	the_post();

	$SETTING = SWELL_Theme::get_setting();
	$the_id  = get_the_ID();

	// シェアボタンを隠すかどうか
	$show_share_btns = get_post_meta( $the_id, 'swell_meta_hide_sharebtn', true ) !== '1';
?>
<main id="main_content" class="l-mainContent l-article">
	<article class="l-mainContent__inner" data-clarity-region="article">
		<?php
			do_action( 'swell_before_post_head', $the_id );

			// タイトル周り
			if ( ! SWELL_Theme::is_show_ttltop() ) {
				SWELL_Theme::get_parts( 'parts/single/post_head' );
			}

			// 記事上シェアボタン
			if ( $show_share_btns && $SETTING['show_share_btn_top'] ) {
				SWELL_Theme::get_parts( 'parts/single/share_btns', [ 'position' => '-top' ] );
			}

			// 記事上ウィジェット
			SWELL_Theme::outuput_content_widget( 'single', 'top' );
		?>

		<!-- カスタムフィールドで設定した詳細ページ用のトップ画像 -->
		<?php
				$image = get_field('lesson-single-image');

				if ($image) :
				?>

		<div class=" lesson-header-image">
			<img src="<?php echo esc_url($image['sizes']['medium_large']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
		</div>
		<?php endif; ?>

		<!-- カスタムフィールドで設定した詳細ページ用の説明文-->
		<?php
// カスタムフィールド「lesson_description」の取得
$description = get_field('lesson_description');

if ( $description ) :
?>
		<div class="<?= esc_attr( apply_filters( 'swell_post_content_class', 'post_content' ) ) ?>">
			<?php
		// HTMLを安全に表示しつつ、改行は<p>タグに変換
		echo wpautop( wp_kses_post( $description ) );
		?>
		</div>
		<?php endif; ?>




		<!-- レッスン詳細ページ共通セクション -->
		<?php
$common_sections_path = get_stylesheet_directory() . '/parts/lesson-common-sections.php';

// 投稿IDが108の場合は料金表と講師のみ表示
if (is_single(108)) {
	// 料金表セクションのみ表示
	$lesson_price_html = get_field('lesson_price_table');
	$price_table_images_group = get_field('price_table_images');
	
	$price_images = array();
	if ($price_table_images_group && is_array($price_table_images_group)) {
		for ($i = 1; $i <= 4; $i++) {
			$field_name = "price_table_image_{$i}";
			if (isset($price_table_images_group[$field_name]) && !empty($price_table_images_group[$field_name])) {
				$price_images[] = $price_table_images_group[$field_name];
			}
		}
	}
	
	if (!empty($price_images) || !empty($lesson_price_html)) : ?>
	<section class="lesson__price">
		<div class="lesson__price-container">
			<h2 class="lesson__price-title">料金表</h2>
			
			<?php if (!empty($price_images) && is_array($price_images)) : ?>
			<div class="lesson__price-images">
				<?php foreach ($price_images as $image) :
					if (!empty($image)) :
						$image_url = $image['sizes']['large'];
						$image_alt = $image['alt'];
				?>
				<div class="lesson__price-image">
					<img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt ? $image_alt : '料金表'); ?>" loading="lazy">
				</div>
				<?php
					endif;
				endforeach; ?>
			</div>
			<?php endif; ?>
			
			<?php if (!empty($lesson_price_html)) : ?>
			<div class="lesson__price-content">
				<?php echo wp_kses_post($lesson_price_html); ?>
			</div>
			<?php endif; ?>
		</div>
	</section>
	<?php endif;
	
	// 担当講師セクションのみ表示
	include get_stylesheet_directory() . '/parts/lesson-instructor-only.php';
	
} else {
	// 投稿IDが108以外の場合は通常の共通セクションを読み込む
	if (file_exists($common_sections_path)) {
		include $common_sections_path;
	}
}
?>


		<?php
			// 改ページナビゲーション
			$defaults = [
				'before'         => '<div class="c-pagination -post">',
				'after'          => '</div>',
				'next_or_number' => 'number',
				// 'pagelink'      => '<span>%</span>',
			];
			wp_link_pages( $defaults );
		?>

		<!-- ここにあった科目タクソノミー依存の関連講師ブロックは、
		ACF『lesson_instructors』での明示選択に統一したため削除 -->



		<div id="after_article" class="l-articleBottom">
			<?php if ( ! SWELL_Theme::is_use( 'ajax_after_post' ) ) SWELL_Theme::get_parts( 'parts/single/after_article' ); ?>
		</div>
		<?php if ( SWELL_Theme::is_show_comments( $the_id ) ) comments_template(); ?>
	</article>
</main>
<?php endwhile; ?>






<?php get_footer(); ?>
