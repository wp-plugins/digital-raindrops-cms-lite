<div class="cms-content16">      
<?php if (!cms_content(get_settings('content16'))): ?>
	<div class="widget-error">
		<?php _e( 'Please log in and add widgets to Content 16.', 'admin' ) ?> <br /><a href="<?php echo get_option('siteurl') ?>/wp-admin/widgets.php?s=&amp;show=&amp;sidebar=page-sidebar"><?php _e( 'Add Widgets', 'admin' ) ?></a>
	</div>
<?php endif ?>
</div>