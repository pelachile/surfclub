 <div class="row middle-content">
    <div class="span12">
      <h2>Upcoming Shows</h2>
    </div>
<?php
 $today = date('Ymd');
 $query = new WP_Query(array(
  'post_type'=>'shows',
  'posts_per_page'=> '3',
  'meta_key' => 'date',
  'orderby'=>'meta_value',
  'order'=> 'ASC',
  'meta_query' => array(
    array (
      'key' => 'date',
      'meta-value' => $value,
      'value' => $today,
      'compare' => '>='
      )
    )
  )
);
while($query->have_posts()):
  $query->the_post(); ?>
    <article class="span4 show-info">
      <header>
        <p class="date"><?php $date = strtotime( get_field('date') ); echo date('F jS',$date);?></p>
        <h3><?php the_title();?> </h3>  
      </header>
      <section class="image">
        <img src="<?php the_field('image'); ?>">
      </section>
      <footer>
        <p><?php the_field('show_description'); ?></p>
      </footer>
    </article>
    <?php endwhile; ?>
  </div><!-- end middle-content -->