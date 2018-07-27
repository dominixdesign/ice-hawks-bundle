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
			$gameArray[$k]['images'] = \FilesModel::findMultipleByUuids($multiSRC);
		}

		$this->Template->games = $gameArray;
		$this->Template->headline = $this->headline;
		$this->Template->headlineUnit = $this->hl;
		$this->Template->cssId = $this->cssID[0];
		$this->Template->cssClass = $this->cssID[1];

  }

}
