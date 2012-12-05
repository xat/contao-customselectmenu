# Contao Custom Select Menu

This is a small Backend widget for the Content Management System Contao(3 and 2.11).
What you get is a Select-Menu with an additional last option 'other value'. If
you select the 'other value' option the Select 'transforms' into an text input field.
The inputType for this widget is named 'customselect'.

Credits go to [Psi|4ward](https://github.com/psi-4ward) for the idea.

## Usage

Just use it like the standard `select` Widget of Contao.
```php
// some DCA example
'highlight' => array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['highlight'],
	'inputType'               => 'customselect',
	'options'                 => array('Scala', 'SQL', 'Text', 'VB', 'XHTML', 'XML'),
	'eval'                    => array('includeBlankOption'=>true, 'rgxp'=>'alnum', 'tl_class'=>'w50'),
),
```

## Screen
![CustomSelectWidget](https://raw.github.com/xat/contao-customselectmenu/master/CustomSelectWidget.png)

## License
Copyright (c) 2012 Simon Kusterer
Licensed under the LGPL license.