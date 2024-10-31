<?php
/**
 * Rt Blog Module
 */
namespace Elementor;

if ( ! class_exists( 'WooCommerce' ) ) {
	return;
}

if ( ! defined( 'ABSPATH' ) ) {
	return; // Exit if it is accessed directly
}

class RT_Widget_Woo_Carousel extends Widget_Base {


	public function get_name() {
		return 'rt-widget-woo-carousel';
	}

	public function get_title() {
		return esc_html__( 'Woo Carousel', 'rt-elementor-widget' );
	}

	public function get_icon() {
		return 'eicon-carousel';
	}

	public function get_categories() {
		return array( 'rt-elements' );
	}
	public function get_script_depends() {
		return [ 'rt-elementor-widgets-woo-carousel'];
	}	

	protected function _register_controls() {

		$this->start_controls_section(
			'rt_woo_section',
			[
				'label' => esc_html__( 'Query', 'rt-elementor-widget' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'count',
			[
				'label' 		=> esc_html__( 'Post Count', 'rt-elementor-widget' ),
				'type' 			=> Controls_Manager::TEXT,
				'default' 		=> '6',
				'label_block' 	=> true,
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'order',
			[
				'label' 		=> esc_html__( 'Order', 'rt-elementor-widget' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> '',
				'options' 		=> [
					'' 			=> esc_html__( 'Default', 'rt-elementor-widget' ),
					'DESC' 		=> esc_html__( 'DESC', 'rt-elementor-widget' ),
					'ASC' 		=> esc_html__( 'ASC', 'rt-elementor-widget' ),
				],
			]
		);

		$this->add_control(
			'orderby',
			[
				'label' 		=> esc_html__( 'Order By', 'rt-elementor-widget' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> '',
				'options' 		=> [
					'' 				=> esc_html__( 'Default', 'rt-elementor-widget' ),
					'date' 			=> esc_html__( 'Date', 'rt-elementor-widget' ),
					'title' 		=> esc_html__( 'Title', 'rt-elementor-widget' ),
					'name' 			=> esc_html__( 'Name', 'rt-elementor-widget' ),
					'modified' 		=> esc_html__( 'Modified', 'rt-elementor-widget' ),
					'author' 		=> esc_html__( 'Author', 'rt-elementor-widget' ),
					'rand' 			=> esc_html__( 'Random', 'rt-elementor-widget' ),
					'ID' 			=> esc_html__( 'ID', 'rt-elementor-widget' ),
					'comment_count' => esc_html__( 'Comment Count', 'rt-elementor-widget' ),
					'menu_order' 	=> esc_html__( 'Menu Order', 'rt-elementor-widget' ),
				],
			]
		);

		$this->add_control(
			'include_categories',
			[
				'label' 		=> esc_html__( 'Include Categories', 'rt-elementor-widget' ),
				'description' 	=> esc_html__( 'Enter the product categories slugs seperated by a "comma"', 'rt-elementor-widget' ),
				'type' 			=> Controls_Manager::TEXT,
				'label_block' 	=> true,
			]
		);

		$this->add_control(
			'exclude_categories',
			[
				'label' 		=> esc_html__( 'Exclude Categories', 'rt-elementor-widget' ),
				'description' 	=> esc_html__( 'Enter the categories slugs seperated by a "comma"', 'rt-elementor-widget' ),
				'type' 			=> Controls_Manager::TEXT,
				'label_block' 	=> true,
			]
		);

        $this->end_controls_section();		

        $this->start_controls_section(
            'section_elements',
            [
                'label' => esc_html__( 'Elements', 'rt-elementor-widget' )
            ]
        );
		$this->add_control(
			'image',
			[
				'label' 		=> esc_html__( 'Image', 'rt-elementor-widget' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'true',
				'options' 		=> [
					'true' 		=> esc_html__( 'Show', 'rt-elementor-widget' ),
					'false' 	=> esc_html__( 'Hide', 'rt-elementor-widget' ),
				],
			]
		);        

		$this->add_control(
			'title',
			[
				'label' 		=> esc_html__( 'Title', 'rt-elementor-widget' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'true',
				'options' 		=> [
					'true' 		=> esc_html__( 'Show', 'rt-elementor-widget' ),
					'false' 	=> esc_html__( 'Hide', 'rt-elementor-widget' ),
				],
			]
		);

		$this->add_control(
			'price',
			[
				'label' 		=> esc_html__( 'Price', 'rt-elementor-widget' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'true',
				'options' 		=> [
					'true' 		=> esc_html__( 'Show', 'rt-elementor-widget' ),
					'false' 	=> esc_html__( 'Hide', 'rt-elementor-widget' ),
				],
			]
		);		

		$this->add_control(
			'rating',
			[
				'label' 		=> esc_html__( 'Rating', 'rt-elementor-widget' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'true',
				'options' 		=> [
					'true' 		=> esc_html__( 'Show', 'rt-elementor-widget' ),
					'false' 	=> esc_html__( 'Hide', 'rt-elementor-widget' ),
				],
			]
		);

        $this->end_controls_section();	
		$this->start_controls_section(
			'section_content_wrapper',
			[
				'label' 		=> esc_html__( 'Wrapper', 'rt-elementor-widget' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => esc_html__( 'Normal', 'rt-elementor-widget' ),
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'selector' => '{{WRAPPER}} .product-wrapper',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'rt-elementor-widget' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .product-wrapper, {{WRAPPER}} .product-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .product-wrapper',
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => esc_html__( 'Hover', 'rt-elementor-widget' ),
			]
		);	
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border_hover',
				'selector' => '{{WRAPPER}} .product-wrapper:hover',
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_hover_box_shadow',
				'selector' => '{{WRAPPER}} .product-wrapper:hover',
			]
		);
			
		$this->end_controls_tab();
        $this->end_controls_section();

		$this->start_controls_section(
			'section_title',
			[
				'label' 		=> esc_html__( 'Title', 'rt-elementor-widget' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' 		=> esc_html__( 'Color', 'rt-elementor-widget' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .product-wrapper h4.entry-title a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_title',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .product-wrapper h4.entry-title a',
			]
		);		

		// Title margin.
		$this->add_responsive_control(
			'title_margin',
			[
				'label'      => esc_html__( 'Margin', 'rt-elementor-widget' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .product-wrapper h4.entry-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);		

        $this->end_controls_section();

		$this->start_controls_section(
			'section_content',
			[
				'label' 		=> esc_html__( 'Post Meta', 'rt-elementor-widget' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'content_color',
			[
				'label' 		=> esc_html__( 'Color', 'rt-elementor-widget' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}}  .product-content .pro-price span' => 'color: {{VALUE}};',
					'{{WRAPPER}} .product-content .star-rating' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();

		$args = array(
	        'post_type'         => 'product',
	        'posts_per_page'    => $settings['count'],
	        'order'             => $settings['order'],
	        'orderby'           => $settings['orderby'],
			'no_found_rows' 	=> true,
			'tax_query' 		=> array(
				'relation' 		=> 'AND',
			),
	    );

	    // Include/Exclude categories
	    $include = $settings['include_categories'];
	    $exclude = $settings['exclude_categories'];

	    // Include category
		if (  ! empty( $include ) ) {

			// Sanitize category and convert to array
			$include = str_replace( ', ', ',', $include );
			$include = explode( ',', $include );

			// Add to query arg
			$args['tax_query'][] = array(
				'taxonomy' => 'product_cat',
				'field'    => 'slug',
				'terms'    => $include,
				'operator' => 'IN',
			);

		}

		// Exclude category
		if ( ! empty( $exclude ) ) {

			// Sanitize category and convert to array
			$exclude = str_replace( ', ', ',', $exclude );
			$exclude = explode( ',', $exclude );

			// Add to query arg
			$args['tax_query'][] = array(
				'taxonomy' => 'product_cat',
				'field'    => 'slug',
				'terms'    => $exclude,
				'operator' => 'NOT IN',
			);

		}		

		// Start the WP_Query Object/Class
		$the_query = new \WP_Query( $args );
		if ($the_query->have_posts()) : ?>
		    <div class="product-carousel owl-carousel owl-theme">	        
	        	<?php while ( $the_query->have_posts() ) : $the_query->the_post();
	        		$product 	= wc_get_product( $the_query->post->ID ); 
		        	$title 		= $settings['title'];
	            	$image 		= $settings['image'];
	            	$price 		= $settings['price'];
	            	$rating 	= $settings['rating']; ?>		            
                    <div class="product-wrapper">
                    	<?php if ( 'true' == $image ): ?>
	                        <div class="product-image">
	                            <a href="<?php the_permalink();?>">
	                               <?php the_post_thumbnail( 'rt_elementor_woo' );?>
	                            </a>
								<?php if ( $product->is_on_sale() ) : 
									$sale_price = $product->get_sale_price();
									$regular_price=   $product->get_regular_price();

									
									if ( $product->is_type( 'variable' ) ){ 
										$discount = '';
									} else{
									$discount_price = $regular_price-$sale_price;	
									$discount = round(($discount_price / $regular_price) * 100);	
									}								
								?>                            
										<?php if ( !$product->is_in_stock() ) { ?>
											<div class="soldout woocommerce"> 
												<?php
												    global $product;
												 
												    if ( !$product->is_in_stock() ) {
												        echo '<span>' . esc_html__( 'SOLD OUT', 'rt-elementor-widget' ) . '</span>';
												    } 
											    ?>
											</div>	

										<?php } else{ ?>

											<?php if ( $product->is_type( 'variable' ) ){ 
												echo apply_filters( 'woocommerce_sale_flash', '<div class="sales-tag"><span>' .absint( $discount ) . esc_html__( '% off Sale!', 'rt-elementor-widget' ) . '</span></div>', $post, $product ); 
												?>

										<?php  } } ?>
										
										<?php endif; ?>

										<?php if ( !$product->is_in_stock() ) { ?>
											<div class="soldout woocommerce"> 
												<?php
												    global $product;
												 
												    if ( !$product->is_in_stock() ) {
												        echo '<span>' . esc_html__( 'SOLD OUT', 'rt-elementor-widget' ) . '</span>';
												    } 
											    ?>
											</div>
										<?php } ?>
	                            <div class="product-action">									
									<?php woocommerce_template_loop_add_to_cart( $product );?>
									<?php
									if( function_exists( 'YITH_WCWL' ) ){
										$url = add_query_arg( 'add_to_wishlist', $product->get_id() );
									?>
										<a href="<?php echo esc_url($url); ?>" class="single_add_to_wishlist" ><i class="fa fa-heart"></i>
										</a>										
									<?php } ?>

									<?php
									if( function_exists( 'yith_wcqv_init' ) ){
										global $product;
										$product_id = $product->get_id();	
									?>
										<a href="#" class="btn yith-wcqv-button" data-product_id="<?php echo absint( $product_id );?>"><i class="fa fa-eye" aria-hidden="true"></i></a>
									<?php } ?>									
	                            </div>
	                        </div>
                        <?php endif; ?>
                        <div class="product-content">
                        	<?php if ( 'true' == $title ): ?>
	                            <h4 class="entry-title">
	                                <a href="<?php the_permalink(); ?>"><?php the_title();?></a>
	                            </h4>
                        	<?php endif; ?>
                            
                            <?php if ( 'true' == $price ): ?>
								<?php if ( $price_html = $product->get_price_html() ) : ?>
									<div class="pro-price">
										<span class="price"><?php echo wp_kses_post($price_html); ?></span>
									</div>
								<?php endif; ?>   
							<?php endif; ?>   
							<?php if ( 'true' == $rating ): ?>                    
	                            <div class="woocommerce-product-rating woocommerce">
									<?php if ( $rating_html = wc_get_rating_html( $product->get_average_rating() ) ) { ?>
											<?php echo wp_kses_post($rating_html); ?>
										<?php } else {
											echo '<div class="star-rating"></div>' ;
									}?>	
								</div>	
							<?php endif; ?>					
                        </div>
                    </div>	            
	            <?php endwhile;
	            wp_reset_postdata();?>		        
		    </div>	
		<?php endif;  
	}
	protected function _content_template() {
		
	}
}


Plugin::instance()->widgets_manager->register_widget_type( new RT_Widget_Woo_Carousel() );