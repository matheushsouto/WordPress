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
            <h1 class="archive-title title-cat">Artigos da tag: <?php echo single_tag_title('', false); ?></h1>
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
