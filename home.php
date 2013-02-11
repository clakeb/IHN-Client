<?php

/*----------------------------------------------------------
                    The Hooks & Filters
----------------------------------------------------------*/
    // Theme Support
    
    // Remove Actions
    remove_action( 'genesis_loop', 'genesis_do_loop' );

    // Remove Filters

    // Add Actions
    add_action( 'genesis_loop', 'as_do_home_loop' );

    // Add Filters


/*----------------------------------------------------------
                    The Functions
----------------------------------------------------------*/
    // Place all Functions here that are used in custom hooks or filters
    function as_do_home_loop() {
        if ( !is_user_logged_in() ) {
            echo 'Log in to begin managing customers.';
            $args = array(
                'echo' => true,
                'redirect' => site_url( $_SERVER['REQUEST_URI'] ), 
                'form_id' => 'loginform',
                'label_username' => __( 'Username' ),
                'label_password' => __( 'Password' ),
                'label_remember' => __( 'Remember Me' ),
                'label_log_in' => __( 'Log In' ),
                'id_username' => 'user_login',
                'id_password' => 'user_pass',
                'id_remember' => 'rememberme',
                'id_submit' => 'wp-submit',
                'remember' => true,
                'value_username' => NULL,
                'value_remember' => false,
            );

            return wp_login_form( $args );
        } else {
            global $wpdb;
            $wp_users = ($wpdb->get_results("
                SELECT users.*, meta.user_id, meta.meta_value
                FROM $wpdb->users AS users LEFT JOIN $wpdb->usermeta AS meta
                    ON users.ID = meta.user_id
                WHERE meta.meta_key = 'last_name'
                    AND meta.meta_value != ''
                ORDER BY meta.meta_value ASC
            ")); ?>

            <ul class="asclient_navigation"> <?php
                foreach (range('A', 'Z') as $i)
                    echo "<li><a href='#$i'>$i</a></li>"; ?>
            </ul> <?php
            foreach ($wp_users as $wp_user) :

                $cur_first_letter = substr( $wp_user->meta_value, 0, 1 );

                if( strtoupper( $cur_first_letter ) != strtoupper( $prev_first_letter ) ) {
                    echo "<h3 id='$cur_first_letter' class='alpha-heading'>$cur_first_letter</h3>";
                }

                echo '<p><a href="' . get_permalink( 54 ) . '?client=' . $wp_user->user_id . '">' . get_usermeta( $wp_user->user_id, "last_name" ) . ', ' . get_usermeta( $wp_user->user_id, "first_name" ) . '</a></p>';

                $prev_first_letter = $cur_first_letter;

            endforeach;
        }
    }

/*----------------------------------------------------------
                    The Genesis
----------------------------------------------------------*/
    // Add everything above this line.
    genesis();