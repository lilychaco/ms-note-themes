<?php
if ( ! defined( 'ABSPATH' ) ) exit;
// phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped

/**
 * 講師の教室（instructor_school）タクソノミー用のテンプレートファイル
 */
$SETTING = SWELL_Theme::get_setting();
$wp_obj  = get_queried_object();
$term_id = $wp_obj->term_id;

get_header();
?>
<main id="main_content" class="l-mainContent l-article">
	<div class="l-mainContent__inner">
		<?php
			if ( ! SWELL_Theme::is_show_ttltop() ) :
				// カスタムタイトル表示（「-tax-」を非表示）
				$term = get_term( $term_id );
				$title = get_term_meta( $term_id, 'swell_term_meta_ttl', 1 ) ?: $term->name;
				$subtitle = '担当講師一覧';

				SWELL_Theme::pluggable_parts( 'page_title', [
					'title'     => $title,
					'subtitle'  => $subtitle,
					'has_inner' => true,
				] );

				SWELL_PARTS::the_term_navigation( $term_id );
			endif;

			// PR表記
			if ( get_term_meta( $term_id, 'swell_term_meta_show_pr_notation', 1 ) ) {
				SWELL_Theme::pluggable_parts( 'pr_notation' );
			}

			// 説明文・アイキャッチ
			SWELL_Theme::get_parts( 'parts/archive/term_head', [
				'term_id'     => $term_id,
				'description' => $wp_obj->description,
			] );
		?>
		<div class="p-termContent l-parent">
			<?php
			// ブログパーツ
			$parts_id = get_term_meta( $term_id, 'swell_term_meta_display_parts', 1 );
			if ( ! empty( $parts_id ) ) :
				$is_hide_parts_paged = get_term_meta( $term_id, 'swell_term_meta_hide_parts_paged', 1 );
				if ( ! ( $is_hide_parts_paged && is_paged() ) ) :
					echo apply_filters( 'the_content', '[blog_parts id="' . $parts_id . '"]' );
				endif;
			endif;

			// この教室に属する講師を科目別に表示
			$__found_any_instructors = false;
			// 全ての科目を取得
			$subjects = get_terms(array(
				'taxonomy' => 'instructor_subject',
				'hide_empty' => false,
				'orderby' => 'name',
				'order' => 'ASC'
			));

			if (!empty($subjects) && !is_wp_error($subjects)) :
				foreach ($subjects as $subject) :
					// この教室とこの科目の両方に属する講師を取得
					$instructors_query = new WP_Query(array(
						'post_type' => 'instructor',
						'posts_per_page' => -1,
						'orderby' => 'menu_order',
						'order' => 'ASC',
						'tax_query' => array(
							'relation' => 'AND',
							array(
								'taxonomy' => 'instructor_school',
								'field' => 'term_id',
								'terms' => $term_id,
							),
							array(
								'taxonomy' => 'instructor_subject',
								'field' => 'term_id',
								'terms' => $subject->term_id,
							),
						),
					));

					if ($instructors_query->have_posts()) :
						$__found_any_instructors = true;
		?>
			<div class="instructor-subject-section">
				<h2 class="instructor-subject-section__title"><?php echo esc_html($subject->name); ?></h2>
				<div class="instructor-subject-section__grid p-postList -instructor">
					<?php while ($instructors_query->have_posts()) : $instructors_query->the_post(); ?>
					<article <?php post_class('p-postList__item'); ?>>
						<a href="<?php the_permalink(); ?>" class="p-postList__item-link">
							<?php if (has_post_thumbnail()) : ?>
							<div class="p-postList__thumb">
								<?php the_post_thumbnail('medium'); ?>
							</div>
							<?php endif; ?>
							<div class="p-postList__body">
								<h3 class="p-postList__title"><?php the_title(); ?></h3>
								<?php
									$schools = get_the_terms(get_the_ID(), 'instructor_school');
									if ($schools && !is_wp_error($schools)) :
									?>
								<div class="p-postList__schools">
									<?php foreach ($schools as $school) : ?>
									<span class="p-postList__school-tag"><?php echo esc_html($school->name); ?></span>
									<?php endforeach; ?>
								</div>
								<?php endif; ?>
							</div>
						</a>
					</article>
					<?php endwhile; ?>
				</div>
			</div>
			<?php
					endif;
					wp_reset_postdata();
				endforeach;
			endif;

			// この教室に属するが科目に属していない講師を表示
			$no_subject_query = new WP_Query(array(
				'post_type' => 'instructor',
				'posts_per_page' => -1,
				'orderby' => 'menu_order',
				'order' => 'ASC',
				'tax_query' => array(
					'relation' => 'AND',
					array(
						'taxonomy' => 'instructor_school',
						'field' => 'term_id',
						'terms' => $term_id,
					),
					array(
						'taxonomy' => 'instructor_subject',
						'operator' => 'NOT EXISTS'
					),
				),
			));

			if ($no_subject_query->have_posts()) :
				$__found_any_instructors = true;
		?>
			<div class="instructor-subject-section">
				<h2 class="instructor-subject-section__title">その他</h2>
				<div class="instructor-subject-section__grid p-postList -instructor">
					<?php while ($no_subject_query->have_posts()) : $no_subject_query->the_post(); ?>
					<article <?php post_class('p-postList__item'); ?>>
						<a href="<?php the_permalink(); ?>" class="p-postList__item-link">
							<?php if (has_post_thumbnail()) : ?>
							<div class="p-postList__thumb">
								<?php the_post_thumbnail('medium'); ?>
							</div>
							<?php endif; ?>
							<div class="p-postList__body">
								<h3 class="p-postList__title"><?php the_title(); ?></h3>
								<?php
								$schools = get_the_terms(get_the_ID(), 'instructor_school');
								if ($schools && !is_wp_error($schools)) :
								?>
								<div class="p-postList__schools">
									<?php foreach ($schools as $school) : ?>
									<span class="p-postList__school-tag"><?php echo esc_html($school->name); ?></span>
									<?php endforeach; ?>
								</div>
								<?php endif; ?>
							</div>
						</a>
					</article>
					<?php endwhile; ?>
				</div>
			</div>
			<?php
			endif;
			wp_reset_postdata();

			// 科目あり/なしのいずれでも1件も取れなかった場合のフォールバック
			if ( ! $__found_any_instructors ) {
				$all_instructors_query = new WP_Query(array(
					'post_type' => 'instructor',
					'posts_per_page' => -1,
					'orderby' => 'menu_order',
					'order' => 'ASC',
					'tax_query' => array(
						array(
							'taxonomy' => 'instructor_school',
							'field'    => 'term_id',
							'terms'    => $term_id,
						),
					),
				));

				if ( $all_instructors_query->have_posts() ) :
					?>
			<div class="instructor-subject-section">
				<h2 class="instructor-subject-section__title">担当講師</h2>
				<div class="instructor-subject-section__grid p-postList -instructor">
					<?php while ( $all_instructors_query->have_posts() ) : $all_instructors_query->the_post(); ?>
					<article <?php post_class('p-postList__item'); ?>>
						<a href="<?php the_permalink(); ?>" class="p-postList__item-link">
							<?php if (has_post_thumbnail()) : ?>
							<div class="p-postList__thumb">
								<?php the_post_thumbnail('medium'); ?>
							</div>
							<?php endif; ?>
							<div class="p-postList__body">
								<h3 class="p-postList__title"><?php the_title(); ?></h3>
								<?php
								$schools = get_the_terms(get_the_ID(), 'instructor_school');
								if ($schools && !is_wp_error($schools)) :
								?>
								<div class="p-postList__schools">
									<?php foreach ($schools as $school) : ?>
									<span class="p-postList__school-tag"><?php echo esc_html($school->name); ?></span>
									<?php endforeach; ?>
								</div>
								<?php endif; ?>
							</div>
						</a>
					</article>
					<?php endwhile; ?>
				</div>
			</div>
			<?php
				endif;
				wp_reset_postdata();
			}
		?>
		</div>
	</div>
</main>
<?php get_footer(); ?>
