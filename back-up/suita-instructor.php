			<!-- 吹田校担当講師の表示 -->
			<?php
			// 吹田校のタームを取得
			$suita_term = get_term_by('slug', 'suita', 'instructor_school');
			if (!$suita_term) {
				// スラッグで見つからない場合は名前で検索
				$suita_terms = get_terms(array(
					'taxonomy' => 'instructor_school',
					'name' => '吹田校',
					'hide_empty' => false
				));
				if (!empty($suita_terms)) {
					$suita_term = $suita_terms[0];
				}
			}

			if ($suita_term) :
				// 全ての科目を取得
				$subjects = get_terms(array(
					'taxonomy' => 'instructor_subject',
					'hide_empty' => false,
					'orderby' => 'name',
					'order' => 'ASC'
				));

				if (!empty($subjects) && !is_wp_error($subjects)) :
			?>
			<div class="instructor-section">
				<h2 class="instructor-section__title">吹田校担当講師</h2>

				<?php foreach ($subjects as $subject) :
					// 吹田校とこの科目の両方に属する講師を取得
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
								'terms' => $suita_term->term_id,
							),
							array(
								'taxonomy' => 'instructor_subject',
								'field' => 'term_id',
								'terms' => $subject->term_id,
							),
						),
					));

					if ($instructors_query->have_posts()) :
				?>
				<div class="instructor-subject-section">
					<h3 class="instructor-subject-section__title"><?php echo esc_html($subject->name); ?></h3>
					<div class="instructor-subject-section__grid">
						<?php while ($instructors_query->have_posts()) : $instructors_query->the_post(); ?>
						<article class="p-postList__item">
							<a href="<?php the_permalink(); ?>">
								<?php if (has_post_thumbnail()) : ?>
								<div class="p-postList__thumb">
									<?php the_post_thumbnail('medium', array('loading' => 'lazy', 'alt' => get_the_title() . 'の講師写真')); ?>
								</div>
								<?php endif; ?>
								<h4 class="p-postList__title"><?php the_title(); ?></h4>

								<!-- 教室情報を表示 -->
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
							</a>
						</article>
						<?php endwhile; ?>
					</div>
				</div>
				<?php
					endif;
					wp_reset_postdata();
				endforeach;

				// 吹田校に属するが科目に属していない講師を表示
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
							'terms' => $suita_term->term_id,
						),
						array(
							'taxonomy' => 'instructor_subject',
							'operator' => 'NOT EXISTS'
						),
					),
				));

				if ($no_subject_query->have_posts()) :
				?>
				<div class="instructor-subject-section">
					<h3 class="instructor-subject-section__title">その他</h3>
					<div class="instructor-subject-section__grid">
						<?php while ($no_subject_query->have_posts()) : $no_subject_query->the_post(); ?>
						<article class="p-postList__item">
							<a href="<?php the_permalink(); ?>">
								<?php if (has_post_thumbnail()) : ?>
								<div class="p-postList__thumb">
									<?php the_post_thumbnail('medium', array('loading' => 'lazy', 'alt' => get_the_title() . 'の講師写真')); ?>
								</div>
								<?php endif; ?>
								<h4 class="p-postList__title"><?php the_title(); ?></h4>

								<!-- 教室情報を表示 -->
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
							</a>
						</article>
						<?php endwhile; ?>
					</div>
				</div>
				<?php
				endif;
				wp_reset_postdata();
				?>
			</div>
			<?php
				endif; // subjects check
			else :
				echo '<p>吹田校の情報が見つかりません。管理画面で「教室」タクソノミーに「吹田校」が登録されているか確認してください。</p>';
			endif; // suita_term check
			?>
		</div>
		<?php
					// 改ページナビゲーション
					$defaults = [
						'before'           => '<div class="c-pagination -post">',
						'after'            => '</div>',
						'next_or_number'   => 'number',
						// 'pagelink'      => '<span>%</span>',
					];
					wp_link_pages( $defaults );

					// ページ下部ウィジェット
					SWELL_Theme::outuput_content_widget( 'page', 'bottom' );
				?>
	</div>
