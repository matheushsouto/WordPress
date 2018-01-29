<?php
get_header(); ?>
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
				while ( have_posts() ) : the_post(); ?>

					<article id="post-<?php the_ID(); ?>" class="row row-margin-0 artigo">
                        <h1><?php the_title(); ?></h1>
                        
                        <div class="entry-content">
                            
                            <?php the_content();?>
                        </div>
                        <div class="clearfix"></div>
                        <?php
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
