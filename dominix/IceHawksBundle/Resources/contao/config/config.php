<?php

/*
 * This file is part of the IceHawksBundle.
 *
 * (c) Dominik Sander <http://dominix-design.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/* Backend Module */
array_insert($GLOBALS['BE_MOD']['content'], 1, array
(
	'ih_szene' => array(
		'tables' => array('tl_ih_games')
	)
));

$GLOBALS['TL_MODELS']['tl_ih_games'] = '\dominix\IceHawksBundle\Models\IceHawksGames';

$GLOBALS['FE_MOD']['holema']['ih_szene'] = '\dominix\IceHawksBundle\Modules\SzeneModule';
$GLOBALS['FE_MOD']['holema']['ih_szene_nav'] = '\dominix\IceHawksBundle\Modules\SzeneNavigationModule';
