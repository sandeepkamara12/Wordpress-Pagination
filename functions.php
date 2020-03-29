add_shortcode('slideListing', 'slideListing');
function slideListing() {
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$posts_per_page = 1;
	$args = array(
		'post_type'			=>	'banner_slides',
		'posts_per_page'	=>	$posts_per_page,
		'post_status'		=>	'publish',
		'orderby'			=> 'post_date',
		'order'         	=> 'DESC',
		'paged'				=> $paged
	);
	$query = new WP_Query($args);
	$tp = $query->max_num_pages;
	if($query->have_posts()):
		?>
		<div class='add-data'>
			<?php
			while($query->have_posts()): $query->the_post();
				echo "<p class='mt-5 '>" . get_the_title() . "</p>";
			endwhile;
			?>
		</div>
		<?php
    
    /* Pagination Code Starts Here */
		$total_pages = $query->max_num_pages;
		if ($total_pages > 1) {
			$current_page = max(1, get_query_var('paged'));
			echo paginate_links(array(
				'base' => get_pagenum_link(1) . '%_%',
				'format' => '/page/%#%',
				'current' => $current_page,
				'total' => $tp,
				'prev_text'    => __('« prev'),
				'next_text'    => __('next »'),
			));
		}
	endif;
}
