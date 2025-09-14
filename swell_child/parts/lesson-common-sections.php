<?php
/**
 * レッスン詳細ページ共通セクション
 * 入会の流れ、レッスンについての説明、料金表、講師紹介など
 */

// 入会の流れセクション
?>
<section class="lesson__flow">
	<div class="lesson__flow-container">
		<h2 class="lesson__flow-title">入会の流れ</h2>
		<div class="lesson__flow-content">
			<div class="lesson__flow-step">
				<div class="lesson__flow-step-number">1</div>
				<div class="lesson__flow-step-content">
					<h3>体験レッスンのお申し込み</h3>
					<p>まずは「体験レッスン申し込みフォーム」（LINK）より、お申し込みください。お申し込み後にお申し込み確認のメールが届きますので、ご確認ください。</p>
				</div>
			</div>
			<div class="lesson__flow-step">
				<div class="lesson__flow-step-number">2</div>
				<div class="lesson__flow-step-content">
					<h3>体験レッスンの実施</h3>
					<p>ご予約いただきましたレッスン会場にお越しいただき、30分程の体験レッスンを実施いたします。ご予約時間の10分ほど前にお越しください。</p>
				</div>
			</div>
			<div class="lesson__flow-step">
				<div class="lesson__flow-step-number">3</div>
				<div class="lesson__flow-step-content">
					<h3>教室のご案内</h3>
					<p>体験レッスンの後、チケットレッスンの規約ご説明と教室のご案内をいたします。ご質問などもこの際にご回答しております。</p>
				</div>
			</div>
			<div class="lesson__flow-step">
				<div class="lesson__flow-step-number">4</div>
				<div class="lesson__flow-step-content">
					<h3>ご検討・ご入会手続き</h3>
					<p><strong>①ご入会の場合：</strong><br>ご入会金・チケット料金のお支払をいただき予定を決定いたします。</p>
					<p><strong>②ご検討とする場合：</strong><br>改めてお返事をいただくか、こちらからご検討の結果を確認するお電話または、メールをいたします。
					</p>
				</div>
			</div>
		</div>

		<!-- 備考・補足 -->
		<div class="lesson__flow-notes">
			<h3>備考</h3>
			<p>無理な勧誘や、必要以上のお電話はいたしませんので、ご安心ください。</p>
			<p>体験レッスンにいらしていただいた曜日が今後のレッスン曜日となります。</p>
			<p>時間は都度講師と調整になる場合がございます。</p>
			<p>体験レッスン料は無料です。但し、別曜日、別講師、別科目など2回目以降の体験レッスンをご希望の場合は、体験レッスン料金（¥1100）を別途お支払いとなります。
			</p>
		</div>
	</div>
</section>

<?php
// レッスン内容セクション
?>
<section class="lesson__about">
	<div class="lesson__about-container">
		<h2 class="lesson__about-title">レッスン形態</h2>
		<div class="lesson__about-content">
			<p>マンツーマンの個人レッスンです。（一部グループレッスンもございます）</p>
			<p>固定曜日、固定時間でのレッスンもしくは、講師、教室の空き、生徒様のご都合をチケット購入時に都度調整する「フリー」タイプもございます。
			</p>

			<div class="lesson__ticket-info">
				<h3>チケットについて</h3>
				<ul>
					<li>チケットは原則1ヶ月（約30日）で2枚利用となります。</li>
					<li>チケット2枚目を利用した日に次のチケットをご購入いただきます。</li>
					<li>チケットおまとめ購入の場合（5セット以上）設備利用費割引があります。</li>
					<li>※アンサンブルやデュエットなどはグループになる場合があります。</li>
				</ul>
			</div>

			<div class="lesson__notes">
				<p><strong>振替レッスン</strong></p>
				<p>生徒様都合のキャンセルの場合(当日キャンセル)は振替いたしません。</p>
				<p>事前キャンセル連絡の場合は,講師スケジュールと教室の空きがあれば
					当月内の振替を実施たしますが、チケット有効期内で講師のスケジュールに沿って調整となります。
				</p>
			</div>
		</div>
	</div>
</section>

<?php
// 料金表セクション - ACFグループフィールド対応
$lesson_price_html = get_field('lesson_price_table'); // ACFから料金表HTML取得

// ACFグループフィールド「price_table_images」からサブフィールドを取得
$price_images = array();
$price_table_images_group = get_field('price_table_images');

if ($price_table_images_group && is_array($price_table_images_group)) {
    for ($i = 1; $i <= 4; $i++) {
        $field_name = "price_table_image_{$i}";
        if (isset($price_table_images_group[$field_name]) && !empty($price_table_images_group[$field_name])) {
            $price_images[] = $price_table_images_group[$field_name];
        }
    }
}
?>

<section class="lesson__price">
	<div class="lesson__price-container">
		<h2 class="lesson__price-title">料金表</h2>

		<!-- 料金表画像（ACF個別フィールドから取得） -->
		<?php if (!empty($price_images) && is_array($price_images)) : ?>
		<div class="lesson__price-images">
			<?php foreach ($price_images as $image) :
                if (!empty($image)) :
                    // ACF Galleryの場合、$imageは画像配列
                    $image_url = $image['sizes']['large'];
                    $image_alt = $image['alt'];
            ?>
			<div class="lesson__price-image">
				<img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt ? $image_alt : '料金表'); ?>"
					loading="lazy">
			</div>
			<?php
                endif;
            endforeach; ?>
		</div>
		<?php endif; ?>

		<?php if (!empty($lesson_price_html)) : ?>
		<!-- ACFから料金表HTMLを出力 -->
		<div class="lesson__price-content">
			<?php echo wp_kses_post($lesson_price_html); ?>
		</div>
		<?php endif; ?>
	</div>
</section>






<?php
// 担当講師紹介セクション（タクソノミーベースで自動表示）
// レッスンの科目（lesson_subject）から同じ科目を担当する講師を抽出
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
