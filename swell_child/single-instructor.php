<?php
if ( ! defined( 'ABSPATH' ) ) exit;

get_header();
while ( have_posts() ) :
	the_post();

	$SETTING = SWELL_Theme::get_setting();
	$the_id  = get_the_ID();

	// シェアボタンを隠すかどうか
	$show_share_btns = false;
?>
<main id="main_content" class="l-mainContent l-article">
	<article class="l-mainContent__inner" data-clarity-region="article">
		<?php
			do_action( 'swell_before_post_head', $the_id );

			// タイトル周り
			if ( ! SWELL_Theme::is_show_ttltop() ) {
				SWELL_Theme::get_parts( 'parts/single/post_head' );
			}

			// アイキャッチ画像
			if ( SWELL_Theme::is_show_thumb( $the_id ) ) {
				do_action( 'swell_before_post_thumb', $the_id );
				echo SWELL_PARTS::post_thumbnail( $the_id ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}

			// 記事上シェアボタン
			if ( $show_share_btns && $SETTING['show_share_btn_top'] ) {
				SWELL_Theme::get_parts( 'parts/single/share_btns', [ 'position' => '-top' ] );
			}

			// 記事上ウィジェット
			SWELL_Theme::outuput_content_widget( 'single', 'top' );
		?>
		<?php
			// 担当科目の表示
			$instructor_subjects = get_the_terms( $the_id, 'instructor_subject' );
			if ( $instructor_subjects && ! is_wp_error( $instructor_subjects ) ) :
		?>
		<div class="instructor-subjects">
			<div class="instructor-subjects__title">担当科目</div>
			<div class="instructor-subjects__list">
				<?php foreach ( $instructor_subjects as $subject ) : ?>
				<span class="instructor-subjects__item"><?php echo esc_html( $subject->name ); ?></span>
				<?php endforeach; ?>
			</div>
		</div>
		<?php endif; ?>

		<?php
			// ACF インストラクター紹介文の表示
			$instructor_description = get_field('instructor-description');
			if ( $instructor_description ) :
		?>
		<div class="instructor-description">
			<div class="instructor-description__title">講師紹介</div>
			<div class="instructor-description__content">
				<?php echo wp_kses_post( $instructor_description ); ?>
			</div>
		</div>
		<?php endif; ?>

		<div class="<?=esc_attr( apply_filters( 'swell_post_content_class', 'post_content' ) )?>">
			<?php the_content();  // 本文 ?>
		</div>
		<?php
			// 改ページナビゲーション
			$defaults = [
				'before'         => '<div class="c-pagination -post">',
				'after'          => '</div>',
				'next_or_number' => 'number',
				// 'pagelink'      => '<span>%</span>',
			];
			wp_link_pages( $defaults );

			// 下部ウィジェット
			SWELL_Theme::outuput_content_widget( 'single', 'bottom' );

			// post_foot
			SWELL_Theme::get_parts( 'parts/single/post_foot' );

			// FBいいね & Twitterフォロー ボックス
			if ( SWELL_Theme::is_show_sns_cta() ) {
				SWELL_Theme::get_parts( 'parts/single/sns_cta' );
			}

			// 下部シェアボタン
			if ( $show_share_btns && $SETTING['show_share_btn_bottom'] ) {
				SWELL_Theme::get_parts( 'parts/single/share_btns', [ 'position' => '-bottom' ] );
			}

			// 固定シェアボタン
			if ( $show_share_btns && $SETTING['show_share_btn_fix'] ) {
				SWELL_Theme::get_parts( 'parts/single/share_btns', [ 'position' => '-fix' ] );
			}
		?>
		<div id="after_article" class="l-articleBottom">
			<?php if ( ! SWELL_Theme::is_use( 'ajax_after_post' ) ) SWELL_Theme::get_parts( 'parts/single/after_article' ); ?>
		</div>
		<?php if ( SWELL_Theme::is_show_comments( $the_id ) ) comments_template(); ?>
	</article>
</main>
<?php endwhile; ?>
<?php get_footer(); ?>
