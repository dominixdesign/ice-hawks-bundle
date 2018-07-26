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
$GLOBALS['BE_MOD']['ice_hawks'] = array(
	'ih_szene' => array(
		'tables' => array('tl_ih_games')
	)
);

$GLOBALS['TL_MODELS']['tl_ih_games'] = '\dominix\IceHawksBundle\Models\IceHawksGames';
