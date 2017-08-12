<?php

/*
 * This file is part of the CssStyleSelector Bundle.
 *
 * (c) Daniel Kiesel <https://github.com/iCodr8>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

if (isset($GLOBALS['TL_DCA']['tl_form'])) {
    // Palettes
    foreach ($GLOBALS['TL_DCA']['tl_form']['palettes'] as $k => $v) {
        $GLOBALS['TL_DCA']['tl_form']['palettes'][$k] = str_replace(',attributes', ',cssStyleSelector,attributes', $v);
    }

    // Fields
    $GLOBALS['TL_DCA']['tl_form']['fields']['cssStyleSelector'] = array
    (
        'label'            => &$GLOBALS['TL_LANG']['MSC']['cssStyleSelector'],
        'exclude'          => true,
        'inputType'        => 'select',
        'options_callback' => function () {
            return \Craffft\CssStyleSelectorBundle\Models\CssStyleSelectorModel::findStyleDesignationByNotDisabledType(
                \Craffft\CssStyleSelectorBundle\Models\CssStyleSelectorModel::TYPE_FORM
            );
        },
        'search'           => true,
        'eval'             => array('chosen' => true, 'multiple' => true, 'tl_class' => 'clr'),
        'save_callback'    => array
        (
            function ($varValue, \DataContainer $dc) {
                $cssStyleSelectorUtil = new Craffft\CssStyleSelectorBundle\Util\CssStyleSelectorUtil();

                return $cssStyleSelectorUtil->saveCssIdCallback($varValue, $dc, 'attributes');
            }
        ),
        'sql'              => "blob NULL"
    );
}
