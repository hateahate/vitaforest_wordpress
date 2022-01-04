<tr>
	<th scope="row"><?php _e( 'Method of language detection', 'translatepress-multilingual' ); ?> </th>
	<td>
		<select id="trp-ald-detection-method" name="trp_ald_settings[detection-method]" class="trp-select">
            <?php
                foreach ( $detection_methods as $value => $label ) {
            ?>
                    <option value="<?php echo $value; ?>" <?php selected( $ald_settings['detection-method'], $value ); ?>><?php echo $label; ?></option>
            <?php
                }
            ?>
		</select>
		<p class="description">
			<?php _e( "Select how the language should be detected for first time visitors.<br>The visitor's last displayed language will be remembered through cookies." , 'translatepress-multilingual' ); ?>
        </p>
		<?php echo $ip_warning_message;  ?>
    </td>

</tr>