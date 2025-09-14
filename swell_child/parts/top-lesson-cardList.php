<?php
$lessons = get_posts([
	'post_type' => 'lesson',
	'posts_per_page' => -1,
]);

if ( $lessons ) :
?>

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
