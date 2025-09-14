<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * 投稿一覧リストの出力テンプレート
 */
$list_type      = $variable['list_type'] ?? SWELL_Theme::$list_type;
$thumb_sizes    = $variable['thumb_sizes'] ?? '';
$cat_pos        = $variable['cat_pos'] ?? 'none';
$show_title     = $variable['show_title'] ?? true;
$show_date      = $variable['show_date'] ?? true;
$show_modified  = $variable['show_modified'] ?? false;
$show_pv        = $variable['show_pv'] ?? false;
$show_author    = $variable['show_author'] ?? false;
$excerpt_length = $variable['excerpt_length'] ?? 0;
$h_tag          = $variable['h_tag'] ?? 'h2';


// サムネイル型用
$show_post_text = ( $show_title || $show_date || $show_modified || 'beside_date' === $cat_pos );

// 投稿情報
$post_data = get_post();
$the_id    = $post_data->ID;

// 抜粋文
$excerpt = SWELL_Theme::get_excerpt( $post_data, $excerpt_length );

?>


<li class="p-postList__item <?php echo ( get_post_type( $the_id ) === 'instructor' ) ? 'instructor-item' : ''; ?>">

	<a href="<?php the_permalink( $the_id ); ?>" class="p-postList__link">
		<?php
			// サムネイル
			SWELL_Theme::get_parts(
				'parts/post_list/item/thumb',
				[
					'post_id'  => $the_id,
					'cat_pos'  => $cat_pos,
					'size' => 'medium', // or 'full' 元画像を使う

					'sizes'    => $thumb_sizes,
				]
			);
		?>
		<?php if ( $show_post_text ) : ?>
		<div class="p-postList__body">
			<?php
					if ( $show_title ) :
    			echo '<' . esc_attr( $h_tag ) . ' class="p-postList__title">';
    			echo get_the_title( $the_id );
    			echo '</' . esc_attr( $h_tag ) . '>';
				endif;

				// デフォルトの抜粋を用意
				$excerpt_output = $excerpt;

				//instructorならACFの値を取得し、抜粋化
if ( get_post_type( $the_id ) === 'instructor' ) {
    $acf_excerpt = get_field( 'instructor-description', $the_id );
    if ( ! empty( $acf_excerpt ) ) {
        $excerpt_output = wp_trim_words( $acf_excerpt, 50, '...' );
    }
	}
				// 最終的に出力
if ( ! empty( $excerpt_output ) ) :
?>
			<div class="p-postList__excerpt">
				<?php echo esc_html( $excerpt_output ); ?>
			</div>
			<?php endif; ?>



			<div class="p-postList__meta">
				<?php
					// 講師投稿の場合は、タクソノミーから担当科目を取得
					if ( get_post_type() === 'instructor' ) {
						$subject_terms = get_the_terms( get_the_ID(), 'instructor_subject' );
						if ( $subject_terms && ! is_wp_error( $subject_terms ) ) {
							$subject_names = array_map( function( $term ) {
								return $term->name;
							}, $subject_terms );
							$subject = implode( ', ', $subject_names );

							echo '<span class="c-postMeta__subject">
									<span class="c-postMeta__label">担当科目：</span>' . esc_html( $subject ) . '
								  </span>';
						}
					}
					?>

				<?php
						// 日付
						SWELL_Theme::get_parts( 'parts/post_list/item/date', [
							'show_date'     => $show_date,
							'show_modified' => $show_modified,
						] );

						if ( 'beside_date' === $cat_pos ) :
							SWELL_Theme::pluggable_parts( 'post_list_category', [ 'post_id' => $the_id ] );
						endif;

						if ( $show_pv ) :
							SWELL_Theme::pluggable_parts( 'post_list_pv', [ 'post_id' => $the_id ] );
						endif;

						if ( $show_author ) :
							SWELL_Theme::pluggable_parts( 'post_list_author', [ 'author_id' => $post_data->post_author ] );
						endif;
					?>
			</div>
		</div>
		<?php endif; ?>
	</a>
</li>
