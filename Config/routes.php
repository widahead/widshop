<?php
	Router::connect('/', array('plugin' => 'WidShop', 'controller' => 'pages', 'action' => 'product'));
	Router::connect('/pages/*', array('plugin' => 'WidShop', 'controller' => 'pages', 'action' => 'display'));
	Router::connect('/pages/work', array('plugin' => 'WidShop', 'controller' => 'pages', 'action' => 'work'));
	Router::connect('/offer/:slug', array('plugin' => 'WidShop', 'controller' => 'offers', 'action' => 'view'), array('pass' => array('slug')));
	Router::connect('/service/:slug', array('plugin' => 'WidShop', 'controller' => 'services', 'action' => 'view'), array('pass' => array('slug')));
	Router::connect('/product/*', array('plugin' => 'WidShop', 'controller' => 'pages', 'action' => 'product'));
	Router::connect('/categories', array('plugin' => 'WidShop', 'controller' => 'categories', 'action' => 'index'));
	Router::connect('/categories/addCategory', array('plugin' => 'WidShop', 'controller' => 'categories', 'action' => 'addCategory'));
	Router::connect('/categories/delete/*', array('plugin' => 'WidShop', 'controller' => 'categories', 'action' => 'delete'));
	Router::connect('/categories/editCategory/*', array('plugin' => 'WidShop', 'controller' => 'categories', 'action' => 'editCategory'));
	Router::connect('/services', array('plugin' => 'WidShop', 'controller' => 'services', 'action' => 'index'));
	Router::connect('/services/manageService/*', array('plugin' => 'WidShop', 'controller' => 'services', 'action' => 'manageService'));
	Router::connect('/services/delete/*', array('plugin' => 'WidShop', 'controller' => 'services', 'action' => 'delete'));
	Router::connect('/services/getCalculatedPrice/*', array('plugin' => 'WidShop', 'controller' => 'services', 'action' => 'getCalculatedPrice'));

	Router::connect('/offers', array('plugin' => 'WidShop', 'controller' => 'offers', 'action' => 'index'));
	Router::connect('/offers/adminManageOffer/*', array('plugin' => 'WidShop', 'controller' => 'offers', 'action' => 'adminManageOffer'));
	Router::connect('/offers/edit/*', array('plugin' => 'WidShop', 'controller' => 'offers', 'action' => 'edit'));
	Router::connect('/offers/delete/*', array('plugin' => 'WidShop', 'controller' => 'offers', 'action' => 'delete'));
	Router::connect('/currencies', array('plugin' => 'WidShop', 'controller' => 'currencies', 'action' => 'index'));
	Router::connect('/feeds_generator', array('plugin' => 'WidShop', 'controller' => 'feeds_generator', 'action' => 'index'));
	Router::connect('/orders/confirm/*', array('plugin' => 'WidShop', 'controller' => 'orders', 'action' => 'confirm'));
