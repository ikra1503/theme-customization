<?php
/**
 * Template Name: Landing (Intro) Page
 *
 * @author    Dan Fisher
 * @package   Necromancers
 * @since     1.0.0
 * @version   1.0.0
 */

get_header();
?>
<?php
$join_our_team_heading = get_field('join_our_team_heading', 'option');
$join_our_team_description = get_field('join_our_team_description', 'option');
$join_our_team_mail_heading = get_field('join_our_team_mail_heading', 'option');
$join_our_team_mail = get_field('join_our_team_mail', 'option');


//contact Info 
$contact_heading = get_field('contact_heading', 'option');
$contact_description = get_field('contact_description', 'option');
$contact_mail_heading = get_field('contact_mail_heading', 'option');
$contact_mail = get_field('contact_mail', 'option');

$social_icon = get_field('social_icon', 'option');
$social_icon = is_array($social_icon) ? $social_icon : [];
$social_iconUrl = $social_icon['url'];
$social_iconTitle = $social_icon['title'];
$social_iconTarget = $social_icon['target'];

$socialFacebookLogo = get_field('facebook_logo', 'option');
$socialFacebookLogo = is_array($socialFacebookLogo) ? $socialFacebookLogo : [];
$socialFacebookLogoUrl = $socialFacebookLogo['url'];

// CopyRight Section 
$website_by_label = get_field('website_by_label', 'option');

$website_link = get_field('website_link', 'option');
$website_link = is_array($website_link) ? $website_link : [];
$website_linkUrl = $website_link['url'];
$website_linkTarget = $website_link['target'];
$website_linkTitle = $website_link['title'];

$website_logo = get_field('website_logo', 'option');
$website_logo = is_array($website_logo) ? $website_logo : [];
$website_logoUrl = isset($website_logo['url']) ? $website_logo['url'] : null;
$website_logoTitle = isset($website_logo['title']) ? $website_logo['title'] : null;


$our_partners_label = get_field('our_partners_label', 'option');
$our_partners = get_field('our_partners', 'option');

