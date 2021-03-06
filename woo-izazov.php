<?php
// ovo je najednostavnije rešenje koje bih primenila jer u jednostavnosti je vrlina :)
// copy to functions.php
/*
ako bi trebala da napravim malo pristojnije resenje onda bi izabrala da napravim plugin 
koji bi imao svoju options page gde bi korisnik mogao da izabere da li želi ili ne želi nešto ovako
u svojoj prodavnici i pri tom bi imao mogućnost da izabere boju ili boje i unese novi naslov 
*/


add_action( 'woocommerce_before_shop_loop', 'dg2_woocommerce_before_shop_loop', 10 );
function dg2_woocommerce_before_shop_loop(  ) {
	?>
<header class="woocommerce-products-header">
	<h2 class="woocommerce-products-header__title page-title">Do it in Black</h2>
</header>
<ul class="products">
<?php
$args = array(
    'post_type' => 'product_variation',
    'posts_per_page' => 6, // hocu samo 6 proizvoda
		'meta_query' => array(
        array(
            'key'     => 'attribute_pa_color',
            'value'   => array('black'), // ostavljam array u slucaju da se klijent predomisli pa doda jos neku boju
            'compare' => 'IN',
        ),
    ),
    );
$v_products = new WP_Query( $args );
if ( $v_products->have_posts() ) {
    while ( $v_products->have_posts() ) : $v_products->the_post();
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
add_filter( 'woocommerce_page_title', 'dg2_woocommerce_page_title');
function dg2_woocommerce_page_title( $page_title ) {
  if( $page_title == 'Shop' ) {
    return "Lada Butique";
  }
}
