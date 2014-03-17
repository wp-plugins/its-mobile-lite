
<?php

add_action('admin_menu', 'itsmobile_lite_create_menu');

function itsmobile_lite_create_menu() {

	//create new top-level menu
	add_menu_page('ITS Mobile Lite Einstellungen', 'ITS Mobile', 'administrator', __FILE__, 'itsmobile_lite_settings_page',plugins_url('/images/its-s-14.png', __FILE__));

	$admin_stylesheet = plugins_url( 'css/itsmobile_lite.css', __FILE__ );
	wp_register_style( 'itsmobile_lite_admin_style', $admin_stylesheet );
	wp_enqueue_style( 'itsmobile_lite_admin_style' );
	add_action( 'admin_init', 'register_itsmobile_lite_settings' );
}


function register_itsmobile_lite_settings()
{
	//register our settings
	add_option('itsmobile_lite_color', 'default');
	add_option('itsmobile_lite_styles', 
	'
#its-mobile-wrapper
{
width: 100%; 
padding: 10px;
background: rgba(223, 223, 223, 0.9);
}

#its-mobile-frame
{
   margin: 0;
   width: 100%; 
   height: 600px;
}        
	');
   register_setting( 'its-settings-group', 'itsmobile_lite_link' );
   register_setting( 'its-settings-group', 'itsmobile_lite_color' );
   register_setting( 'its-settings-group', 'itsmobile_lite_styles' );
}

function itsmobile_lite_settings_page()
{
?>
<div class="wrap its_admin_wrap">
  <h2 class="box_50">
    <div class="head_icon_36"></div>
    ITS Mobile Lite
  </h2>
  <div class="box_50">
    <div class=" its_logo"></div>
  </div>
  <div class="clear"></div>
  <div class="box_100">
    <p>
      Um die Mobile.de Einbindung auf einer Seite oder in einem Beitrag anzuzeigen, einfach den Shortcode <strong>[ITSMOBILELITE]</strong> dem Seiten oder Beitragsinhalt hinzufügen.  
    </p>
    <form id="its_mobile_options_form" method="post" action="options.php">
        <?php settings_fields( 'its-settings-group' ); ?>
        <?php do_settings_sections( 'its-settings-group' ); ?>
        <table class="form-table">
            <tr valign="top">
            <th scope="row" colspan="2"><strong>Einstellungen der Mobile.de Einbindung</strong></th>
            </tr>
            <tr valign="top">
            <th scope="row">Mobile.de Bestandslink<br><span style="text_italic">(Finden Sie in Ihrem Mobile.de Administrationsbereich)</span></th>
            <td>
              <input class="form_text" type="text" name="itsmobile_lite_link" value="<?php echo get_option('itsmobile_lite_link'); ?>" />
              z.B. <span class="text_italic">http://home.mobile.de/home/index.html?partnerHead=false&colorTheme=default&customerId=xxxxxx</span>
            </td>
            </tr>
            <tr valign="top">
            <th scope="row">Farbschema der Mobile.de Einbindung</th>
            <td>
              <input class="" type="radio" name="itsmobile_lite_color" value="red" <?php if (get_option('itsmobile_lite_color')=="red") echo "checked"; ?> /> rot <br>
              <input class="" type="radio" name="itsmobile_lite_color" value="blue" <?php if (get_option('itsmobile_lite_color')=="blue") echo "checked"; ?> /> blau <br>
              <input class="" type="radio" name="itsmobile_lite_color" value="green" <?php if (get_option('itsmobile_lite_color')=="green") echo "checked"; ?> /> grün <br>
              <input class="" type="radio" name="itsmobile_lite_color" value="default" <?php if (get_option('itsmobile_lite_color')=="default") echo "checked"; ?> /> standard <br>
            </td>
            </tr>
            <tr valign="top">
            <th scope="row">css styles</th>
            <td>
              <textarea class="form_text" name="itsmobile_lite_styles" rows="5" cols="80"><?php echo get_option('itsmobile_lite_styles'); ?></textarea>
            </td>
            </tr>
         </table>
        
        <?php submit_button(); ?>
    </form>
  </div>
  <div class="box_50">
     <div class="info_box">
        <span class="title_info_box">
          <div class="head_icon_20"></div>
           Zur Pro Version wechseln!
        </span>
        <ul>
           <li>Fahrzeugdarstellung völlig frei anpassbar</li>
           <li>Fahrzeugdaten von Suchmaschinen lesbar (SEO)</li>
           <li>mehrsprachige Fahrzeuginserate</li>
           <li>direkte Verlinkung von Fahrzeugen auf ihrer Homepage ist möglich</li>
           <li>Inserate mit eigenen Daten kombinierbar (z.B. Ansprechpartner mit Bild, automatische konkrete Finanzierungsangebote)
           <li>Such- und Sortierfunktion</li>
           <li>Anbindung an mobile.de über XML API</li>
        </ul>
        <a class="its_morelink" href="http://www.its-gering.de/mobile-inserats-einbindung.php">mehr Informationen</a>
     </div>
  </div>
  <div class="box_50">
     <div class="info_box">
        <span class="title_info_box">
           <div class="head_icon_20"></div>
           ITS Car QR Code
        </span>
        <ul>
           <li>QR Code als Aufkleber für Ihre Fahrzeuge</li>
           <li>alle Fahrzeugdaten auf dem Smartphone ihres Kunden</li>
           <li>keine zusätliche Software oder Dateneingabe notwendig</li>
           <li>einfach ausdrucken und am Fahrzeug anbringen</li>
        </ul>
        <a class="its_morelink" href="http://www.its-gering.de/qrcode-fahrzeughandel.php">mehr Informationen</a>
     </div>
  </div>
  <div class="clear"></div>
</div>  
<?php } ?>