$HeaderLogo = get_field('header_logo', 'option');
$HeaderLogo = is_array($HeaderLogo) ? $HeaderLogo : [];
$HeaderLogourl = isset($HeaderLogo['url']) ? $HeaderLogo['url'] : null;
$HeaderLogoTitle = isset($HeaderLogo['title']) ? $HeaderLogo['title'] : null;
?>
<div class="site-wrapper">

  <header id="header" class="site-header site-header--bottom pinning-nav unpinned" style="position: fixed;">

    <?php if ($HeaderLogourl): ?>
      <div class="header-logo header-logo--img">
        <a href="<?php echo site_url(); ?>" class="custom-logo-link" rel="home"><img width="415" height="67"
            src="<?php echo $HeaderLogourl; ?>" class="custom-logo" alt="<?php echo $HeaderLogoTitle; ?>"
            decoding="async"></a>
      </div>
    <?php endif; ?>
    <nav class="main-nav">
      <?php
      $menu_args = array(
        'theme_location' => 'navbar',
        'container' => false,
        'menu_class' => 'main-nav__list',
        'list_item_class' => 'menu-item menu-item-type-post_type menu-item-object-page no-mega-menu',
        'link_class' => 'menu-item-link',
      );
      wp_nav_menu($menu_args);
      ?>

    </nav>
    <div class="header-actions">

      <a href="#" class="language-switch-btn"><img
          src="<?php echo get_template_directory_uri(); ?>/assets/images/world.svg" alt="world" width="24"
          height="24">Deutsch <i class="icon-triangle-down"></i></a>
      <?php
      $languages = icl_get_languages('skip_missing=0');
      rsort($languages);
      $current_language_code = ICL_LANGUAGE_CODE;
      ?>
      <div class="language-switch">
        <?php
        if (!empty($languages)) {
          foreach ($languages as $language) {
            $language['language_code'];
            $url = $language['url'];
            $language_code = $language['language_code'];
            $is_active = ($language_code === $current_language_code) ? 'active' : '';
            echo '<a href="' . $url . '" class="language-link ' . $is_active . '" data-lang-code="' . $language['language_code'] . '">' . strtoupper($language['language_code']) . '</a><br>';
          }
        }
        ?>
      </div>
      <div class="language">
        <ul>
          <?php
          $languages = icl_get_languages('skip_missing=0');

          // Sort the languages array so that "EN" comes first
          usort($languages, function ($a, $b) {
            return ($a['language_code'] === 'en') ? -1 : 1;
          });

          $current_language_code = ICL_LANGUAGE_CODE;

          if (!empty($languages)) {
            foreach ($languages as $language) {
              $language_code = $language['language_code'];
              $url = $language['url'];
              $is_active = ($language_code === $current_language_code) ? 'active' : '';
              echo '<li><a href="' . $url . '" class="' . $is_active . '" title="' . strtoupper($language_code) . '">' . strtoupper($language_code) . '</a></li>';
            }
          }
          ?>
        </ul>
      </div>

      <div class="header-menu-toggle ">
        <div class="header-menu-toggle__inner">
          <span>&nbsp;</span>
          <span>&nbsp;</span>
          <span>&nbsp;</span>
        </div>
      </div>
    </div>
  </header>

  <main class="site-content text-center" id="wrapper">
    <?php
    get_template_part('template-parts/content/content-front');
    ?>

  </main>

  <div class="menu-panel">
    <ul class="menu-panel__mobile-bar list-unstyled d-md-none">
      <li class="mobile-bar-item">
        <a class="mobile-bar-item__header collapsed" data-toggle="collapse" href="#mobile_menu__primary_menu"
          role="button" aria-expanded="false" aria-controls="mobile_menu__primary_menu">
          Main Links <span class="main-nav__toggle">&nbsp;</span>
        </a>
        <div id="mobile_menu__primary_menu" class="collapse mobile-bar-item__body">
          <nav class="mobile-nav">
            <?php
            $menu_args = array(
              'theme_location' => 'off-canvas',
              'container' => false,
              'menu_class' => '"mobile-nav__list',
              'list_item_class' => '',
              'link_class' => '',
            );
            wp_nav_menu($menu_args);
            ?>
          </nav>
        </div>
      </li>
      <?php if ($contact_mail_heading || $contact_mail || $join_our_team_mail_heading || $join_our_team_mail): ?>
        <li class="mobile-bar-item mobile-bar-item--info">
          <a class="mobile-bar-item__header collapsed" data-toggle="collapse" href="#mobile_menu__info" role="button"
            aria-expanded="false" aria-controls="mobile_menu__info">
            Get in Touch! <span class="main-nav__toggle">&nbsp;</span>
          </a>
          <div id="mobile_menu__info" class="collapse mobile-bar-item__body">
            <div class="mobile-bar-item__inner">
              <ul class="list-unstyled">
                <?php if ($contact_mail_heading || $contact_mail): ?>
                  <li class="info-box">
                    <?php if ($contact_mail_heading): ?>
                      <div class="info-box__label"><?php echo $contact_mail_heading; ?></div><?php endif; ?>
                    <?php if ($contact_mail): ?>
                      <div class="info-box__content">
                        <a href="mailto:<?php echo $contact_mail; ?>"><?php echo $contact_mail; ?></a>
                      </div>
                    <?php endif; ?>
                  </li>
                <?php endif; ?>
                <?php if ($join_our_team_mail_heading || $join_our_team_mail): ?>
                  <li class="info-box">
                    <?php if ($join_our_team_mail_heading): ?>
                      <div class="info-box__label"><?php echo $join_our_team_mail_heading; ?></div><?php endif; ?>
                    <?php if ($join_our_team_mail): ?>
                      <div class="info-box__content">
                        <a href="mailto:<?php echo $join_our_team_mail; ?>"><?php echo $join_our_team_mail; ?></a>
                      </div>
                    <?php endif; ?>
                  </li>
                <?php endif; ?>
              </ul>
            </div>
          </div>
        </li>
      <?php endif; ?>
      <?php if ($our_partners): ?>
        <li class="mobile-bar-item mobile-bar-item--partners">
          <a class="mobile-bar-item__header collapsed" data-toggle="collapse" href="#mobile_menu__partners" role="button"
            aria-expanded="false" aria-controls="mobile_menu__partners">
            <?php echo $our_partners_label; ?>
            <span class="main-nav__toggle">&nbsp;</span>
          </a>
          <div id="mobile_menu__partners" class="collapse mobile-bar-item__body">
            <div class="mobile-bar-item__inner">
              <div class="widget__content">
                <?php
                extract($args, EXTR_SKIP);

                if (!empty($our_partners)):
                  ?>
                  <ul class="widget-partners-mobile-carousel">
                    <?php
                    foreach ($our_partners as $partner):
                      ?>
                      <li>
                        <a href="<?php echo $partner['partners_logos']['partner_logo_url']['url']; ?>" target="_blank">
                          <?php
                          echo '<img src="' . esc_url($partner['partners_logos']['url']) . '" alt="' . $partner['partners_logos']['title'] . '">';
                          ?>
                        </a>
                      </li>
                      <?php
                    endforeach;
                    ?>
                  </ul>
                  <?php
                endif;
                ?>
              </div>
            </div>
          </div>
        </li>
      <?php endif; ?>
    </ul>


    <div class="menu-panel__content d-none d-md-flex ">
      <div class="menu-panel__navigation">
        <div id="dl-menu" class="dl-menuwrapper">
          <?php
          $menu_args = array(
            'theme_location' => 'off-canvas',
            'container' => false,
            'menu_class' => '"mobile-nav__list',
            'list_item_class' => 'menu-item menu-item-type-post_type menu-item-object-page no-mega-menu',
            'link_class' => 'menu-item-link',
          );
          wp_nav_menu($menu_args);
          ?>
        </div>
      </div>
      <div class="menu-panel__widget-area">
        <div class="row">

          <div class="col-md-12 col-lg-6 col-xl-5">

            <!-- Widget: Primary Info -->
            <?php if ($join_our_team_heading || $join_our_team_description || $join_our_team_mail || $join_our_team_mail_heading): ?>
              <div class="widget widget-text widget--primary-info">
                <?php if ($join_our_team_heading): ?>
                  <h5 class="widget__title">
                    <?php echo $join_our_team_heading; ?>
                  </h5>
                <?php endif; ?>
                <?php if ($join_our_team_description || $join_our_team_mail_heading || $join_our_team_mail): ?>
                  <div class="widget__content">
                    <?php if ($join_our_team_description): ?>
                      <p><?php echo $join_our_team_description; ?></p><?php endif; ?>
                    <?php if ($join_our_team_mail_heading || $join_our_team_mail): ?>
                      <div class="info-box">
                        <?php if ($join_our_team_mail_heading): ?>
                          <div class="info-box__label"><?php echo $join_our_team_mail_heading; ?></div><?php endif; ?>
                        <?php if ($join_our_team_mail): ?>
                          <div class="info-box__content">
                            <a href="mailto:<?php echo $join_our_team_mail; ?>"><?php echo $join_our_team_mail; ?></a>
                          </div>
                        <?php endif; ?>
                      </div>
                    <?php endif; ?>
                  </div>
                <?php endif; ?>
              </div>
            <?php endif; ?>
            <!-- Widget: Primary Info / End -->
          </div>
          <?php if ($contact_heading || $contact_description || $contact_mail_heading || $contact_mail): ?>
            <div class="col-md-12 col-lg-6 col-xl-5 offset-xl-2 mt-5 mt-lg-0">
              <!-- Widget: Secondary Info -->
              <div class="widget widget-contact-info">
                <?php if ($contact_heading): ?>
                  <h5 class="widget__title">
                    <?php echo $contact_heading; ?>
                  </h5>
                <?php endif; ?>
                <?php if ($contact_description || $contact_mail || $contact_mail_heading): ?>
                  <div class="widget__content">
                    <?php if ($contact_description): ?>
                      <p><?php echo $contact_description; ?></p><?php endif; ?>
                    <?php if ($contact_mail_heading || $contact_mail): ?>
                      <div class="info-box">
                        <?php if ($contact_mail_heading): ?>
                          <div class="info-box__label"><?php echo $contact_mail_heading; ?></div><?php endif; ?>
                        <?php if ($contact_mail): ?>
                          <div class="info-box__content">
                            <a href="mailto:<?php echo $contact_mail; ?>"><?php echo $contact_mail; ?></a>
                          </div>
                        <?php endif; ?>
                      </div>
                    <?php endif; ?>
                    <?php if ($social_iconUrl || $social_linkTitle): ?>
                      <ul class="social-menu social-menu--default">
                        <li>
                          <a href="<?php echo $social_iconUrl; ?>" target="<?php echo $social_iconTarget; ?>"
                            title="<?php echo $social_iconTitle; ?>"> <img src="<?php echo $socialFacebookLogoUrl; ?>"
                              alt="facebook"></a>
                        </li>
                      </ul>
                    <?php endif; ?>
                  </div>
                <?php endif; ?>
              </div>
              <!-- Widget: Secondary Info / End -->
            </div>
          <?php endif; ?>
        </div>


        <?php
        $our_partners = get_field('our_partners', 'option');
        ?>
        <div class="row">
          <div class="col-md-12">
            <!-- Widget: Partners Carousel -->
            <div class="widget widget-partners-carousel">
              <h5 class="widget__title">
                <?php echo $our_partners_label; ?>
              </h5>
              <div class="widget__content">
                <?php
                extract($args, EXTR_SKIP);

                if (!empty($our_partners)):
                  ?>
                  <ul class="<?php echo esc_attr($class); ?>">
                    <?php
                    foreach ($our_partners as $partner):
                      ?>
                      <?php $link= $partner['partner_logo_url']['url']?>
                      <li>
                        <a href="<?php echo $link; ?>" target="_blank">
                          <?php
                          echo '<img src="' . esc_url($partner['partners_logos']['url']) . '" alt="' . $partner['partners_logos']['title'] . '">';
                          ?>
                        </a>
                      </li>
                      <?php
                    endforeach;
                    ?>
                  </ul>
                  <?php
                endif;
                ?>
              </div>
            </div>
            <!-- Widget: Partners Carousel / End -->
          </div>
        </div>






        <?php if ($website_link || $website_logo || $website_by_label): ?>
          <div class="row">
            <div class="col-lg-12">
              <p class="pixlogo"><?php echo $website_by_label; ?><a href="<?php echo $website_linkUrl; ?>"
                  target="<?php echo $website_linkTarget; ?>">
                  <?php if ($website_logoUrl): ?> <img src="<?php echo $website_logoUrl; ?>"
                      alt="<?php echo $website_logoTitlee; ?>"><?php endif; ?>
                </a>
              </p>
            </div>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
<?php
get_footer();
?>