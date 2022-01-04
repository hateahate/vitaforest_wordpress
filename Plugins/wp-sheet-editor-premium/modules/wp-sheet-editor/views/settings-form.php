<h3><?php _e('Advanced Settings', VGSE()->textname); ?></h3>
<div class="wpse-settings-form-wrapper">

	<div class="tabs-links">
		<?php
		foreach ($sections as $section) {
			$section_id = sanitize_html_class($section['title']);
			?>
			<a href="#<?php echo $section_id; ?>"><?php echo esc_html($section['title']); ?></a>
		<?php }
		?>	
		<a href="#reset-settings"><?php _e('Reset settings', VGSE()->textname); ?></a>
		<?php do_action('vg_sheet_editor/settings/after_tab_links', $provider, $sections); ?>
	</div>
	<form class="wpse-set-settings tabs-content" data-reload-after-success="1">
		<?php
		foreach ($sections as $section) {
			$section_id = sanitize_html_class($section['title']);
			?>
			<div class="<?php echo $section_id; ?> tab-content">
				<?php
				foreach ($section['fields'] as $field) {
					$section_id = sanitize_html_class($section['title']);
					$value = isset(VGSE()->options[$field['id']]) ? VGSE()->options[$field['id']] : '';
					$input_type = !empty($field['validate']) && $field['validate'] === 'numeric' ? 'number' : 'text';
					?>
					<div class="field-wrapper">
						<label for="<?php echo esc_attr($field['id']); ?>">
							<?php if ($field['type'] === 'switch') { ?>
								<input name="<?php echo esc_attr($field['id']); ?>" type="hidden" value=""/>
								<input id="<?php echo esc_attr($field['id']); ?>"  name="<?php echo esc_attr($field['id']); ?>" type="checkbox" value="1" <?php checked(1, (int) $value); ?> />
							<?php } ?> 
							<?php echo esc_html($field['title']); ?>

							<?php if (!empty($field['desc'])) { ?>
								<a href="#" class="tipso" data-tipso="<?php echo esc_attr($field['desc']); ?>">( ? )</a>
							<?php } ?>
						</label>

						<?php if ($field['type'] === 'text') { ?>
							<input id="<?php echo esc_attr($field['id']); ?>" name="<?php echo esc_attr($field['id']); ?>" value="<?php echo esc_attr($value); ?>" type="<?php echo esc_attr($input_type); ?>" />
						<?php } ?>
						<?php if ($field['type'] === 'textarea') { ?>
							<textarea id="<?php echo esc_attr($field['id']); ?>" name="<?php echo esc_attr($field['id']); ?>"><?php echo esc_attr($value); ?></textarea>
						<?php } ?>						
					</div>
					<?php
				}
				?>
			</div>
			<?php
		}
		?>
		<div class="reset-settings tab-content">
			<p><?php _e('We will display all the columns that were deleted or disabled, renamed columns will show the original titles, we will rescan the database to find columns again, and the speed/advanced settings will be reset to the defaults. This only affects settings of our plugin and it does not affect the data edited with the sheet.', VGSE()->textname) ?></p>
			<a href="<?php echo esc_url(add_query_arg('wpse_hard_reset', 1)); ?>"><?php _e('Reset settings', VGSE()->textname) ?></a>
		</div>
		<?php do_action('vg_sheet_editor/settings/after_tabs_content', $provider, $sections); ?>
		<br>
		<div class="actions">
			<button type="submit" class="remodal-confirm"><?php _e('Save', VGSE()->textname); ?></button>
			<button type="button" data-remodal-action="confirm" class="remodal-cancel"><?php _e('Close', VGSE()->textname); ?></button>
		</div>
	</form>
</div>