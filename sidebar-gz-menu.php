<nav>
<div class="container gz-menu">
	<?php 
	
	$childs = get_pages( array (
		'parent' =>167 )
		);
	
	echo '<ul class="htable_menu">';
	
	foreach ($childs as $child) :
	
	//print_r($child); print_r($post);
		if ($post->ID == $child->ID) {$itemclass = ' class="current_page_item"';} else {$itemclass = '';}
		?>
		
		<li<?php echo $itemclass; ?>>
			<a href="<?php echo get_permalink($child->ID) ?>"><?php echo $child->post_title ?></a>
		</li>
		
		<?php
		
	endforeach; // childs
	
	echo '</ul>'; // htable
	
	?>
</div>	
</nav>