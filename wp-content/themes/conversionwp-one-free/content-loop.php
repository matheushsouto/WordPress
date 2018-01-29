<?php if (have_posts()) : ?>

    <?php
    // Start the Loop.
    while (have_posts()) : the_post();

        /*
         * Include the post format-specific template for the content. If you want to
         * use this in a child theme, then include a file called called content-___.php
         * (where ___ is the post format) and that will be used instead.
         */
        ?>
        <article id="post-<?php the_ID(); ?>" class="row row-margin-0 artigo">
            <h2><a href="<?php echo esc_url(get_permalink()); ?>" rel="bookmark"> <?php the_title(); ?></a></h2>
            <div class="thumb-img col-md-5">
                <?php if (has_post_thumbnail()) { // check if the post has a Post Thumbnail assigned to it. ?>
                    <a href="<?php echo esc_url(get_permalink()); ?>" rel="bookmark"> 
                        <?php the_post_thumbnail('thumb-artigo'); ?>
                    </a>
                    <?php } else {
                    ?>
                    <a href="<?php echo esc_url(get_permalink()); ?>" rel="bookmark"> 
                        <img src="<?php echo get_template_directory_uri(); ?>/images/sem-foto.jpg" />
                    </a>
                    <?php
                }
                ?>
            </div>
            <div class="col-md-7">
                <?php echo strip_tags(excerpt(60)); ?>
            </div>
            <div class="clearfix"></div>
            <div class="read-more"><a href="<?php echo esc_url(get_permalink()); ?>" class="btn readmore">Leia mais >></a></div>
        </article><!-- #post-## -->
        <div class="clearfix"></div>
        <?php
    endwhile;

    // Page navigation.
    odin_paging_nav();

else :
    // If no content, include the "No posts found" template.
    get_template_part('content', 'none');

endif;
?>