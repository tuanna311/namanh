<?php
/**
 * Post title and meta template part
 * Overridden in Funiture child theme
 */
?>

<?php
if ( is_single() ) {
	echo '<h1 class="entry-title">' . get_the_title() . '</h1>';
} else {
?>
<h6 class="entry-category is-xsmall">
	<?php echo get_the_category_list( __( ', ', 'flatsome' ) ) ?>
</h6>
<?php
	echo '<h2 class="entry-title"><a href="' . get_the_permalink() . '" rel="bookmark" class="plain">' . get_the_title() . '</a></h2>';
}
?>

<div class="entry-meta is-xsmall">
    <?php flatsome_posted_on(); ?>
</div>
