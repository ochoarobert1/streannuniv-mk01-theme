<?php get_header(); ?>
<?php the_post(); ?>
<main class="container-fluid p-0" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
    <div class="row no-gutters">
        <?php $banner_meta = get_post_meta( get_the_ID(), 'su_page_banner', true); ?>
        <section class="page-banner col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" style="background: url(<?php echo $banner_meta; ?>);">
            <div class="page-banner-wrapper"></div>
            <div class="container">
                <div class="row">
                    <div class="section-title col-12">
                        <h1 itemprop="headline"><?php the_title(); ?></h1>
                    </div>
                </div>
            </div>
        </section>
        <section id="post-<?php the_ID(); ?>" class="page-container  col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" role="article" itemscope itemtype="http://schema.org/BlogPosting">
            <div class="container">
                <div class="row">
                    <div class="section-container col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>
<?php get_footer(); ?>
