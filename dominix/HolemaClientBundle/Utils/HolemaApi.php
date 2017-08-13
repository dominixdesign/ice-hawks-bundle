<?php

/*
 * This file is part of the HolemaClientBundle.
 *
 * (c) Dominik Sander <http://dominix-design.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace dominix\HolemaClientBundle\Utils;

class HolemaApi
{

  const API_URL = 'https://del2.holema.eu/api/teams/';
  const API_KEY = 'B4IUBZ5MO8MQUJJJJOUT';

  private static function call($page) {
    $uri = self::API_URL . $page . "/" . \Config::get('holemaId');

    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_RETURNTRANSFER => 1,
      CURLOPT_URL => $uri,
      CURLOPT_USERAGENT => 'starting6media powered website',
      CURLOPT_HTTPHEADER => array('apikey: B4IUBZ5MO8MQUJJJJOUT')
    ));

    $response = curl_exec($curl);
    curl_close($curl);

    return $response;

  }

  public static function getStandings() {
    return self::call('standings.json');
  }


}
