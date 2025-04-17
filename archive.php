<?php get_header(); ?>

<main id="primary" class="site-main">
    <div class="o-container">
        <h1>
            <?php
            if (is_category()) {
                single_cat_title();
            } elseif (is_tag()) {
                single_tag_title();
            } elseif (is_author()) {
                the_author();
            } elseif (is_day()) {
                echo get_the_date();
            } else {
                post_type_archive_title();
            }
            ?>
        </h1>
    </div>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="o-container">
                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

                <?php if (has_post_thumbnail()) : ?>
                    <div class="archive-thumbnail">
                        <?php the_post_thumbnail('medium', ['style' => 'max-height:100px; height:auto;']); ?>
                    </div>
                <?php endif; ?>

                <div class="meta">
                    <span class="author"><?php the_author(); ?></span> |
                    <span class="date"><?php echo get_the_date(); ?></span> |
                    <span class="categories"><?php the_category(', '); ?></span>
                </div>

                <div class="excerpt"><?php the_excerpt(); ?></div>
            </div>
        </article>
    <?php endwhile; endif; ?>
</main>

<?php get_footer(); ?>
