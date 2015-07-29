	<?php get_header(); ?>

	<section>
		<div class="container">
			Эта страница контроля заполнения данных о товаре. Сайт не ссылается на неё. <br /> 
			(а можно было сделать нормальную страницу)
			<h1><?php the_title(); ?></h1>
			<?php the_post_thumbnail('full'); ?>
			<?php the_content(); ?>
<?			
if( have_rows('param') ):
	 ?>
	 <table class="table">
	 <tr>
		 <th><span>Розмiр</span></td>
		 <th><span>Цiна</span></td>
	 </tr>
	 <?php 
    while ( have_rows('param') ) : the_row();
	 ?>
	 <tr>
		 <td><span><?php echo the_sub_field('razmir');?></span></td>
		 <td><span><?php echo the_sub_field('price');?> грн.</span></td>
	 </tr>
	 <?php
    endwhile;
	 ?>
	 </table>
	 <?php
else :

    // no rows found

endif;
?>		

			

			
		</div>
	</section>
	
	<?php get_footer(); ?>