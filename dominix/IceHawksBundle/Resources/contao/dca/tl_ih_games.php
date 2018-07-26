<?php

/*
 * This file is part of the HolemaClientBundle.
 *
 * (c) Dominik Sander <http://dominix-design.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

$GLOBALS['TL_DCA']['tl_ih_games'] = array
(
    // Config
    'config'   => array
    (
        'dataContainer' => 'Table',
        'enableVersioning' => true,
        'sql' => array
        (
            'keys' => array
            (
                'id' => 'primary',
								'gamedate' => 'index',
								'season' => 'index'
            )
        )
    ),
    // List
    'list' => array
    (
        'sorting' => array
        (
            'mode'                    => 11,
            'fields'                  => array('gamedate'),
            'panelLayout'             => 'filter;search,limit'
        ),
        'label' => array
        (
            'fields'                  => array('gamedate', 'game', 'result', 'attendance'),
            'showColumns'             => true,
						'label_callback'					=> array('dominix\\IceHawksBundle\\Models\\IceHawksGames', 'labels')
        ),
        'global_operations' => array
        (
            'all' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
                'href'                => 'act=select',
                'class'               => 'header_edit_all',
                'attributes'          => 'onclick="Backend.getScrollOffset()" accesskey="e"'
            )
        ),
        'operations' => array
        (
            'edit' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_ih_games']['edit'],
                'href'                => 'act=edit',
                'icon'                => 'edit.gif'
            ),
            'copy'   => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_ih_games']['copy'],
                'href'                => 'act=paste&amp;mode=copy',
                'icon'                => 'copy.gif',
            ),
            'delete' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_ih_games']['delete'],
                'href'                => 'act=delete',
                'icon'                => 'delete.gif',
                'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
            ),
            'show' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_ih_games']['show'],
                'href'                => 'act=show',
                'icon'                => 'show.gif'
            )
        )
    ),
    // Palettes
    'palettes' => array
    (
        'default' => '{game_data},season,gamedate,game,result;{szene_data},attendance,awayfans;{bilder},pictures'
    ),
    // Fields
    'fields'   => array
    (
        'id' => array
        (
					'sql'                     => "int(10) unsigned NOT NULL AUTO_INCREMENT"
        ),
        'tstamp' => array
        (
            'sql'                     => "int(10) unsigned NOT NULL default '0'"
        ),
        'season' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_ih_games']['season'],
            'exclude'                 => true,
            'filter'                  => true,
            'inputType'               => 'select',
						'options_callback'			  => array('dominix\\IceHawksBundle\\Models\\IceHawksGames', 'getSeasonOptions'),
            'eval'                    => array('mandatory' => true, 'tl_class' => 'clr w50', 'onchange' => 'Backend.autoSubmit(\'tl_holema_client_games\')'),
            'sql'                     => "varchar(20) NOT NULL default ''"
        ),
        'game' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_ih_games']['game'],
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory' => true, 'maxlength' => 255, 'tl_class' => 'clr w50'),
            'sql'                     => "varchar(100) NULL"
        ),
        'gamedate' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_ih_games']['gamedate'],
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'text',
            'eval'                    => array('datepicker' => true, rgxp => 'date', 'mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'),
            'sql'                     => "int(10) unsigned NOT NULL"
        ),
        'result' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_ih_games']['result'],
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory' => false, 'maxlength' => 50, 'tl_class' => 'w50'),
            'sql'                     => "varchar(50) NULL"
        ),
        'attendance' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_ih_games']['attendance'],
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'text',
            'eval'                    => array('rgxp' => 'numeric', 'mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w50'),
            'sql'                     => "int(25) NULL"
        ),
        'awayfans' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_ih_games']['awayfans'],
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'text',
            'eval'                    => array('rgxp' => 'numeric', 'mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w50'),
            'sql'                     => "int(25) NULL"
        ),
				'pictures' => array
				(
					'label'                   => &$GLOBALS['TL_LANG']['tl_ih_games']['pictures'],
					'exclude'                 => true,
					'inputType'               => 'fileTree',
					'eval'                    => array('isGallery' => true, 'multiple'=>true, 'fieldType'=>'checkbox', 'orderField'=>'orderSRC', 'files'=>true, 'mandatory'=>false, 'tl_class'=>'sortable sgallery'),
					'sql'                     => "blob NULL"
				),
				'orderSRC' => array
				(
					'label'                   => &$GLOBALS['TL_LANG']['MSC']['sortOrder'],
					'sql'                     => "blob NULL"
				)
    )
);
