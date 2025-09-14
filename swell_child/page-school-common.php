<?php
/**
 * 共通 School ページテンプレート
 * suita / shimamoto 両方で使用
 */

if ( ! defined( 'ABSPATH' ) ) exit;

get_header();

if ( is_front_page() ) :

	// フロントページ用テンプレート
	SWELL_Theme::get_parts( 'tmp/front' );

else :

	while ( have_posts() ) :
		the_post();
		$the_id = get_the_ID();

		// 固定ページではサイズ指定を無視して「大」を表示
		$show_pr_notation = SWELL_Theme::get_pr_notation_size( $the_id, 'show_pr_notation_page' );
		?>

<main id="main_content" class="l-mainContent l-article">
	<div class="l-mainContent__inner" data-clarity-region="article">

		<?php SWELL_Theme::get_parts( 'parts/page_head' ); ?>

		<?php if ( $show_pr_notation ) : ?>
		<?php SWELL_Theme::pluggable_parts( 'pr_notation' ); ?>
		<?php endif; ?>

		<div class="<?= esc_attr( apply_filters( 'swell_post_content_class', 'post_content' ) ) ?>">
			<?php the_content(); ?>
		</div><!-- /.post_content -->

	</div><!-- /.l-mainContent__inner -->
</main>

<?php
	endwhile;

endif;

get_footer();
