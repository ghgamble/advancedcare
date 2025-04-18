<?php get_header(); ?>

<main id="primary" class="site-main">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="o-container">
                <h3><?php the_title(); ?></h3>
                <div class="meta">
                    <span class="author"><?php the_author(); ?></span> |
                    <time class="date" datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                        <?php echo esc_html(get_the_date()); ?>
                    </time>
                </div>
            </div>

            <div class="post-content">
                <?php the_content(); ?>
            </div>

            <div class="o-container">
                <div class="post-categories">
                    <?php the_category(', '); ?>
                </div>
            </div>
        </article>
    <?php endwhile; endif; ?>
</main>

<?php get_footer(); ?>
