<?php
/**
 * Addify Add to Quote Fields
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/addify/rfq/front/quote-fields.php.
 *
 * @package addify-request-a-quote
 * @version 1.6.0
 */

defined( 'ABSPATH' ) || exit;

$user_id = get_current_user_id();

$quote_fields_obj = new AF_R_F_Q_Quote_Fields();
$quote_fields     = (array) $quote_fields_obj->quote_fields;
$cache_data       = wc()->session->get('quote_fields_data' );
$num = 1;
?>

<table class="quote-fields">

	<?php
	foreach ( $quote_fields as $key => $field ) :

		$field_id = $field->ID;

		$afrfq_field_name        = get_post_meta( $field_id, 'afrfq_field_name', true );
		$afrfq_field_type        = get_post_meta( $field_id, 'afrfq_field_type', true );
		$afrfq_field_label       = get_post_meta( $field_id, 'afrfq_field_label', true );
		$afrfq_field_value       = get_post_meta( $field_id, 'afrfq_field_value', true );
		$afrfq_field_title       = get_post_meta( $field_id, 'afrfq_field_title', true );
		$afrfq_field_placeholder = get_post_meta( $field_id, 'afrfq_field_placeholder', true );
		$afrfq_field_options     = (array) get_post_meta( $field_id, 'afrfq_field_options', true );
		$afrfq_file_types        = get_post_meta( $field_id, 'afrfq_file_types', true );
		$afrfq_file_size         = get_post_meta( $field_id, 'afrfq_file_size', true );
		$afrfq_field_enable      = get_post_meta( $field_id, 'afrfq_field_enable', true );

		if ( isset( $cache_data[ $afrfq_field_name ] ) ) {
			$field_data = $cache_data[ $afrfq_field_name ];
		} else {
			$field_data = $quote_fields_obj->get_field_default_value( $field_id, $user_id );
		}

		if ( empty( $afrfq_field_name ) ) {
			continue;
		}

		$required = 'yes' === get_post_meta( $field_id, 'afrfq_field_required', true ) ? 'required=required' : '';

		?>
		<tr class="addify-option-field feild<? echo $num; $num++; ?>">
			<th>
				<?php echo esc_html( $afrfq_field_label ); ?><? $reqdata = esc_attr( $required ); if($num == 2 or $num == 3 or $num == 4 or $num == 6 or $num == 7){ echo '<span style="color: red;"> *</span>';} ?>
			</th>
			<td>
				<?php
				switch ( $afrfq_field_type ) {
					case 'text':
						?>
							<input type="text" placeholder="<?php echo esc_html( $afrfq_field_placeholder ); ?>" name="<?php echo esc_html( $afrfq_field_name ); ?>" value="<?php echo esc_html( $field_data ); ?>" <?php echo esc_attr( $required ); ?> >
						<?php
						break;
					case 'email':
						?>
							<input type="email" placeholder="<?php echo esc_html( $afrfq_field_placeholder ); ?>" name="<?php echo esc_html( $afrfq_field_name ); ?>" value="<?php echo esc_html( $field_data ); ?>" <?php echo esc_attr( $required ); ?> >
						<?php
						break;
					case 'number':
						?>
							<input type="number" placeholder="<?php echo esc_html( $afrfq_field_placeholder ); ?>" name="<?php echo esc_html( $afrfq_field_name ); ?>" value="<?php echo esc_html( $field_data ); ?>" <?php echo esc_attr( $required ); ?> >
						<?php
						break;
					case 'file':
						$types = array();
						foreach ( (array) explode( ',', $afrfq_file_types ) as $file_type ) {
							$types[] = strtolower( $file_type );
							$types[] = strtoupper( $file_type );
						}

						$pattern = '([a-zA-Z0-9\s_\\.\-\(\):]).+(' . implode( '|', $types ) . ')$';
						?>
						<input type="file" placeholder="<?php echo esc_html( $afrfq_field_placeholder ); ?>" name="<?php echo esc_html( $afrfq_field_name ); ?>" value="<?php echo esc_html( $field_data ); ?>" <?php echo esc_attr( $required ); ?> >
						<?php
						break;
					case 'textarea':
						?>
							<textarea placeholder="<?php echo esc_html( $afrfq_field_placeholder ); ?>" name="<?php echo esc_html( $afrfq_field_name ); ?>" <?php echo esc_attr( $required ); ?> ><?php echo esc_html( $field_data ); ?></textarea>
						<?php
						break;
					case 'select':
						?>
							<select name="<?php echo esc_html( $afrfq_field_name ); ?>" <?php echo esc_attr( $required ); ?> >
							<?php
							foreach ( (array) $afrfq_field_options as $option ) :
								$value = strtolower( trim( $option ) );
								?>
									<option value="<?php echo esc_html( $value ); ?>" <?php echo selected( $value, $field_data ); ?> ><?php echo esc_html( $option ); ?></option>
								<?php endforeach; ?>
							</select>
						<?php
						break;
					case 'multiselect':
						?>
							<select placeholder="<?php echo esc_html( $afrfq_field_placeholder ); ?>" name="<?php echo esc_html( $afrfq_field_name ); ?>[]" multiple <?php echo esc_attr( $required ); ?> >
							<?php
							foreach ( (array) $afrfq_field_options as $option ) :
								$value = strtolower( trim( $option ) );
								?>
									<option value="<?php echo esc_html( $value ); ?>" <?php echo in_array( $value, (array) $field_data, true ) ? 'selected' : ''; ?> > <?php echo esc_html( $option ); ?>
									</option>
								<?php endforeach; ?>
							</select>
						<?php
						break;
					case 'radio':
						foreach ( (array) $afrfq_field_options as $option ) :
							$value = strtolower( trim( $option ) );
							?>
								<input placeholder="<?php echo esc_html( $afrfq_field_placeholder ); ?>" type="radio" name="<?php echo esc_html( $afrfq_field_name ); ?>" value="<?php echo esc_html( $value ); ?>" <?php echo checked( $value, $field_data ); ?> <?php echo esc_attr( $required ); ?> ><?php echo esc_html( $option ); ?>
								<br>
							<?php
						endforeach;
						break;
					case 'checkbox':
						?>
							<input placeholder="<?php echo esc_html( $afrfq_field_placeholder ); ?>" type="checkbox" name="<?php echo esc_html( $afrfq_field_name ); ?>" value="yes" <?php echo esc_attr( $required ); ?> <?php echo checked( 'yes', $field_data ); ?> >
						<?php
						break;
				}
				?>
			</td>
		</tr>

	<?php endforeach; ?>

</table>
<? if(is_user_logged_in( )){

}
else{
    echo '<p class="required-notification-quote">
	* Required fields
</p>

<div class="quote-agreement">
<input id="request-checkbox" type="checkbox" required>
<label class="i-agree-quote" for="request-checkbox">
	I agree to the <a href="/privacy-policy">Privacy Policy</a>
	</label>
</div>'; 
}