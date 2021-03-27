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

    function __construct()
    {
        add_action( "init", array($this,"custom_post_type") );
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


}


if(class_exists('Admego')){
$admego = new Admego();
}


//Activation
register_activation_hook( __FILE__, array($admego,'activate') );

//Deactivation
register_deactivation_hook(__FILE__,array($admego,'deactivate'));
