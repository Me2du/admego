<?php
/*
@package    Admego
*/

/*
Plugin Name:Admego
Plugin URI:http://mysizzlers.co.uk
Description: Hello This is my first plugin and This program is free software. You can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
version:1.0.0
Author:Mithu Khan
Author URI:http://mysizzlers.co.uk/author
License:GPLv2 or later
Text Domain:Admego domain
*/

/*
This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
*/

defined('ABSPATH') or die ('You have no right to access this file');

class Admego{
    public $pluginUrl;
    function __construct()
    {
        add_action( "init", array($this,"custom_post_type") );
        $this->pluginUrl = plugin_basename(__FILE__);
    }
    function register(){
        add_action( "admin_enqueue_scripts",array($this,'enqueue') );
        add_action( "wp_enqueue_scripts",array($this,'enqueue_front') );
        add_action( 'admin_menu', array($this,'add_admin_page') );

        add_filter( "plugin_action_links_$this->pluginUrl",array($this,'filter_index') );
    }

    function filter_index($links){
        $settings_link = '<a href="admin.php?page=mithu_page">settings</a>';
        array_push( $links, $settings_link );
        return $links;
    }

    function add_admin_page(){
        add_menu_page("mithu", "Mithu", "manage_options", "mithu_page", array($this,"admin_index"),"", 110);
    }

    function admin_index(){
        echo "<h3>Mithu Khan</h3>";
    }
   
    function activate(){
        //generate Custom Post Type -(done with custom_post_type method and fallback security again call method)
        $this->custom_post_type();
        //Flush rewrite rules
        flush_rewrite_rules();
    }

    function deactivate(){
        //Flush rewrite rules
        flush_rewrite_rules();
    }

    function custom_post_type(){
        register_post_type('book', array("public"=>true,"label"=>"Books"));
    }

    function enqueue(){
        wp_enqueue_style('mystyle',plugins_url( "/assets/mystyle.css",__FILE__ ) );
        wp_enqueue_script('myscript',plugins_url( "/assets/myscript.js",__FILE__ ) );
    }
    function enqueue_front(){
        wp_enqueue_style('mystyle_front',plugins_url( "/assets/mystylefront.css",__FILE__ ) );
    }

}


if(class_exists('Admego')){
$admego = new Admego();
$admego->register();
}


//Activation
register_activation_hook( __FILE__, array($admego,'activate') );

//Deactivation
register_deactivation_hook(__FILE__,array($admego,'deactivate'));
