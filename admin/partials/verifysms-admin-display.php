<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://bexandyrodriguez.com.ve
 * @since      1.0.0
 *
 * @package    Verifysms
 * @subpackage Verifysms/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<form action="options.php" method="POST" accept-charset="utf-8">
	<?php
	settings_fields($this->plugin_name);
	do_settings_sections('verifysms-settings-page');

	submit_button(); 
	?>
</form>