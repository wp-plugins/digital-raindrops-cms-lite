<!-- DRF add the Categories Menu -->
<!-- <?php if (file_exists(TEMPLATEPATH . '/cms_inc/addons/cms-category-menu/cms-category-menu.php')) include_once(TEMPLATEPATH . '/cms_inc/addons/cms-category-menu/cms-category-menu.php'); ?> -->
<div id="cms-cat-menu-container">
	<div id="cms-cat-menu">
		<div id="cms-cat-menu-inner">
			<ul class="cms-cat-menu-item"><?php wp_list_categories('title_li=&orderby=name&depth=1'); ?></ul>
		</div>
	</div>
</div>

