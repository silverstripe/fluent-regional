<?php

// Holy hack. All this does is ensure that a URL without a region prefix forces the default locale

$newRoutes = array ();
$routes = Config::inst()->get('Director','rules');
Config::inst()->remove('Director', 'rules');
$routes['$URLSegment//$Action/$ID/$OtherID'] = array (
			'Controller' => 'ModelAsController',
			'l' => 'en_NZ'
		);

Config::inst()->update('Director', 'rules', $routes);

// Now go yell at Damian.