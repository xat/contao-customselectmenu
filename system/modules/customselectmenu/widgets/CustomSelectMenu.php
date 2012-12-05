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
 * Run in a custom namespace, so the class can be replaced
 */
namespace Sope\CustomSelectMenu;


/**
 * Class CustomSelectMenu
 *
 * Displays a select menu with the ability to use a custom Value
 * @copyright  Simon Kusterer 2012
 * @author     Simon Kusterer <http://soped.com>
 * @package    Core
 */
class CustomSelectMenu extends \Widget
{

	/**
	 * Submit user input
	 * @var boolean
	 */
	protected $blnSubmitInput = true;

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'be_widget';

	/**
	 * Options
	 * @var array
	 */
	protected $arrOptions = array();


	/**
	 * Add specific attributes
	 * @param string
	 * @param mixed
	 */
	public function __set($strKey, $varValue)
	{
		switch ($strKey)
		{
			case 'mandatory':
				if ($varValue)
				{
					$this->arrAttributes['required'] = 'required';
				}
				else
				{
					unset($this->arrAttributes['required']);
				}
				parent::__set($strKey, $varValue);
				break;

			case 'options':
				$this->arrOptions = deserialize($varValue);
				break;

			default:
				parent::__set($strKey, $varValue);
				break;
		}
	}

	/**
	 * Generate the widget and return it as string
	 * @return string
	 */
	public function generate()
	{
		$arrOptions = array();
		$strClass = 'tl_customselect';

		// Add empty option (XHTML) if there are none
		if (empty($this->arrOptions))
		{
			$this->arrOptions = array(array('value'=>'', 'label'=>'-'));
		}

		foreach ($this->arrOptions as $strKey=>$arrOption)
		{
			if (isset($arrOption['value']))
			{
				$arrOptions[] = sprintf('<option value="%s"%s>%s</option>',
										 specialchars($arrOption['value']),
										 $this->isSelected($arrOption),
										 $arrOption['label']);
			}
			else
			{
				$arrOptgroups = array();

				foreach ($arrOption as $arrOptgroup)
				{
					$arrOptgroups[] = sprintf('<option value="%s"%s>%s</option>',
											   specialchars($arrOptgroup['value']),
											   $this->isSelected($arrOptgroup),
											   $arrOptgroup['label']);
				}

				$arrOptions[] = sprintf('<optgroup label="&nbsp;%s">%s</optgroup>', specialchars($strKey), implode('', $arrOptgroups));
			}
		}

		// add an last option 'custom value':
		// This will transform the Select into an input-field
		$arrOptions[] = sprintf('<option value="other_value">%s</option>', specialchars($GLOBALS['TL_LANG']['MSC']['otherValue']));

		$GLOBALS['TL_JAVASCRIPT']['customselectmenu'] = 'system/modules/customselectmenu/html/js/customselectmenu.js';

		$strSelect = sprintf('<div class="tl_customselect_select"><select name="%s" class="tl_select" onfocus="Backend.getScrollOffset()">%s</select>%s</div>',
			$this->strName,
			implode('', $arrOptions),
			$this->wizard);

		$strInput = sprintf('<div class="tl_customselect_input"><input type="text" name="%s" class="tl_text" value="" onfocus="Backend.getScrollOffset()">&nbsp;<a href="#" class="tl_customselect_switch">x</a></div>',
			$this->strName);

		$strJs = '<script>window["CSM'.$this->strId.'"] = new CustomSelectMenu("ctrl_'.$this->strId.'", "'.specialchars($this->varValue).'");</script>';

		return sprintf('<div id="ctrl_%s" class="tl_customselect %s" %s>%s %s</div>%s',
			$this->strId,
			(($this->strClass != '') ? ' ' . $this->strClass : ''),
			$this->getAttributes(),
			$strSelect,
			$strInput,
			$strJs
		);
	}
}
