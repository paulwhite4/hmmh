<div class="container">
  <nav class="navbar">
        <ul class="navbar__list">
          <li class="navbar__item">
            <a class="navbar__btn--active navbar__btn" href="#">All</a>
          </li>
          <li class="navbar__item">
            <a class= "navbar__btn" href="#">E-commerce</a>
          </li>
          <li class="navbar__item">
            <a class= "navbar__btn" href="#">Websites</a>
          </li>
          <li class="navbar__item">
            <a class= "navbar__btn" href="#">seo</a>
          </li>
          <li class="navbar__item">
            <a class= "navbar__btn" href="#">design</a>
          </li>
        </ul>
  </nav>
    <?php if (have_rows('repeater') ): ?>
        <div class = "content-container">
          <?php while ( have_rows('repeater') ): the_row(); ?>
          <div class="card"  data-filter="<?php the_sub_field('case_study'); ?>">
            <img class = "card__image" src ="<?php the_sub_field('obrazek');?>" alt = ""/>
            <div class="card__wrapper">
              <span class = "card__type"><?php the_sub_field('case_study'); ?></span>
              <span class="card__separator">/</span>
              <span class = "card__type"><?php the_sub_field('typ_case_study'); ?></span>
              <h3><?php the_sub_field('tytul_case_study'); ?></h3>
              <?php 
                $link = get_sub_field('adres_url');
                if( $link ): 
                    $link_url = $link['url'];
                    $link_title = $link['title'];
                    $link_target = $link['target'] ? $link['target'] : '_self';
                    ?>
                    <a class="card__link" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
              <?php endif; ?>
            </div>  
          </div>  
          <?php endwhile; ?>
      </div>
    <?php endif; ?>
</div>    
