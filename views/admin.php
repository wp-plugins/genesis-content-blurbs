<p>
    <label id="<?php echo $this->get_field_id( 'title' ); ?>-label" for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', $this->domain ); ?>:</label>
    <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat" aria-labelledby="<?php echo $this->get_field_id( 'title' ); ?>-label" />
</p>
<p>
    <label for="<?php echo $this->get_field_id( 'lp-blurb' ); ?>"><?php _e( 'Blurb text', $this->domain ); ?>:</label> 
    <textarea class="widefat" name="<?php echo $this->get_field_name( 'lp-blurb' ); ?>" id="<?php echo $this->get_field_id( 'lp-blurb', $this->domain ); ?>" rows="16" cols="20"><?php echo esc_attr( $instance['lp-blurb'] );?></textarea>
</p>
<p>
    <label id="<?php echo $this->get_field_id( 'lp-blurb-image' ); ?>-label" for="<?php echo $this->get_field_id( 'lp-blurb-image' ); ?>"><?php _e( 'Image URL', $this->domain ); ?>:</label>
    <input type="url" id="<?php echo $this->get_field_id( 'lp-blurb-image' ); ?>" name="<?php echo $this->get_field_name( 'lp-blurb-image' ); ?>" value="<?php echo esc_attr( $instance['lp-blurb-image'] ); ?>" class="widefat" aria-labelledby="<?php echo $this->get_field_id( 'lp-blurb-image' ); ?>-label" />
</p>
<p>
    <label id="<?php echo $this->get_field_id( 'lp-blurb-link' ); ?>-label" for="<?php echo $this->get_field_id( 'lp-blurb-link' ); ?>"><?php _e( 'Blurb URL', $this->domain ); ?>:</label><span class="description">Leave blank for no link</span>
    <input type="url" id="<?php echo $this->get_field_id( 'lp-blurb-link' ); ?>" name="<?php echo $this->get_field_name( 'lp-blurb-link' ); ?>" value="<?php echo esc_attr( $instance['lp-blurb-link'] ); ?>" class="widefat" aria-labelledby="<?php echo $this->get_field_id( 'lp-blurb-link' ); ?>-label" />
</p>
<p class="blurb-layouts"> 
    <label><?php _e('Layout:', $this->domain);?></label><br/>
    <label><img class="layout<?php if(esc_attr( $instance['lp-blurb-layout'] ) == 'top'  || esc_attr( $instance['lp-blurb-layout']) == '' ) echo ' selected'; ?>" src="<?php echo plugins_url( 'img/layout-blurb-2.png', __FILE__ );?>"/>
    <input type="radio" name="<?php echo $this->get_field_name( 'lp-blurb-layout' ); ?>" value="top" <?php if( $instance['lp-blurb-layout'] == "" ) echo 'checked'; checked( 'top', esc_attr( $instance['lp-blurb-layout'] ) ); ?> /></label>
    <label><img class="layout<?php if(esc_attr( $instance['lp-blurb-layout'] ) == 'side' ) echo ' selected'; ?>" src="<?php echo plugins_url( 'img/layout-blurb-1.png', __FILE__ );?>"/>
    <input type="radio" name="<?php echo $this->get_field_name( 'lp-blurb-layout' ); ?>" value="side" <?php checked( 'side', esc_attr( $instance['lp-blurb-layout'] ) ); ?> /></label>
</p> 