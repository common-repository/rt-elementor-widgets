<?php
/**
 * Rt Blog Module
 */
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	return; // Exit if it is accessed directly
}

class RT_Widget_Blog extends Widget_Base {


	public function get_name() {
		return 'rt-widget-blog';
	}

	public function get_title() {
		return esc_html__( 'Blog', 'rt-elementor-widget' );
	}

	public function get_icon() {
		return 'eicon-gallery-grid';
	}

	public function get_categories() {
		return array( 'rt-elements' );
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'rt_blog_section',
			[
				'label' => __( 'Query', 'rt-elementor-widget' ),
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
				'description' 	=> esc_html__( 'Enter the categories slugs seperated by a "comma"', 'rt-elementor-widget' ),
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
			'post_meta',
			[
				'label' 		=> esc_html__( 'Post Meta', 'rt-elementor-widget' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'true',
				'options' 		=> [
					'true' 		=> esc_html__( 'Show', 'rt-elementor-widget' ),
					'false' 	=> esc_html__( 'Hide', 'rt-elementor-widget' ),
				],
			]
		);		

		$this->add_control(
			'excerpt',
			[
				'label' 		=> esc_html__( 'Excerpt', 'rt-elementor-widget' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'true',
				'options' 		=> [
					'true' 		=> esc_html__( 'Show', 'rt-elementor-widget' ),
					'false' 	=> esc_html__( 'Hide', 'rt-elementor-widget' ),
				],
			]
		);

		$this->add_control(
			'excerpt_length',
			[
				'label' 		=> esc_html__( 'Excerpt Length', 'rt-elementor-widget' ),
				'type' 			=> Controls_Manager::TEXT,
				'default' 		=> '15',
				'label_block' 	=> true,
				'condition' => array(
					'excerpt' => 'true',
				),
			]
		);

		$this->add_control(
			'readmore_text',
			[
				'label' 		=> esc_html__( 'View Details Text', 'rt-elementor-widget' ),
				'type' 			=> Controls_Manager::TEXT,
				'default' 		=> esc_html__( 'View Details', 'rt-elementor-widget' ),
				'label_block' 	=> true,
			]
		);

        $this->end_controls_section();	
		$this->start_controls_section(
			'section_content_wrapper',
			[
				'label' 		=> __( 'Wrapper', 'rt-elementor-widget' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => __( 'Normal', 'elementor' ),
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'selector' => '{{WRAPPER}} .blog-wrap .post',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label' => __( 'Border Radius', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .blog-wrap .post, {{WRAPPER}} .blog-wrap .post' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .blog-wrap .post',
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => __( 'Hover', 'elementor' ),
			]
		);	
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border_hover',
				'selector' => '{{WRAPPER}} .blog-wrap .post:hover',
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_hover_box_shadow',
				'selector' => '{{WRAPPER}} .blog-wrap .post:hover',
			]
		);
			
		$this->end_controls_tab();
        $this->end_controls_section();

		$this->start_controls_section(
			'section_title',
			[
				'label' 		=> __( 'Title', 'rt-elementor-widget' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' 		=> __( 'Color', 'rt-elementor-widget' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .blog-wrap .entry-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_title',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .blog-wrap .entry-title',
			]
		);		

		// Title margin.
		$this->add_responsive_control(
			'title_margin',
			[
				'label'      => __( 'Margin', 'rt-elementor-widget' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .blog-wrap .entry-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);		

        $this->end_controls_section();

		$this->start_controls_section(
			'section_content',
			[
				'label' 		=> __( 'Content', 'rt-elementor-widget' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'content_color',
			[
				'label' 		=> __( 'Color', 'rt-elementor-widget' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .blog-wrap .entry-content' => 'color: {{VALUE}};',
				],
			]
		);		

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_content',
				'scheme' => Scheme_Typography::TYPOGRAPHY_2,
				'selector' => '{{WRAPPER}} .blog-wrap .entry-content',
			]
		);		

		$this->end_controls_section();


		$this->start_controls_section(
			'section_button',
			[
				'label' 		=> __( 'Button', 'rt-elementor-widget' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_button',
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .blog-wrap .box-button',
			]
		);
		$this->add_control(
			'button_bg_color',
			[
				'label' 		=> __( 'Background Color', 'rt-elementor-widget' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .blog-wrap .box-button' => 'background: {{VALUE}};',
					'{{WRAPPER}} .blog-wrap .box-button:hover span' => 'background: {{VALUE}};',
				],
			]
		);	
		$this->add_control(
			'button_bg_color_hover',
			[
				'label' 		=> __( 'Background Hover Color', 'rt-elementor-widget' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .blog-wrap .box-button:hover' => 'background: {{VALUE}};',
					'{{WRAPPER}} .blog-wrap .box-button span' => 'background: {{VALUE}};',
				],
			]
		);							
		$this->add_control(
			'button_color',
			[
				'label' 		=> __( 'Color', 'rt-elementor-widget' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .blog-wrap .box-button' => 'color: {{VALUE}};',
					'{{WRAPPER}} .blog-wrap .box-button:hover span' => 'color: {{VALUE}};',
				],
			]
		);			

		$this->add_control(
			'button_color_hover',
			[
				'label' 		=> __( 'Hover Color', 'rt-elementor-widget' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .blog-wrap .box-button:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .blog-wrap .box-button span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_border_color',
			[
				'label' 		=> __( 'Border Color', 'rt-elementor-widget' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .blog-wrap .box-button' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .blog-wrap .box-button:hover span' => 'border-color: {{VALUE}};',
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
	        'post_type'         => 'post',
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
				'taxonomy' => 'category',
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
				'taxonomy' => 'category',
				'field'    => 'slug',
				'terms'    => $exclude,
				'operator' => 'NOT IN',
			);

		}		

		// Start the WP_Query Object/Class
		$the_query = new \WP_Query( $args );
		if ($the_query->have_posts()) : ?>
		    <div class="blog-wrap rt-clearfix">		        
	        	<?php while ( $the_query->have_posts() ) : $the_query->the_post();
		        	$title 		= $settings['title'];
	            	$image 		= $settings['image'];
	            	$excerpt 	= $settings['excerpt'];
	            	$post_meta 	= $settings['post_meta']; ?>		            
	                <div class="post">
                    	<?php if ( has_post_thumbnail() && 'true' === $image ): ?>
	                        <div class="image-section">
	                            <figure class="featured-image">
	                                <?php the_post_thumbnail( 'rt_elementor_blog' ); ?>
	                            </figure>
	                        </div>
                        <?php endif; ?>			                    
	                    <div class="post-content">
	                        <header class="entry-header">
	                        	<?php if ( 'true' == $post_meta ): ?>
		                            <div class="entry-meta">
		                                <?php rt_elementor_widget_posted_on(); ?>
		                            </div>
	                            <?php endif; ?>
                            	<?php if ( 'true' === $title ): ?>			                                
	                                    <h3 class="entry-title">
	                                       <?php the_title(); ?>
	                                    </h3>			                                
                                <?php endif; ?>	 			                            
	                        </header>
	                        <div class="entry-content">
                           		<?php if ( 'true' === $excerpt ): ?>		                                
                                    <p><?php rt_elementor_widget_excerpt( absint( $settings['excerpt_length'] ) );	?></p>
                                <?php endif; ?>

								<?php if ( !empty($settings['readmore_text'] ) ): ?>
                                	<a href="<?php the_permalink(); ?>" class="box-button"><span></span><?php echo esc_html( $settings['readmore_text']);?></a>
                            	<?php endif;?>	
                            </div>	                                
	                    </div>
	                </div>		            
	            <?php endwhile;
	            wp_reset_postdata();?>		        
		    </div>	
		<?php endif;  
	}

}

Plugin::instance()->widgets_manager->register_widget_type( new RT_Widget_Blog() );