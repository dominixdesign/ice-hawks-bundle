<?php

/*
 * This file is part of the IceHawksBundle.
 *
 * (c) Dominik Sander <http://dominix-design.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace dominix\IceHawksBundle\Models;

use Contao\Database;
use Contao\Model;

class IceHawksGames extends Model
{

    /**
     * Name of the table
     * @var string
     */
    protected static $strTable = 'tl_ih_games';

		public static function getSeasonOptions() {
			$seasons = array();
			$start = date('Y') - 5;
			$end = date('Y');
			for($i=$start; $i<=$end; $i++) {
				$seasons[] = 'Saison '.$i.'/'.($i+1);
			}
			return $seasons;
		}

		public static function generateSeasonAlias($season) {
			preg_match("/([0-9]{4})\/[0-9]{4}/", $season, $output_array);
			return $output_array[1];
		}

		public static function generateSeasonByAlias($alias) {
			return 'Saison '.$alias.'/'.($alias+1);
		}

		public function getExistingSeasonOptions() {
			$objDatabase = Database::getInstance();
			$res = $objDatabase->prepare("SELECT season FROM ".self::$strTable." GROUP BY season ORDER BY season DESC")->execute()->fetchAllAssoc();
			return array_map(function($v) {
				return $v['season'];
			},$res);
		}

		public static function labels($row, $label, $dc, $args) {
			$args[0] = date('d.m.Y',$args[0]);
			return $args;
		}
}
