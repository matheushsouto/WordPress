<?php
/**
 * The template for displaying Category pages.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
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
    <section id="primary" class="col-md-9">
        <div id="content" class="site-content" role="main">
            <h1 class="page-title title-cat"><?php printf(__('Search Results for: %s', 'odin'), get_search_query()); ?></h1>
            <?php get_template_part('content-loop'); ?>
        </div><!-- #content -->
    </section><!-- #primary -->


    <?php
    if ($posicao)
        get_sidebar();
    ?>
</div>
<?php
get_footer();
