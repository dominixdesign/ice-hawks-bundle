<?php


$GLOBALS['TL_DCA']['tl_module']['fields']['ih_season'] = array
(
	 'label'                   => &$GLOBALS['TL_LANG']['tl_module']['ih_season'],
	 'exclude'                 => true,
	 'search'                  => true,
	 'inputType'               => 'select',
	 'options_callback'        => array('dominix\\IceHawksBundle\\Models\\IceHawksGames', 'getExistingSeasonOptions'),
	 'eval'										 => array('onchange' => 'Backend.autoSubmit(\'tl_module\')'),
	 'sql'                     => "varchar(64) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_module']['palettes']['ih_szene'] = '{title_legend},name,headline,type;';
//$GLOBALS['TL_DCA']['tl_module']['palettes']['ih_szene'].= '{ih_legend},ih_season;';
$GLOBALS['TL_DCA']['tl_module']['palettes']['ih_szene'].= '{template_legend:hide},customTpl;{expert_legend:hide},cssID,space';

$GLOBALS['TL_DCA']['tl_module']['palettes']['ih_szene_nav'] = '{title_legend},name,type;';
//$GLOBALS['TL_DCA']['tl_module']['palettes']['ih_szene'].= '{ih_legend},ih_season;';
$GLOBALS['TL_DCA']['tl_module']['palettes']['ih_szene_nav'].= '{template_legend:hide},customTpl;{expert_legend:hide},cssID,space';
