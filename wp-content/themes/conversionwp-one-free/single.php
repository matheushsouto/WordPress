<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Odin
 * @since 2.2.0
 */
get_header();
?>
<div class="container">
    <?php
    $posicao = get_option('geral');
    $posicao = $posicao['posicao_sidebar'];
    if (!$posicao)
        get_sidebar();
    ?>
    <div id="primary" class="col-md-9">
        <div id="content" class="site-content" role="main">
            <?php
            // Start the Loop.
            while (have_posts()) : the_post();
                ?>

                <article id="post-<?php the_ID(); ?>" class="row row-margin-0 artigo">
                    <h1><?php the_title(); ?></h1>
                    <div class="entry-meta">
                    <?php odin_posted_on(); ?>
                    </div><!-- .entry-meta -->
    <?php the_content('');?>

                    <div class="clearfix"></div>
                    <?php
                    // If comments are open or we have at least one comment, load up the comment template.
                    if (comments_open() || get_comments_number()) :
                        comments_template();
                    endif;
                endwhile;
                ?>
            </article><!-- #post-## -->

        </div><!-- #content -->
    </div><!-- #primary -->

    <?php
    if ($posicao)
        get_sidebar();
    ?>
</div>
<?php
get_footer();
