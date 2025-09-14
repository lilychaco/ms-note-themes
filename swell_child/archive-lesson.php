<?php
if ( ! defined( 'ABSPATH' ) ) exit;

get_header();

$archive_title    = 'レッスン一覧';
$archive_subtitle = '';

// 投稿一覧を全件取得に変更（カスタム投稿タイプが 'lesson' の前提）
query_posts([
    'post_type'      => 'lesson',
    'posts_per_page' => -1, // 全記事を取得
    'orderby'        => 'date',
    'order'          => 'DESC',
]);
?>

<main id="main_content" class="l-mainContent l-article">
	<div class="l-mainContent__inner">
		<?php
			SWELL_Theme::pluggable_parts( 'page_title', [
				'title'     => $archive_title,
				'subtitle'  => $archive_subtitle,
				'has_inner' => true,
			] );
		?>
		<div class="p-archiveContent u-mt-40">
			<?php if ( have_posts() ) : ?>
			<div class="p-postList">
				<?php while ( have_posts() ) : the_post(); ?>
				<article <?php post_class( 'p-postList__item' ); ?>>
					<a href="<?php the_permalink(); ?>">
						<?php if ( has_post_thumbnail() ) : ?>
						<div class="p-postList__thumb">
							<?php the_post_thumbnail( 'medium' ); ?>
						</div>
						<?php endif; ?>
						<div class="p-postList__content">
							<h2 class="p-postList__title"><?php the_title(); ?></h2>
							<div class="p-postList__excerpt">
								<?php
								$description = get_field('lesson_description');
								if ($description) {
									echo mb_substr($description, 0, 120, 'UTF-8') . '...';
								}
								?>
							</div>
						</div>
					</a>
				</article>
				<?php endwhile; ?>
			</div>
			<?php else : ?>
			<p>現在、公開中のレッスンはありません。</p>
			<?php endif; ?>
		</div>
	</div>
</main>
<?php get_footer(); ?>
