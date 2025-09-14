<?php
/**
 * 講師セクションのみ表示（ID 108専用）
 */

// 担当講師紹介セクション（タクソノミーベースで自動表示）
$lesson_subject_terms = get_the_terms( get_the_ID(), 'lesson_subject' );

if ( $lesson_subject_terms && ! is_wp_error( $lesson_subject_terms ) ) :
	// レッスン科目のスラッグを取得
	$subject_slugs = wp_list_pluck( $lesson_subject_terms, 'slug' );
	// 同じ科目（スラッグ）を担当する講師を検索
	$instructor_query = new WP_Query([
		'post_type'      => 'instructor',
		'posts_per_page' => -1,
		'orderby'        => 'menu_order',
		'order'          => 'ASC',
		'tax_query'      => [[
			'taxonomy' => 'instructor_subject',
			'field'    => 'slug',
			'terms'    => $subject_slugs,
		]],
	]);

if ( $instructor_query->have_posts() ) : ?>
<section class="lesson__instructors">
	<div class="lesson__instructors-container">
		<h2 class="lesson__instructors-title">担当講師</h2>
		<div class="lesson__instructors-grid">
			<?php while ( $instructor_query->have_posts() ) : $instructor_query->the_post(); ?>
			<article class="p-postList__item">
				<a href="<?php echo esc_url( get_permalink() ); ?>" class="p-postList__item-link">
					<div class="p-postList__thumb">
						<?php if ( has_post_thumbnail() ) : ?>
						<?php echo get_the_post_thumbnail( get_the_ID(), 'medium' ); ?>
						<?php else : ?>
						<img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/img/no-instructor-image.jpg' ); ?>"
							alt="<?php echo esc_attr( get_the_title() ); ?>" loading="lazy">
						<?php endif; ?>
					</div>
					<h3 class="p-postList__title"><?php echo esc_html( get_the_title() ); ?></h3>
					<?php
					$schools = get_the_terms( get_the_ID(), 'instructor_school' );
					if ( $schools && ! is_wp_error( $schools ) ) :
					?>
					<div class="p-postList__schools">
						<?php foreach ( $schools as $school ) : ?>
						<span class="p-postList__school-tag"><?php echo esc_html( $school->name ); ?></span>
						<?php endforeach; ?>
					</div>
					<?php endif; ?>
				</a>
			</article>
			<?php endwhile; ?>
		</div>
	</div>
</section>
<?php
	wp_reset_postdata();
endif;
endif; ?>