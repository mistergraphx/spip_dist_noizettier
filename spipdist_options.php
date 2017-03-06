<?php

if (!defined("_ECRIRE_INC_VERSION")) return;

// Utiliser le noizettier
// http://contrib.spip.net/Adapter-un-squelette-pour-etre-compatible-avec-le
define('_NOIZETIER_REPERTOIRE_PAGES','/');
define('_NOIZETIER_LISTER_PAGES_SANS_XML',false);
define('_NOIZETIER_RECUPERER_FOND', true);
define('_NOIZETIER_COMPOSITIONS_TYPE_PAGE',true);

if (!isset($GLOBALS['z_blocs']))
	$GLOBALS['z_blocs'] = array('header','footer');


define('_ZENGARDEN_FILTRE_THEMES','spipdist');
define('_ALBUMS_INSERT_HEAD_CSS',false);



?>