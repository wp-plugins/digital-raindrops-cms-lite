<div class="cms-content3">      
<?php if (!cms_content(get_settings('content3'))): ?>
	<div class="widget-error">
		<?php _e( 'Please log in and add widgets to Content 3.', 'admin' ) ?> <br /><a href="<?php echo get_option('siteurl') ?>/wp-admin/widgets.php?s=&amp;show=&amp;sidebar=page-sidebar"><?php _e( 'Add Widgets', 'admin' ) ?></a>
	</div>
<?php endif ?>
</div>