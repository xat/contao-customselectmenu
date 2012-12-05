<?php
/**
 * Contao Open Source CMS
 *
 * Copyright (C) 2005-2012 Leo Feyer
 *
 * @package   CustomSelectMenu
 * @author    Simon Kusterer
 * @license   LGPL
 * @copyright Simon Kusterer 2012
 */


/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
	'Sope'
));

/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	'Sope\CustomSelectMenu\CustomSelectMenu' => 'system/modules/customselectmenu/widgets/CustomSelectMenu.php'
));
