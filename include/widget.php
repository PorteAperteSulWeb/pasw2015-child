<?php

    //Registra widget del tema Pasw2015 Child @ 30.11.2014

    add_action( 'widgets_init', 'pasw2015_child_load_widgets' );

    function pasw2015_child_load_widgets() {
        register_widget( 'pasw2015_child_sticky' );
		//register_widget( 'pasw2015_child_posts' );
	}

    class pasw2015_child_sticky extends WP_Widget {

        function pasw2015_child_sticky() {
            parent::__construct( false, 'PASW @ Sticky Post' );
        }

        function widget( $args, $instance ) {

            extract( $args );
               // these are the widget options
            $title = apply_filters('widget_title', $instance['titolo']);
            $limit = $instance['limite'];
            $excerpt = $instance['riassunto'];
            $thumbnail = $instance['imgevidenza'];

            if ( $title ) {
                echo $before_widget . $before_title . $title . $after_title;
            }

            echo '<ul class="sticky_column"';
            if ($align != '' && $align != 0) { echo ' style="text-align:center;"'; }
            echo '>';
			
			$sticky = get_option( 'sticky_posts' );
			$args = array(
				'posts_per_page' => $limit,
				'post__in'  => $sticky,
				'ignore_sticky_posts' => $limit
			);
			
            global $post;
            $myposts = get_posts($args);
            foreach($myposts as $post) :
                    setup_postdata($post);
                    global $more;
                    $more = 0;
            ?>
                <li>
                	<div class="imgblock">
                    	<?php
                        if ( has_post_thumbnail() && $thumbnail ) {
                            the_post_thumbnail(array(80,80));
                        }
						else
						{
							?> <img src="<?php echo get_stylesheet_directory_uri() ?>/icone/importante.png" alt="immagine importante" /> <?php
						}?>
                    </div>
                    <div class="detail">
                    	<h3><span class="hdate"><?php the_time('j M y') ?></span> <a href="<?php the_permalink(); ?>">
                        <?php the_title(); ?></a></h3>
                        <?php if ($excerpt != '' && $excerpt != 0) { the_excerpt(); }?>
                    </div>
                                 
            <?php
                    
            endforeach;

            echo '</ul>';

            //FINE WIDGET

            echo $after_widget;
        }

        function update( $new_instance, $old_instance ) {

            $instance = $old_instance;
            $instance['titolo'] = strip_tags($new_instance['titolo']);
            $instance['limite'] = strip_tags($new_instance['limite']);
            $instance['riassunto'] = strip_tags($new_instance['riassunto']);
            $instance['imgevidenza'] = strip_tags($new_instance['imgevidenza']);
            return $instance;

        }

        function form( $instance ) {

            $instance = wp_parse_args( (array) $instance, array( 'limite' => '0' ) ); ?>

            <p>
                <label for="<?php echo $this->get_field_id( 'titolo' ); ?>">Titolo:</label>
                <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'titolo' ); ?>" name="<?php echo $this->get_field_name( 'titolo' ); ?>" value="<?php echo $instance['titolo']; ?>" />
            </p>

            <p>
                <label for="<?php echo $this->get_field_id( 'limite' ); ?>">Numero post visualizzati:</label>
                <input type="number" min="1" max="10" class="widefat" id="<?php echo $this->get_field_id( 'limite' ); ?>" name="<?php echo $this->get_field_name( 'limite' ); ?>" value="<?php echo $instance['limite']; ?>" />
            </p>

            
            <p>
                <input id="<?php echo $this->get_field_id('riassunto'); ?>" name="<?php echo $this->get_field_name('riassunto'); ?>" type="checkbox" value="1" <?php checked( '1', esc_attr($instance['riassunto'])); ?>/>
                <label for="<?php echo $this->get_field_id('riassunto'); ?>">Mostra anteprima testuale</label>
            </p>

            <p>
                <input id="<?php echo $this->get_field_id('imgevidenza'); ?>" name="<?php echo $this->get_field_name('imgevidenza'); ?>" type="checkbox" value="1" <?php checked( '1', esc_attr($instance['imgevidenza'])); ?>/>
                <label for="<?php echo $this->get_field_id('imgevidenza'); ?>">Mostra immagine in evidenza</label>
            </p>
<?php
        }
    }
    class pasw2015_child_posts extends WP_Widget {

        function pasw2015_child_posts() {
            parent::__construct( false, 'PASW-Child @ Categorie' );
        }

        function widget( $args, $instance ) {

            extract( $args );
               // these are the widget options
            $title = apply_filters('widget_title', $instance['titolo']);
            $limit = $instance['limite'];
            $category = $instance['categoria'];
            $align = $instance['allineamento'];
            $excerpt = $instance['riassunto'];
            $thumbnail = $instance['imgevidenza'];
      		$showall = $instance['showall'];

			if ($showall) {
				$category_id = $category;
				$category_link = get_category_link($category_id);
				$category_name = get_cat_name($category_id);
							?>
				<!-- Print a link to this category
				<a href="<?php echo esc_url( $category_link ); ?>" title="Tutti gli articoli della categoria <?php echo $category_name; ?>">Mostra <?php echo $category_name; ?></a> 
				-->

				<?php
			$after_title = '<span class="showall_widget after_widget_title"><a href='. esc_url( $category_link ) .' title="Tutti gli articoli della categoria '. $category_name . '" >Mostra Tutto &rsaquo;</a></span>'.$after_title;
			}

            

            if ( $title ) {
                echo $before_widget . $before_title . $title . $after_title;
            }

            echo '<ul';
            if ($align != '' && $align != 0) { echo ' style="text-align:center;"'; }
            echo '>';

            global $post;
            $myposts = get_posts('numberposts=' . $limit . '&category='.$category);
            foreach($myposts as $post) :
                    setup_postdata($post);
                    global $more;
                    $more = 0;
            ?>
                <li><h3><span class="hdate"><?php the_time('j M y') ?></span> <a href="<?php the_permalink(); ?>">

                    <?php
                        if ( has_post_thumbnail() && $thumbnail ) {
                            the_post_thumbnail(array(50,50));
                        }
                        the_title(); ?></a></h3></li>
                          <?php
                          if ($excerpt != '' && $excerpt != 0) { echo '<li>'; the_excerpt(); echo '</li>';} //echo '<div class="clear"></div>';
            endforeach;

            echo '</ul>';

            //FINE WIDGET

            echo $after_widget;
        }

        function update( $new_instance, $old_instance ) {

            $instance = $old_instance;
            $instance['titolo'] = strip_tags($new_instance['titolo']);
              $instance['categoria'] = strip_tags($new_instance['categoria']);
              $instance['limite'] = strip_tags($new_instance['limite']);
              $instance['riassunto'] = strip_tags($new_instance['riassunto']);
              $instance['allineamento'] = strip_tags($new_instance['allineamento']);
              $instance['imgevidenza'] = strip_tags($new_instance['imgevidenza']);
              $instance['showall'] = strip_tags($new_instance['showall']);
              return $instance;

        }

        function form( $instance ) {

            $instance = wp_parse_args( (array) $instance, array( 'limite' => '0' ) ); ?>

            <p>
                <label for="<?php echo $this->get_field_id( 'titolo' ); ?>">Titolo:</label>
                <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'titolo' ); ?>" name="<?php echo $this->get_field_name( 'titolo' ); ?>" value="<?php echo $instance['titolo']; ?>" />
            </p>

            <p>
                <label for="<?php echo $this->get_field_id( 'limite' ); ?>">Numero post visualizzati:</label>
                <input type="number" min="1" max="10" class="widefat" id="<?php echo $this->get_field_id( 'limite' ); ?>" name="<?php echo $this->get_field_name( 'limite' ); ?>" value="<?php echo $instance['limite']; ?>" />
            </p>

            <p>
                <label for="<?php echo $this->get_field_id( 'categoria' ); ?>">Categoria:</label>
				<?php 
				$args = array( 
						'name' => $this->get_field_name("categoria"),
						'hierarchical' => 1, 
						'orderby' => 'name', 
						'selected' => $instance["categoria"] 
						);
				
				wp_dropdown_categories( $args ); ?>
            </p>
            <p>
                <input id="<?php echo $this->get_field_id('riassunto'); ?>" name="<?php echo $this->get_field_name('riassunto'); ?>" type="checkbox" value="1" <?php checked( '1', esc_attr($instance['riassunto'])); ?>/>
                <label for="<?php echo $this->get_field_id('riassunto'); ?>">Mostra anteprima testuale</label>
            </p>

            <p>
                <input id="<?php echo $this->get_field_id('imgevidenza'); ?>" name="<?php echo $this->get_field_name('imgevidenza'); ?>" type="checkbox" value="1" <?php checked( '1', esc_attr($instance['imgevidenza'])); ?>/>
                <label for="<?php echo $this->get_field_id('imgevidenza'); ?>">Mostra immagine in evidenza</label>
            </p>
            
			<p>
                <input id="<?php echo $this->get_field_id('showall'); ?>" name="<?php echo $this->get_field_name('showall'); ?>" type="checkbox" value="1" <?php checked( '1', esc_attr($instance['showall'])); ?>/>
                <label for="<?php echo $this->get_field_id('showall'); ?>">Mostra link visualizza tutto</label>
            </p>

            <p>
                <input id="<?php echo $this->get_field_id('allineamento'); ?>" name="<?php echo $this->get_field_name('allineamento'); ?>" type="checkbox" value="1" <?php checked( '1', esc_attr($instance['allineamento'])); ?>/>
                <label for="<?php echo $this->get_field_id('allineamento'); ?>">Allinea testo centralmente</label>
            </p>

<?php
        }
    }

?>
