<?php

namespace dominix\IceHawksBundle\Modules;

use Contao\Module;
use dominix\IceHawksBundle\Models\IceHawksGames;

class SzeneNavigationModule extends Module {

	protected $strTemplate = 'mod_szene_nav';

	public function generate()
	{
		if (TL_MODE == 'BE')
		{
			/** @var \BackendTemplate|object $objTemplate */
			$objTemplate = new \BackendTemplate('be_wildcard');
			$objTemplate->wildcard = '### IH94 Szene im Blick Navigation ###';
			$objTemplate->title = $this->headline;
			$objTemplate->id = $this->id;
			$objTemplate->link = $this->name;
			$objTemplate->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;
			return $objTemplate->parse();
		}

		if (!isset($_GET['items']) && \Config::get('useAutoItem') && isset($_GET['auto_item']))
		{
			\Input::setGet('items', \Input::get('auto_item'));
		}

		return parent::generate();
	}

  protected function compile()
  {
		$seasons = array();
		foreach(IceHawksGames::getExistingSeasonOptions() as $s) {
			$seasons[IceHawksGames::generateSeasonAlias($s)] = $s;
		}
		if(!\Input::get('items')) {
			$currentSeason = IceHawksGames::getExistingSeasonOptions()[0];
		} else {
			$currentSeason = IceHawksGames::generateSeasonByAlias(\Input::get('items'));
		}


		if(!$seasons) {
			return null;
		}

		$this->Template->seasons = $seasons;
		$this->Template->currentSeason = $currentSeason;
		$this->Template->games = $gameArray;
		$this->Template->headline = $this->headline;
		$this->Template->headlineUnit = $this->hl;
		$this->Template->cssId = $this->cssID[0];
		$this->Template->cssClass = $this->cssID[1];

  }

}
