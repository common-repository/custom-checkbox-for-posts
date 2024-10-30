<?php
/*
 * Plugin Name: Custom Checkbox for Posts
 * Description: A custom plugin to add the Checkbox to Posts
 * Version: 1.0
 * Author: Khadija Saleem
 * Author URI: http://khadijasaleem027.wix.com/portfolio
*/

//Adds a meta box to the admin area of post
function acp_api_checkbox_meta() {
    add_meta_box( 'acp_meta', __( 'API Checkbox', 'acp-textdomain' ), 'acp_meta_callback', 'post', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'acp_api_checkbox_meta' );

//The checkbox view
function acp_meta_callback( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'acp_nonce' );
    $acp_stored_meta = get_post_meta( $post->ID );
    ?>

    <p>
        <span class="acp-row-title"><?php _e( 'Check if this is a api-checkbox post: ', 'acp-textdomain' )?></span>
        <div class="acp-row-content">
            <label for="api-checkbox-checkbox">
                <input type="checkbox" name="api-checkbox-checkbox" id="api-checkbox-checkbox" value="yes" <?php if ( isset ( $acp_stored_meta['api-checkbox-checkbox'] ) ) checked( $acp_stored_meta['api-checkbox-checkbox'][0], 'yes' ); ?> />
                <?php _e( 'API Checkboxed Post', 'acp-textdomain' )?>
            </label>

        </div>
    </p>   

    <?php
}


//function when save button clicks
function custom_checkbox_api_function( $post_id ) {
 
    $post_title = get_the_title( $post_id );
    $post_url = get_permalink( $post_id );
    $post_slug = basename( get_permalink() );
 
    // checking if checkbox is checked
    if( isset( $_POST[ 'api-checkbox-checkbox' ] ) ) {

        //right now I am inserting the data into db if checkbox is checked. Now you can remove the following line and add your function code below.
        update_post_meta( $post_id, 'api-checkbox-checkbox', 'yes');
        //your function should end before this }
    } 
    //if the checkbox is unchecked
    else{
        //remove the following if you don't want anything to happen if checkbox is unchecked.
        update_post_meta( $post_id, 'api-checkbox-checkbox', 'no' );
    }
}
add_action( 'save_post', 'custom_checkbox_api_function' );

