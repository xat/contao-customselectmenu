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
	 * Back end form fields
	 */

if(version_compare(VERSION,'3.0','<'))
{
	$GLOBALS['BE_FFL']['customselect'] = 'CustomSelectMenu';
}
else
{
	$GLOBALS['BE_FFL']['customselect'] = '\Sope\CustomSelectMenu\CustomSelectMenu';
}

if(TL_MODE == 'BE')
{
	$GLOBALS['TL_CSS']['customselect'] = 'system/modules/customselectmenu/html/css/customselectmenu.css';
}
