<?php
 declare(strict_types=1);
/*
 * This file is part of the IceHawksBundle.
 *
 * (c) Dominik Sander <http://dominix-design.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

 namespace dominix\IceHawksBundle\ContaoManager;

 use Contao\CoreBundle\ContaoCoreBundle;
 use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
 use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
 use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
 use dominix\IceHawksBundle\IceHawksBundle;

 class Plugin implements BundlePluginInterface
 {
     /**
      * {@inheritdoc}
      */
     public function getBundles(ParserInterface $parser): array
     {
         return [
             BundleConfig::create(IceHawksBundle::class)
                 ->setLoadAfter([ContaoCoreBundle::class])
                 ->setReplace(['icehawks']),
         ];
     }
 }
