<?php
function defaultSettings() {
	App::import('Helper', 'Html');
	$html = new HtmlHelper(new View(null));
	if(!defined('SITE_URL')) {
		define('SITE_URL', $html->url('/', true));
	}
	if(!defined('OFFER_IMG_URL')) {
		define('OFFER_IMG_URL', 'offers');
	}
	if(!defined('SERVICE_IMG_URL')) {
		define('SERVICE_IMG_URL', 'services');
	}
	if(!defined('EXT')) {
		define('EXT', '.html');
	}
	if(!defined('IMAGE_CACHE')) {
		define('IMAGE_CACHE', 'imagecache');
	}

	if(!is_dir(ROOT.DS.APP_DIR.DS.WEBROOT_DIR.DS.IMAGES_URL.DS.IMAGE_CACHE)) {
		mkdir(ROOT.DS.APP_DIR.DS.WEBROOT_DIR.DS.IMAGES_URL.DS.IMAGE_CACHE, 0700);
	} 
	if(!is_dir(ROOT.DS.APP_DIR.DS.WEBROOT_DIR.DS.IMAGES_URL.DS.IMAGE_CACHE)) {
		mkdir(ROOT.DS.APP_DIR.DS.WEBROOT_DIR.DS.IMAGES_URL.DS.IMAGE_CACHE, 0700);
	} 
	if(!is_dir(ROOT.DS.APP_DIR.DS.WEBROOT_DIR.DS.IMAGES_URL.DS.OFFER_IMG_URL)) {
		mkdir(ROOT.DS.APP_DIR.DS.WEBROOT_DIR.DS.IMAGES_URL.DS.OFFER_IMG_URL, 0700);
	} 
	if(!is_dir(ROOT.DS.APP_DIR.DS.WEBROOT_DIR.DS.IMAGES_URL.DS.SERVICE_IMG_URL)) {
		mkdir(ROOT.DS.APP_DIR.DS.WEBROOT_DIR.DS.IMAGES_URL.DS.SERVICE_IMG_URL, 0700);
	} 
	if(!defined('TEST_EMAIL')) {
		define('TEST_EMAIL', 'widahead_test@gmail.com');
	}
	if(!defined('ADMIN_EMAIL')) {
		define('ADMIN_EMAIL', 'widahead@gmail.com');
	}
}