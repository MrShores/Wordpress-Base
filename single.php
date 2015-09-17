<?php get_header(); ?>

<?php if( have_posts() ) : ?>
    <?php while( have_posts() ) : the_post(); ?>

        <div class="container-fluid">
            <div class="row-fluid">
                <div class="col-sm-12">
                    <h1><?php echo get_the_title(); ?></h1>
                </div>
            </div><!-- .row-fluid -->

            <div class="row-fluid">
                <div class="col-sm-12">

                    <div class="content">
                        <?php the_content(); ?>
                    </div><!-- .content -->
                </div>
            </div><!-- .row-fluid -->

        </div><!-- .container -->

    <?php endwhile; ?>
<?php endif; ?>


<?php get_footer(); ?>