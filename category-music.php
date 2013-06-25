<?php

get_header(); ?>

<div id="music-page" class="container">
	<div class="row">

	<?php $query = new WP_Query('category_name=Music&post_type=shows&orderby=meta_value&meta_key=date&order=ASC');
	$current_month = '';				  
	while ($query->have_posts()) : $query->the_post();?>
	<?php $date = strtotime( get_field('date') ); 
				$month = date('F',$date); ?>
		<div class="row">
			<div class="span10">
			<h2> 
			<?php if ($month != $current_month){
				$current_month = $month;
				echo $month;
			} ?>
			</h2>
			</div><!-- span10 -->
		</div><!-- end row -->
		<div class="row">
			<article class="span10 music-item">
				<header>
					<h4><?php the_title(); ?>
						<span class="date"><?php $date = strtotime( get_field('date') ); echo date('F jS',$date);?></span>
					</h4>
				</header>
				<section>
					<div class="span2">
						<img src="<?php the_field('image'); ?>" alt="Good Band">
					</div>
					<div class="span7">
						<p>
						<?php the_field('show_description'); ?>
						</p> 
						<p>
						<span class="doors">Doors open at <?php the_field('doors_open'); ?></span>
						<span class="cover">Cover: $<?php the_field('cover_price'); ?></span>
						</p>
					</div>    
				</section>
		</article><!-- end music-item -->  
		</div><!-- end row -->

	<?php endwhile; ?>
</div><!-- end row -->
<?php get_template_part('bottom'); ?>
<?php get_footer(); ?>