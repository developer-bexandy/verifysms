<!-- admin/partial/ verifysms-admin-page.php. -->
 
<h2><?php esc_attr_e( 'Twilio Verify Phone Verification', 'WpAdminStyle' ); ?></h2>
 
<?php $display_request = (isset($_POST['request_verification']) ) ? 'style="display:none;"' : ''; ?>
<div class="wrap" <?php echo $display_request ?>>
	<div id="icon-options-general" class="icon32"></div>
    <div id="poststuff">
    	<div id="post-body" class="metabox-holder columns-2">
        <!-- main content -->
        	<div id="post-body-content">
            	<div class="meta-box-sortables ui-sortable">
                	<div class="postbox">
                    	<h2 class="hndle"><span><?php esc_attr_e( 'SEND VERIFICATION REQUEST', 'WpAdminStyle' ); ?></span></h2>
                        <div class="inside">
                        	<form method="post" name="cleanup_options" action="" >
                            	<input type="text" name="country_code" placeholder="Country Code" size="4" required/>
                            	<input type="text" name="phone_number" class="regular-text" placeholder="+2348059794251" required/>
                                <select name="via" class="form-control">
                                    <option value="sms" selected="selected">SMS</option>
                                     <option value="call">CALL</option>
                                    </select>
                                <br><br>
                                <input class="button-primary" type="submit" value="Request Verification" name="request_verification"/>
                            </form>
                        </div>	<!-- .inside -->
                    </div>	<!-- .postbox -->
                </div>	<!-- .meta-box-sortables .ui-sortable -->
            </div>	<!-- post-body-content -->
        </div>	<!-- #post-body .metabox-holder .columns-2 -->
        <br class="clear">
    </div>	<!-- #poststuff -->
</div>	<!-- .wrap -->

<?php $display_token = (!isset($_POST['request_verification']) ) ? 'style="display:none;"' : ''; ?>
<div class="wrap" <?php echo $display_token ?>>
    <div id="icon-options-general" class="icon32"></div>
    <div id="poststuff">
        <div id="post-body" class="metabox-holder columns-2">
        <!-- main content -->
            <div id="post-body-content">
                <div class="meta-box-sortables ui-sortable">
                    <div class="postbox">
                        <h2 class="hndle"><span><?php esc_attr_e( 'PHONE VERIFICATION', 'WpAdminStyle' ); ?></span></h2>
                        <div class="inside">
                            <form method="post" name="cleanup_options" action="" >
                                <input type="text" name="token" class="form-control" placeholder="Verification Token">
                                <input class="button-primary" type="submit" value="Verify Phone" name="verify_token"/>
                            </form>
                        </div>  <!-- .inside -->
                    </div>  <!-- .postbox -->
                </div>  <!-- .meta-box-sortables .ui-sortable -->
            </div>  <!-- post-body-content -->
        </div>  <!-- #post-body .metabox-holder .columns-2 -->
        <br class="clear">
    </div>  <!-- #poststuff -->
</div>  <!-- .wrap -->
