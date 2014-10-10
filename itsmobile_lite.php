<?php
/*
Plugin Name: ITS Mobile Lite
Plugin URI: www.its-gering.de/its-mobile-lite.php
Description: Integration des mobile.de Fahrzeugbestandes in Wordpress über den mobile.de Bestandslink, shortcode [ITSMOBILELITE]
Version: 1.0
Author: Alexander Gering
URI: www.its-gering.de
License: GPLv2 
*/
/*  Copyright 2014  Alexander Gering (email : info@its-gering.de)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

include 'itsmobile_lite_options.php';

function itsmobile_lite_register_plugin_styles()
{
   wp_register_style( 'itsmobile_lite_style', plugins_url( 'css/itsmobile_lite.css', __FILE__ ) ) ;
   wp_enqueue_style( 'itsmobile_lite_style' );
}

function itsmobile_lite_start() 
{
   
   if(get_option('itsmobile_lite_link')&&get_option('itsmobile_lite_link')!="")
   {
      $mobile_link=get_option('itsmobile_lite_link');
   }
   else unset($mobile_link);
   
   if(get_option('itsmobile_lite_color')&&get_option('itsmobile_lite_color')!="")
   {
      $mobile_color=get_option('itsmobile_lite_color');
   }
   else $mobile_color="default";
   
   if(get_option('itsmobile_lite_styles')&&get_option('itsmobile_lite_styles')!="")
   {
      $mobile_styles=get_option('itsmobile_lite_styles');
   }
   else unset($mobile_styles);
   
   
   
   if(isset($mobile_link))
   {
      $url_array = parse_url ( $mobile_link );
      $query_para=array();
      parse_str($url_array['query'], $query_para);
      if(isset($mobile_color))
      {
         if(array_key_exists('colorTheme', $query_para)) 
         {
            $query_para['colorTheme']=$mobile_color;
         }
      }
      
      $new_query="";
      $para_count=0;
      while(list($key,$val)=each($query_para))
      {
         if($para_count!=0) $new_query.="&";
         $new_query.= $key."=".$val;
         $para_count++;
      }
      $url_array['query']=$new_query;
      
      $mobile_link="http://".$url_array['host'].$url_array['path']."?".$url_array['query'];
   }
?>

<?php 
   if(isset($mobile_styles))
   {
?>
      <style type="text/css">
<?php       
      echo $mobile_styles;
?>
      </style>
<?php       
   }
?>

	<div id="its-mobile-wrapper">
<?php 
   if(isset($mobile_link))
   {
?>               
      <iframe id="its-mobile-frame" src="<?php echo $mobile_link;?>"></iframe>
<?php 
   }
   else echo "<p>Unser Fahrzeugangebot steht Ihnen in Kürze zur Verfügung.</p>"

?>    		
   </div>    
<?php  
}
 

add_action( 'wp_enqueue_scripts', 'itsmobile_lite_register_plugin_styles' );
add_shortcode('ITSMOBILELITE', 'itsmobile_lite_start');

?>