<?php
	
//Condition for Parent Class
	if(class_exists('function_library')){
		add_action( 'plugins_loaded', 'cp_products_override' );

		function cp_products_override() {
			$cp_products_class = new cp_products_class;
		}

	class cp_products_class extends function_library{
		public $products_array = array(			
				
					'image_icon' =>array(

						'type'=> 'image','name'=> 'cp-icon',

						'hr'=> 'none',

						'description'=> "fa fa-list-alt"),
				
					"top-bar-div13-open" => array( 'type'=>'open' ,'name'=>'div_start','class'=>'row-fluid','id'=>'cp-top-bar-div13'),

					'header'=>array(

						'title'=> 'HEADER TITLE',

						'name'=> 'page-option-item-product-header-title',
						
						'description'=>'Please add header title here it will be shown at top of this element.',

						'type'=> 'inputtext'
					),

					'category'=>array(

						'title'=>'CHOOSE CATEGORY',

						'name'=>'page-option-item-product-category',

						'options'=>array(),

						'type'=>'combobox_category',

						'hr'=> 'none',

						'description'=>'Choose the product category you want the products to be fetched.'
					),
					
					'num-excerpt'=>array(

						'title'=> 'LENGHT OF EXCERPT',

						'name'=> 'page-option-item-product-num-excerpt',

						'type'=> 'inputtext',

						'default'=> 300,

						'description'=>'Set the number of content character to each product (work only on list view).'
					),
					
					"top-bar-div13-close" => array( 'name'=>'div_end','type'=>'close' ,'id'=>'cp-top-bar-div13'),
					
					"top-bar-div14-open" => array( 'type'=>'open' ,'name'=>'div_start','class'=>'row-fluid','id'=>'cp-top-bar-div14'),
					
					'layout_select'=>array(

						'title'=> 'SELECT LAYOUT',

						'name'=> 'page-option-item-product-layout',

						'type'=> 'combobox',
						
						'defualt'=> 'Simple Grid',

						'options'=>array('0'=>'Simple Grid','1'=>'Normal Grid'),

					),	
						
					'filterable'=>array(

						'title'=> 'SHOW FILTERABLE',

						'name'=> 'page-option-item-product-filterable',

						'type'=> 'combobox',
						
						'class' => 'cp-product-class-filter',
						
						'defualt'=> 'No',

						'options'=>array('0'=>'Yes', '1'=>'No'),
						
						'description'=>'You can turn on Filter at products by their assigned categories.'

					),		
					
					'column-select'=>array(

						'title'=> 'SELECT COLUMNS OF GRID',

						'name'=> 'page-option-item-product-column',

						'type'=> 'combobox',
						
						'class' => 'cp-product-class-column',
						
						'defualt'=> '3',

						'options'=>array('0'=>'3', '1'=>'4'),

					),			
					
					
					"top-bar-div14-close" => array( 'name'=>'div_end','type'=>'close' ,'id'=>'cp-top-bar-div14'),
					
					"top-bar-div15-open" => array( 'type'=>'open' ,'name'=>'div_start','class'=>'row-fluid','id'=>'cp-top-bar-div15'),
					
					'pagination'=>array(

						'title'=>'ENABLE PAGINATION',

						'name'=>'page-option-item-product-pagination',

						'type'=> 'combobox',
						
						'class'=> 'product-fetch-item-pagination-store',

						'options'=>array('0'=>'Wp-Default', '1'=>'Theme-Custom','2'=>'No-Pagination'),

						'hr'=> 'none',

						'description'=>'Pagination will only appear when the number of posts is greater than the number of fetched item in one page you can also select wordpress default pagination that can be added from settings.'),
					

					'num-fetch'=>array(					

						'title'=> 'PRODUCTS NUM FETCH',

						'name'=> 'page-option-item-product-num-fetch',

						'type'=> 'inputtext',
						
						'class'=> 'product-fetch-item-store',

						'default'=> 5,

						'description'=>'Set the number of fetched products on one page.'
					),					
					
					"top-bar-div15-close" => array( 'name'=>'div_end','type'=>'close' ,'id'=>'cp-top-bar-div15'),

				);
			
			//Product Slider Array
			public $products_slider_array = array(
				
				'image_icon' =>array(

					'type'=> 'image','name'=> 'cp-icon',

					'hr'=> 'none',

					'description'=> "fa fa-sliders"),
				
				"top-bar-div0231-open" => array( 'type'=>'open' ,'name'=>'div_start','class'=>'row-fluid','id'=>'cp-top-bar-div0231'),
				
				'header'=>array(

					'title'=> 'ELEMENT TITLE',

					'name'=> 'page-option-products-sliders-header-title',

					'type'=> 'inputtext'
				),

				'layout_select'=>array(

						'title'=> 'SELECT LAYOUT',

						'name'=> 'page-option-item-sliders-product-layout',

						'type'=> 'combobox',
						
						'defualt'=> 'Simple Grid',

						'options'=>array('0'=>'Simple Grid','1'=>'Normal Grid'),

				),	
					
				'category'=>array(

					'title'=>'CHOOSE CATEGORY',

					'name'=>'page-option-products-slider-category',

					'options'=>array(),

					'type'=>'combobox_category',

					'hr'=> 'none',

					'description'=>'Choose the products category you want the Items to be fetched.'),
				

				// 'number_fetch'=>array(

					// 'title'=>'Number of Products',

					// 'name'=>'page-option-products-slider-number-fetch',

					// 'type'=> 'inputtext',

					// 'hr'=> 'none',

					// 'description'=>'Add Number Of Products You Want To Display.'),			
					
				"top-bar-div0231-close" => array( 'name'=>'div_end','type'=>'close' ,'id'=>'cp-top-bar-div0231'),

			);
			
			public $products_size_array =  array('element1-1'=>'1/1');		
			
			function page_builder_size_class(){
				global $div_size;
				$div_size['Woo-Products'] = $this->products_size_array;	
				$div_size['Products_Slider'] = $this->products_size_array;					
			}
			
			function page_builder_element_class(){
			global $page_meta_boxes;
				//Store Fields
				$page_meta_boxes['Page Item']['name']['Woo-Products'] = $this->products_array;
				$page_meta_boxes['Page Item']['name']['Woo-Products']['category']['options'] = get_category_list_array( 'product_cat' );
				//Products Slider Fields
				$page_meta_boxes['Page Item']['name']['Products_Slider'] = $this->products_slider_array;
				$page_meta_boxes['Page Item']['name']['Products_Slider']['category']['options'] = get_category_list_array( 'product_cat' );																			
			}
			
			function __construct(){
				// Null Function
			}
				
		
		// Products Slider Element
		function print_products_slider_item($item_xml){ 
			global $counter;
			$header = cp_find_xml_value($item_xml, 'header');
			$category = cp_find_xml_value($item_xml, 'category');
			$layout_select = cp_find_xml_value($item_xml, 'layout_select');
			$number_fetch = cp_find_xml_value($item_xml, 'number_fetch');			
			
			//Query To Database
			if($category == '0'){
				query_posts(
					array( 
					'post_type' 				=> 'product',
					'posts_per_page'			=> -1,
					'orderby'					=> 'date',
					'order' 					=> 'DESC' )
				);
			}else{
				query_posts(
					array( 
					'post_type' 				=> 'product',
					'posts_per_page'			=> -1,
					'tax_query' => array(
						array(
							'taxonomy' => 'product_cat',
							'terms' => $category,
							'field' => 'term_id',
						)
					),
					'orderby' => 'date',
					'order' => 'DESC' )
				);
			} 
			
			?>
			<div class="garments-collection">
			<!--Bx Slider Script Calling-->
				<script type="text/javascript">
				jQuery(document).ready(function ($) {
					"use strict";
					if ($('.cp-prod-slider-<?php echo esc_js($counter);?>').length) {
						$('.cp-prod-slider-<?php echo esc_js($counter);?>').bxSlider({
							auto:false,
							speed: 2000,
							slideWidth: 275,
							minSlides: 1,
							maxSlides: 4,
							slideMargin: 15,
							controls: true,
							infiniteLoop: true
						});
					}
				});
				</script>
				<div class="cp-prod-slider-<?php echo esc_attr($counter);?>">				
					<?php	
					$permalink_structure = get_option('permalink_structure');
					if($permalink_structure <> ''){
						$permalink_structure = '?';
					}else{
						$permalink_structure = '&';
					}
					$counter_product = 0;
					
					while( have_posts() ){
						the_post();	
						global $post,$post_id,$product,$product_url;
						//cp_selected_grid($layout_select,$product,$post);						?>						<?php 												$regular_price = get_post_meta($post->ID, '_regular_price', true);						if($regular_price == ''){							$regular_price = get_post_meta($post->ID, '_max_variation_regular_price', true);						}						$sale_price = get_post_meta($post->ID, '_sale_price', true);						if($sale_price == ''){							$sale_price = get_post_meta($post->ID, '_min_variation_sale_price', true);						}						$sku_num = get_post_meta($post->ID, '_sku', true);						$currency = get_woocommerce_currency_symbol(); 												?>							<div class="collection-box">								<div class="frame">									<?php echo get_the_post_thumbnail($post->ID, array(350,350));?>									<div class="caption">									<?php //	echo apply_filters( 'woocommerce_loop_add_to_cart_link', sprintf( '<a class = "like" href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="cart btn-7 %s product_type_%s"><i class="fa fa-shopping-cart"></i></a>', esc_url( $product->add_to_cart_url() ),	esc_attr( $product->id ),esc_attr( $product->get_sku() ),$product->is_purchasable() ? 'add_to_cart_button' : '', esc_attr( $product->product_type ),	esc_html( $product->add_to_cart_text() )),$product ); ?>																					<?php										echo apply_filters( 'woocommerce_loop_add_to_cart_link',											sprintf( '<a class = "like"  href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="cart button btn-7  %s product_type_%s"><i class="fa fa-shopping-cart"></i></a>',												esc_url( $product->add_to_cart_url() ),												esc_attr( $product->id ),												esc_attr( $product->get_sku() ),												$product->is_purchasable() ? 'add_to_cart_button' : '',												esc_attr( $product->product_type ),												esc_html( $product->add_to_cart_text() )											),										$product );									?>										<a class="detail" href="<?php echo esc_url(get_permalink());?>"><?php esc_html_e('Details','mosque_crunchpress');?></a>									</div>								</div>								<div class="text-box">									<h3><a href="<?php echo esc_url(get_permalink());?>"><?php echo esc_html(get_the_title());?></a></h3>									<strong class="price"><?php echo esc_attr($currency);?><?php if($sale_price <> ''){echo esc_attr($sale_price);}else{echo esc_attr($regular_price);}?></strong>									<?php	// echo apply_filters( 'woocommerce_loop_add_to_cart_link', sprintf( '<a  href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="cart btn-7 %s product_type_%s">ADD TO CART</a>', esc_url( $product->add_to_cart_url() ), esc_attr( $product->id ), esc_attr( $product->get_sku() ), $product->is_purchasable() ? 'add_to_cart_button' : '', esc_attr( $product->product_type ), esc_html( $product->add_to_cart_text() )),$product ); ?>									<?php									echo apply_filters( 'woocommerce_loop_add_to_cart_link',										sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="cart button btn-7  %s product_type_%s">Add To Cart</a>',											esc_url( $product->add_to_cart_url() ),											esc_attr( $product->id ),											esc_attr( $product->get_sku() ),											$product->is_purchasable() ? 'add_to_cart_button' : '',											esc_attr( $product->product_type ),											esc_html( $product->add_to_cart_text() )										),									$product );								?>								</div>							</div>							
					<?php } //End While
					wp_reset_postdata();
					wp_reset_query();
					?>
				</div>
			</div>			
			<?php 
			
		}//Product Slider Function Ends				

		// Print Store Element
		function print_store_item($item_xml){
			$header = cp_find_xml_value($item_xml, 'header');
			$category = cp_find_xml_value($item_xml, 'category');
			$num_excerpt = cp_find_xml_value($item_xml, 'num-excerpt');
			$pagination = cp_find_xml_value($item_xml, 'pagination');
			$number_fetch = cp_find_xml_value($item_xml, 'number_fetch');
			$style = cp_find_xml_value($item_xml, 'style'); 	
			
			//Pagination default wordpress
			if(cp_find_xml_value($item_xml, "pagination") == 'Wp-Default'){
				$num_fetch = get_option('posts_per_page');
			}else if(cp_find_xml_value($item_xml, "pagination") == 'Theme-Custom'){
				$num_fetch = cp_find_xml_value($item_xml, 'number_fetch');
			}else{}
			
			echo '<!-- Element Title -->
			<div class="section-title">
			  <div class="container">
				<h2>'.$header.'</h2>
			  </div>
			</div>
			';
			//Query To Database
			if($style == 'Diagonal'){
				if($category == '0'){
					query_posts(
						array( 
						'post_type' 				=> 'product',
						'posts_per_page'			=> $number_fetch,
						'orderby'					=> 'title',
						'order' 					=> 'ASC' )
					);
				}else{
					query_posts(
						array( 
						'post_type' 				=> 'product',
						'posts_per_page'			=> $number_fetch,
						'tax_query' => array(
							array(
								'taxonomy' => 'product_cat',
								'terms' => $category,
								'field' => 'term_id',
							)
						),
						'orderby' => 'title',
						'order' => 'ASC' )
					);
				} 
			?>
			
			
			<!--HTML Markup of Element-->
			<div class="featured-items">
				<div class="container">
					<div class="row">
					<?php	
					$permalink_structure = get_option('permalink_structure');
					if($permalink_structure <> ''){
						$permalink_structure = '?';
					}else{
						$permalink_structure = '&';
					}
					$counter_product = 0;
					
					while( have_posts() ){
						the_post();	
						global $post,$post_id,$product,$product_url;
						$regular_price = get_post_meta($post->ID, '_regular_price', true);
						if($regular_price == ''){
							$regular_price = get_post_meta($post->ID, '_max_variation_regular_price', true);
						}
						$sale_price = get_post_meta($post->ID, '_sale_price', true);
						if($sale_price == ''){
							$sale_price = get_post_meta($post->ID, '_min_variation_sale_price', true);
						}
						$sku_num = get_post_meta($post->ID, '_sku', true);
						$currency = get_woocommerce_currency_symbol(); ?>
					
					<!-- Inside Loop Content -->	
						<div class="col-md-4">
							<div class="fitem">
								<div class="cart">
									<form enctype="multipart/form-data" method="post" class="cart" action="<?php echo esc_url(get_permalink());?><?php echo $permalink_structure;?>add-to-cart=<?php echo $post->ID;?>">	
										<a class="cart add_to_cart_button button product_type_simple added" data-quantity="1" data-product_sku="<?php echo $sku_num;?>" data-product_id="<?php echo $post->ID;?>" type="submit"><i class="fa fa-shopping-cart"></i></a>
									</form>
								</div>
								<div class="thumb">
									<div class="frame">
										<span class="frame-hover"><a href="<?php echo esc_url(get_permalink());?>"><i class="fa fa-link"></i></a></span>
											<div class="frame-caption">
												<h3><?php echo esc_attr(get_the_title());?></h3>
												<div class="bottom-row woocommerce">
												<?php 
													if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' )
														return;
													$count   = $product->get_rating_count();
													$average = $product->get_average_rating();

													if ( $count > 0 ) : ?>
													
													<div class="woocommerce-product-rating" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
														<div class="star-rating" title="<?php printf( __( 'Rated %s out of 5', 'woocommerce' ), $average ); ?>">
															<span class="rating-star-cp" style="width:<?php echo ( ( $average / 5 ) * 100 ); ?>%"></span>
														</div>
													</div>
													<?php endif; ?>
												</div>
												<strong class="price"><?php echo esc_attr($currency);?><?php if($sale_price <> ''){echo esc_attr($sale_price);}else{echo esc_attr($regular_price);}?></strong> 
											</div>
										<?php echo get_the_post_thumbnail($post_id, array(450,450));?>
									</div>
								</div>
								<div class="like"><a href="<?php echo esc_url(get_permalink());?>"><i class="fa fa-file-text-o"></i></a></div>
							</div>
						</div>	
				<?php } //End While ?> 	
					</div> <!-- row ends -->
				</div> <!-- Container ends -->
			</div><!-- Parent Div ends -->
		
		<?php } else {

				if($category == '0'){
					query_posts(
						array( 
						'post_type' 				=> 'product',
						'posts_per_page'			=> $number_fetch,
						'orderby'					=> 'date',
						'order' 					=> 'DESC' )
					);
				}else{
					query_posts(
						array( 
						'post_type' 				=> 'product',
						'posts_per_page'			=> $number_fetch,
						'tax_query' => array(
							array(
								'taxonomy' => 'product_cat',
								'terms' => $category,
								'field' => 'term_id',
							)
						),
						'orderby' => 'date',
						'order' => 'DESC' )
					);
				} ?>
				
					
				<!--HTML Markup of Element-->
				<div class="container">
					<div class="row">	
					<?php	
						$permalink_structure = get_option('permalink_structure');
						if($permalink_structure <> ''){
							$permalink_structure = '?';
						}else{
							$permalink_structure = '&';
						}
						$counter_product = 0;
						
						while( have_posts() ){
							the_post();	
							global $post,$post_id,$product,$product_url;
							$regular_price = get_post_meta($post->ID, '_regular_price', true);
							if($regular_price == ''){
								$regular_price = get_post_meta($post->ID, '_max_variation_regular_price', true);
							}
							$sale_price = get_post_meta($post->ID, '_sale_price', true);
							if($sale_price == ''){
								$sale_price = get_post_meta($post->ID, '_min_variation_sale_price', true);
							}
							$sku_num = get_post_meta($post->ID, '_sku', true);
							$currency = get_woocommerce_currency_symbol(); ?>
						
							<!-- Inside Loop Content -->
							<div class="col-md-3">
								<div class="pro-box">
									<div class="thumb">
										<div class="thumb-hover"> 
											<span class="cart">
												<form enctype="multipart/form-data" method="post" class="" action="<?php echo esc_url(get_permalink());?><?php echo $permalink_structure;?>add-to-cart=<?php echo $post->ID;?>">	
													<a class="add_to_cart_button button product_type_simple added" data-quantity="1" data-product_sku="<?php echo $sku_num;?>" data-product_id="<?php echo $post->ID;?>" type="submit"><i class="fa fa-shopping-cart"></i></a>
												</form>
											</span>
											<span class="like"><a href="<?php echo esc_url(get_permalink());?>"><i class="fa fa-file-text-o"></i></a></span> 
										</div>
										<div class="sale">
											<?php if ( $product->is_on_sale() ) : ?>
												<?php echo apply_filters( 'woocommerce_sale_flash', '<span>' . esc_html_e( 'On Sale!', 'woocommerce' ) . '</span>', $post, $product ); ?>
											<?php endif; ?>
										</div>
										<?php echo get_the_post_thumbnail($post_id, array(260,300));?>
									</div>
									<div class="pro-content">
										<div class="rate"><?php echo esc_attr($currency);?><?php if($sale_price <> ''){echo esc_attr($sale_price);}else{echo esc_attr($regular_price);}?></div>
										<h3><?php echo esc_attr(get_the_title());?></h3>
										<div class="bottom-row woocommerce">
											<?php 
												if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' )
													return;
												$count   = $product->get_rating_count();
												$average = $product->get_average_rating();
												if ( $count > 0 ) : ?>
												<div class="woocommerce-product-rating" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
													<div class="star-rating" title="<?php printf( __( 'Rated %s out of 5', 'woocommerce' ), $average ); ?>">
														<span class="rating-star-cp" style="width:<?php echo ( ( $average / 5 ) * 100 ); ?>%"></span>
													</div>
												</div>
											<?php endif; ?>
										</div>
									</div>
								</div>
							</div>	
						<?php } //End While ?>
					</div>
				</div>
		<?php } //end ELSE clause 	
			wp_reset_query();
			wp_reset_postdata();
			
		} // End Classes Function for frontend	
	} // Class ends here
} //function library condition ends