<?php get_header(); ?>
<?php the_post(); ?>
<main class="container-fluid" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
    <div class="row">
       <section class="page-banner col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

       </section>
        <section id="post-<?php the_ID(); ?>" class="page-container col-12" role="article" itemscope itemtype="http://schema.org/BlogPosting">
            <div class="container">
                <div class="row">
                    <div class="section-title col-12">
                        <h1 itemprop="headline"><?php the_title(); ?></h1>
                    </div>
                    <div class="section-container col-12">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>
<?php get_footer(); ?>
