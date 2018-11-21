<?php

namespace dominix\IceHawksBundle\Modules;

use Contao\Module;
use dominix\IceHawksBundle\Models\IceHawksGames;

class SzeneModule extends Module {

	protected $strTemplate = 'mod_szene';

	public function generate()
	{
		if (TL_MODE == 'BE')
		{
			/** @var \BackendTemplate|object $objTemplate */
			$objTemplate = new \BackendTemplate('be_wildcard');
			$objTemplate->wildcard = '### ICE HAWKS Szene im Blick ###';
			$objTemplate->title = $this->headline;
			$objTemplate->id = $this->id;
			$objTemplate->link = $this->name;
			$objTemplate->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;
			return $objTemplate->parse();
		}

		// Set the item from the auto_item parameter
		if (!isset($_GET['items']) && \Config::get('useAutoItem') && isset($_GET['auto_item']))
		{
			\Input::setGet('items', \Input::get('auto_item'));
		}
		return parent::generate();
	}

  protected function compile()
  {

		if(!\Input::get('items')) {
			$season = IceHawksGames::getExistingSeasonOptions()[0];
		} else {
			$season = IceHawksGames::generateSeasonByAlias(\Input::get('items'));
		}
		$games = IceHawksGames::findAll(array (
	    'order'   => ' gamedate DESC',
	    'column'  => array('season=?'),
	    'value'   => array($season)
	  ));
		if(!$games) {
			throw new PageNotFoundException('Page not found: ' . \Environment::get('uri'));
		} else {
			// Overwrite the page title (see #2853 and #4955)
			global $objPage;
			$objPage->pageTitle = strip_tags('...im Blick ' . \StringUtil::stripInsertTags($season));
		}

		$gameArray = array();
		foreach($games->fetchAll() as $k => $g) {
			$gameArray[$k] = $g;
			$multiSRC = \StringUtil::deserialize($g['pictures']);
			$files = \FilesModel::findByPid($multiSRC, array('order' => 'name'));
			if(is_null($files)) {
				$files = \FilesModel::findMultipleByUuids($multiSRC);
			}
			foreach($files as $image) {
				$gameArray[$k]['images'][] = array(
					'thumbnail' => \Image::get($image->path, 120, 120, 'center_center'),
					'url' => $image->path,
					'uuid' => $image->uuid
				);
			}

			//sort images:
			$tmp = \StringUtil::deserialize($g['orderSRC']);
			if (!empty($tmp) && \is_array($tmp))
			{
				// Remove all values
				$arrOrder = array_map(function () {}, array_flip($tmp));
				// Move the matching elements to their position in $arrOrder
				foreach ($gameArray[$k]['images'] as $k2=>$v)
				{
					if (array_key_exists($v['uuid'], $arrOrder))
					{
						$arrOrder[$v['uuid']] = $v;
						unset($gameArray[$k]['images'][$k2]);
					}
				}
				// Append the left-over images at the end
				if (!empty($gameArray[$k]['images']))
				{
					$arrOrder = array_merge($arrOrder, array_values($gameArray[$k]['images']));
				}
				// Remove empty (unreplaced) entries
				$gameArray[$k]['images'] = array_values(array_filter($arrOrder));
				unset($arrOrder);
			}
		}

		$this->Template->games = $gameArray;
		$this->Template->headline = $this->headline;
		$this->Template->headlineUnit = $this->hl;
		$this->Template->cssId = $this->cssID[0];
		$this->Template->cssClass = $this->cssID[1];

  }

}
