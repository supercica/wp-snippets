add_action( 'woocommerce_before_shop_loop', 'action_woocommerce_before_shop_loop', 10 );
function action_woocommerce_before_shop_loop(  ) {
	?>
	<div style="display:block;width:100%; padding:0 25px; ">
		<h2>Do it in Black</h2>
	</div>
<ul class="products product-style-3 row grid-view products-wrap grid-columns-4  ">
<?php
$args = array(
    'post_type' => 'product_variation',
    'posts_per_page' => 12,
		'meta_query' => array(
        array(
            'key'     => 'attribute_pa_color',
            'value'   => array('crna'), // ostavljam array u slucaju da se klijent predomisli pa doda jos neku boju
            'compare' => 'IN',
        ),
    ),
    );
$loop = new WP_Query( $args );
if ( $loop->have_posts() ) {
    while ( $loop->have_posts() ) : $loop->the_post();
        wc_get_template_part( 'content', 'product' );
    endwhile;
} else {
    echo __( 'No products found' );
}
wp_reset_postdata();
}


// mada ne vidim razlog sto ovo ne bi uradili direkt u wp promenom naslova, bez promene slug-a
// takodje ovo moze da zavisi i od teme , u jednoj od tema ovo nije radilo, nisam dublje istrazivala
// ali kontam da je tema pregazila ovaj hook sa svojim hookom jer ima i specifican prikaz ovih strana 
add_filter( 'woocommerce_page_title', 'custom_woocommerce_page_title');
function custom_woocommerce_page_title( $page_title ) {
  if( $page_title == 'Shop' ) {
    return "Lada Butique";
  }
}
