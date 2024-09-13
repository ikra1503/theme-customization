<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link rel="shortcut icon" href="<?php bloginfo('template_directory')?>/assets/images/favicon.png" type="">

  <title> Finexo </title>

</head>

<body>

  <div class="hero_area">

    <div class="hero_bg_box">
      <div class="bg_img_box">
        <img src="<?php bloginfo('template_directory')?>/assets/images/hero-bg.png" alt="">
      </div>
    </div>

    <!-- header section strats -->
    <header class="header_section">
    <div class="container-fluid">
    <nav class="navbar navbar-expand-lg custom_nav-container">
        <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
            <span>Finexo</span>
        </a>


        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span></span>
        </button>
        <div class='gttranslate left-side'>
             <?php echo do_shortcode('[gtranslate]'); ?>
        </div>      
        <?php
        wp_nav_menu( array(
            'theme_location' => 'primary',
            'container' => '',
            'items_wrap' => '<div class="collapse navbar-collapse" id="navbarSupportedContent"><ul class="navbar-nav">%3$s</ul></div>',
            'walker' => new Custom_Nav_Walker(),
        ) );
        ?>


        <form class="form-inline">
            <button class="btn my-2 my-sm-0 nav_search-btn" type="submit">
                <i class="fa fa-search" aria-hidden="true"></i>
            </button>
        </form>
    </nav>
</div>
