<?php
/*
Template Name: Contact
*/
?>
<?php get_header(); ?>
<div class="alert"></div>
<div class="row">
 <div class="span8">
  
  <form class="form-horizontal" id="surfclub-contact">
    <fieldset>
      <legend class="sfclub-contact">Contact the Executive Surf Club</legend>
      <div class="control-group">
        <div class="controls">
          <input type="text" class="input-xlarge" name="first_name" id="first_name" placeholder="First Name">

        </div>
     </div>

     <div class="control-group">
        <div class="controls">
          <input type="text" class="input-xlarge" name="last_name" id="last_name" placeholder="Last Name">

        </div>
     </div>

     <div class="control-group">
        <div class="controls">
          <input type="text" class="input-xlarge" name="email" id="email" placeholder="Email">

        </div>
    </div>

    <div class="control-group">
        <div class="controls">
          <textarea class="input-xlarge span5" rows="10" name="message" id="message"></textarea>
          
        </div>
   </div>
        <div class="controls">
          <button type="submit" class="btn btn-primary" name="surfclub-form-submit" id="surfclub-form-submit">Submit</button>
        </div>
    </fieldset>
  </form>  
  
</div><!-- span8 -->


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
      'child_of'           => 15,
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
 </div><!-- end row -->
<?php get_template_part('bottom'); ?>
<?php get_footer(); ?>
