<?php
/*
Template Name: Menu Page
 */
?>
<?php get_header(); ?>
 <div class="row">
  <div id="menu-page">
    <div id="main" class="span8">
    <?php $query = new WP_Query('category_name=Favorites&post_type=menu_items');
          $current_month = '';          
          while ($query->have_posts()) : $query->the_post();?>
      <div class="menu-item">
        <h2>Favorites</h2>
        <h4> <?php the_title(); ?>
          <span class="price">$<?php the_field('price'); ?></span>
        </h4>
        <p><?php the_field('description'); ?></p>
      </div>
    <?php endwhile; ?>  
    </div><!-- end main -->  
   
  <div class="span4 sidebar">
    <?php 
    $food_args = array(
      'show_option_all'    => '',
      'orderby'            => 'name',
      'order'              => 'ASC',
      'style'              => 'list',
      'show_count'         => 0,
      'hide_empty'         => 1,
      'use_desc_for_title' => 1,
      'child_of'           => 4,
      'feed'               => '',
      'feed_type'          => '',
      'feed_image'         => '',
      'exclude'            => '',
      'exclude_tree'       => '',
      'include'            => '',
      'hierarchical'       => 1,
      'title_li'           => '',
      'show_option_none'   => __('No categories'),
      'number'             => null,
      'echo'               => 1,
      'depth'              => 0,
      'current_category'   => 0,
      'pad_counts'         => 0,
      'taxonomy'           => 'category',
      'walker'             => null
    ); $beer_args = array(
      'show_option_all'    => '',
      'orderby'            => 'name',
      'order'              => 'ASC',
      'style'              => 'list',
      'show_count'         => 0,
      'hide_empty'         => 1,
      'use_desc_for_title' => 1,
      'child_of'           => 2,
      'feed'               => '',
      'feed_type'          => '',
      'feed_image'         => '',
      'exclude'            => '',
      'exclude_tree'       => '',
      'include'            => '',
      'hierarchical'       => 0,
      'title_li'           => '',
      'show_option_none'   => __('No categories'),
      'number'             => null,
      'echo'               => 1,
      'depth'              => 0,
      'current_category'   => 0,
      'pad_counts'         => 0,
      'taxonomy'           => 'category',
      'walker'             => null
    );?>
    <h2>Menu</h2>
    <ul class='nav nav-list'>
      <?php wp_list_categories($food_args); ?>
      <h2>Beer</h2>
      <?php wp_list_categories($beer_args); ?>
   </ul> 
  </div><!-- end sidebar -->

  </div><!-- end menu-page -->
 </div><!-- end row -->
<?php get_template_part('bottom'); ?>
<?php get_footer(); ?>
