<header class="header">
  <div class="top row">
    <div class="span8">
      <h1 class="blog"><a href="<?php echo home_url() ?>">Blog</a></h1>
      <h1 class="blog-title"><a href="<?php echo home_url() ?>"><?php bloginfo('name') ?></a></h1>
    </div>

  <?php $logo_options = get_option('theme_logo_options'); ?>  
    <?php if ($logo_options['logo']): ?>      
      <div class="span4 logo-container">
          <img src="<?php echo $logo_options['logo']; ?>" alt="Logo for <?php bloginfo('name')?>" />  
      </div>
    <?php  endif; ?> 
    
    <?php if (!$logo_options['logo']): ?>  
      <div class="span4 search-container">
          <?php get_search_form() ?>
      </div>
    <?php endif ?>
  </div>

  <div class="bottom row">
    <div class="span8 blog-meta">
      <table>
        <?php if (get_option('gds_organisations')) : ?>
          <tr>
            <th width="130px">Organisations:</th>
            <td><?php echo get_option('gds_organisations') ?></td>
          </tr>
        <?php endif ?>
        <?php if (get_option('gds_topics')) : ?>
          <tr>
            <th>Topics:</th>
            <td><?php echo get_option('gds_topics') ?></td>
          </tr>
        <?php endif ?>
        <?php if (get_option('gds_location')) : ?>
          <tr>
            <th>Location:</th>
            <td><?php echo get_option('gds_location') ?></td>
          </tr>
        <?php endif ?>
      </table>
    </div>

    <?php if ($logo_options['logo']): ?>  
      <div class="span4 search-container">
        <?php get_search_form() ?>
      </div>
    <?php else : ?>
      <div class="span4 subscribe">
        <ul>
          <li class="atom"><a href="<?php echo esc_attr(get_feed_link('atom')) ?>">atom</a></li>
          <?php if (get_option('gds_email_alerts')) : ?>
            <li class="email"><a href="<?php echo esc_attr(get_option('gds_email_alerts')) ?>">email alerts</a></li>
          <?php endif ?>
        </ul>
      </div>
    <?php endif ?>
  </div>
</header>
