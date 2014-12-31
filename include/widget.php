<?php

    //Registra widget del tema Pasw2015 Child @ 30.11.2014

    add_action( 'widgets_init', 'pasw2015_child_load_widgets' );

    function pasw2015_child_load_widgets() {
        register_widget( 'pasw2015_child_sticky' );
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

?>
