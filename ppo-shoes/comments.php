<?php
/**
 * The template for displaying Comments
 *
 * The area of the page that contains comments and the comment form.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() )
	return;
?>

<article id="comments" class="author-wrapper">

	<?php if ( have_comments() ) : ?>
            <div class="title">
                <h2><?php print get_comments_number(); ?> Comments on <?php the_title(); ?></h2> 
            </div>
		<ul class="media-list">
                    <?php
                        wp_list_comments( array(
                            'style'       => 'ul',
                            'short_ping'  => true,
                            'avatar_size' => 80,
                        ) );
                    ?>
		</ul><!-- .comment-list -->

		<?php
			// Are there comments to navigate through?
			if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
		?>
		<nav class="navigation comment-navigation" role="navigation">
			<h1 class="screen-reader-text section-heading"><?php echo 'Comment navigation'; ?></h1>
			<div class="nav-previous"><?php previous_comments_link('&larr; Older Comments' ); ?></div>
			<div class="nav-next"><?php next_comments_link('Newer Comments &rarr'); ?></div>
		</nav><!-- .comment-navigation -->
		<?php endif; // Check for comment navigation ?>

		<?php if ( ! comments_open() && get_comments_number() ) : ?>
		<p class="no-comments"><?php echo 'Comments are closed.'; ?></p>
		<?php endif; ?>

	<?php endif; // have_comments() ?>

	<?php comment_form(); ?>

</article><!-- #comments -->