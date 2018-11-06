<?php get_header(); ?>
<?php the_post(); ?>
<main class="container" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
    <div class="row">
        <section class="front-page-container col-12">
            <div class="container">
                <div class="row">
                    <div class="section-container col-12">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>
<?php get_footer(); ?>
