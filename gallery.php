<div class="row">
  <div id="gallery-1" class="royalSlider rsDefault span12">
    <?php $query = new WP_Query(array('post_type'=> 'sliders'));
      while($query->have_posts()):
      $query->the_post(); ?>
    <a class="rsImg" href="<?php the_field('slider_image');?>"></a>
    <?php endwhile; ?>
  </div>
</div>