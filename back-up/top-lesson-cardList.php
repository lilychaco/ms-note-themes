<?php
$lessons = get_posts([
	'post_type' => 'lesson',
	'posts_per_page' => -1,
]);

if ( $lessons ) :
?>
<style>
.top-lesson-list {
	display: grid;
	grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
	gap: 20px;
	max-width: 1200px;
	margin-inline: auto;
	padding: 0 16px;
	justify-items: center;
}

.top-lesson-list__item {
	width: 100%;
	max-width: 200px;
	/* ✅ カードの最大サイズをここで制限 */
	background-color: #fff;
	box-shadow: 0 0 4px rgba(0, 0, 0, 0.1);
	overflow: hidden;
	box-sizing: border-box;
	text-align: center;
	display: block;
	/* aタグでもブロック表示に */
	text-decoration: none;
	color: inherit;
	cursor: pointer;
	transition: box-shadow 0.3s ease;
}

.top-lesson-list__image {
	width: 100%;
	height: auto;
	display: block;
}
</style>

<div class="top-lesson-list">
	<?php foreach ( $lessons as $post ) : setup_postdata( $post ); ?>
	<a href="<?php echo get_permalink(); ?>" class="top-lesson-list__item">
		<?php if ( has_post_thumbnail() ) : ?>
		<img class="top-lesson-list__image" src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'medium' ); ?>"
			alt="<?php the_title_attribute(); ?>" loading="lazy" />
		<?php endif; ?>
		<p class="top-lesson-list__description"><?php the_title(); ?></p>
	</a>
	<?php endforeach; wp_reset_postdata(); ?>
</div>
<?php endif; ?>
