<?php
if ( ! defined( 'ABSPATH' ) ) exit;

get_header();

$archive_title    = '講師一覧';
$archive_subtitle = '';

// 表示タイプの取得（デフォルトは科目別表示）
$display_type = isset($_GET['display']) ? $_GET['display'] : 'by_subject';
?>

<main id="main_content" class="l-mainContent l-article instructor-archive">
	<div class="l-mainContent__inner">

		<?php
		SWELL_Theme::pluggable_parts( 'page_title', [
			'title'     => $archive_title,
			'subtitle'  => $archive_subtitle,
			'has_inner' => true,
		] );
		?>

		<!-- 表示切り替えボタン -->
		<div class="instructor-display-toggle">
			<a href="?display=by_subject"
				class="instructor-display-toggle__button <?php echo ($display_type === 'by_subject') ? 'active' : ''; ?>">
				科目別表示
			</a>
			<a href="?display=simple"
				class="instructor-display-toggle__button <?php echo ($display_type === 'simple') ? 'active' : ''; ?>">
				一覧表示
			</a>
		</div>

		<div class="p-archiveContent u-mt-40">

			<?php if ($display_type === 'by_subject') : ?>
			<?php
				$subjects = get_terms([
					'taxonomy'   => 'instructor_subject',
					'hide_empty' => true,
					'orderby'    => 'name',
					'order'      => 'ASC'
				]);

				if (!empty($subjects) && !is_wp_error($subjects)) :
					foreach ($subjects as $subject) :
						$instructors_query = new WP_Query([
							'post_type'      => 'instructor',
							'posts_per_page' => -1,
							'orderby'        => 'menu_order',
							'order'          => 'ASC',
							'tax_query'      => [
								[
									'taxonomy' => 'instructor_subject',
									'field'    => 'term_id',
									'terms'    => $subject->term_id,
								],
							],
						]);

						if ($instructors_query->have_posts()) : ?>
			<div class="instructor-subject-section">
				<h2 class="instructor-subject-section__title"><?php echo esc_html($subject->name); ?></h2>
				<div class="p-postList -instructor p-postList">
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
												if ($schools && !is_wp_error($schools)) : ?>
								<div class="p-postList__schools">
									<?php foreach ($schools as $school) : ?>
									<span class="p-postList__school-tag"><?php echo esc_html($school->name); ?></span>
									<?php endforeach; ?>
								</div>
							</div>
							<?php endif; ?>
						</a>
					</article>
					<?php endwhile; ?>
				</div>
			</div>
			<?php wp_reset_postdata(); ?>
			<?php endif;
					endforeach;
				endif;

				// その他の講師（科目に属していない）
				$no_subject_query = new WP_Query([
					'post_type'      => 'instructor',
					'posts_per_page' => -1,
					'orderby'        => 'menu_order',
					'order'          => 'ASC',
					'tax_query'      => [
						[
							'taxonomy' => 'instructor_subject',
							'operator' => 'NOT EXISTS'
						],
					],
				]);

				if ($no_subject_query->have_posts()) : ?>
			<div class="instructor-subject-section">
				<h2 class="instructor-subject-section__title">その他</h2>
				<div class="p-postList -instructor instructor-subject-section__grid">
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
										if ($schools && !is_wp_error($schools)) : ?>
								<div class="p-postList__schools">
									<?php foreach ($schools as $school) : ?>
									<span class="p-postList__school-tag"><?php echo esc_html($school->name); ?></span>
									<?php endforeach; ?>
								</div>
							</div>
							<?php endif; ?>
						</a>
					</article>
					<?php endwhile; ?>
				</div>
			</div>
			<?php wp_reset_postdata(); ?>
			<?php endif; ?>

			<?php else : ?>
			<!-- 一覧表示 -->
			<?php
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				$instructor_query = new WP_Query([
					'post_type'      => 'instructor',
					'posts_per_page' => 9,
					'paged'          => $paged,
					'orderby'        => 'menu_order',
					'order'          => 'ASC'
				]);

				if ($instructor_query->have_posts()) : ?>
			<div class="p-postList -instructor">
				<?php while ($instructor_query->have_posts()) : $instructor_query->the_post(); ?>
				<article <?php post_class('p-postList__item'); ?>>
					<a href="<?php the_permalink(); ?>" class="p-postList__item-link">
						<?php if (has_post_thumbnail()) : ?>
						<div class="p-postList__thumb">
							<?php the_post_thumbnail('medium'); ?>
						</div>
						<?php endif; ?>
						<h2 class="p-postList__title"><?php the_title(); ?></h2>
						<?php
									$schools = get_the_terms(get_the_ID(), 'instructor_school');
									if ($schools && !is_wp_error($schools)) : ?>
						<div class="p-postList__schools">
							<?php foreach ($schools as $school) : ?>
							<span class="p-postList__school-tag"><?php echo esc_html($school->name); ?></span>
							<?php endforeach; ?>
						</div>
						<?php endif; ?>
					</a>
				</article>
				<?php endwhile; ?>
			</div>




			<div class="p-paginationNav">
				<?php
					$current = max(1, get_query_var('paged'));
					$total   = $instructor_query->max_num_pages;

					echo '<ul class="page-numbers">';

					// ‹ 前のページ
					if ($current > 1) {
						echo '<li><a class="page-numbers" href="' . get_pagenum_link($current - 1) . '">‹</a></li>';
					}

					// 現在ページのみ表示
					echo '<li><span class="page-numbers current">' . $current . '</span></li>';

					// › 次のページ
					if ($current < $total) {
						echo '<li><a class="page-numbers" href="' . get_pagenum_link($current + 1) . '">›</a></li>';
					}

					echo '</ul>';
			?>
			</div>
			<?php else : ?> <p>現在、公開中の講師はありません。</p>
			<?php endif; ?>
			<?php wp_reset_postdata(); ?>
			<?php endif; ?>
		</div>
	</div>
</main>

<?php get_footer(); ?>
