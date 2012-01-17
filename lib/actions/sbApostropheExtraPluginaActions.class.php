<?php

/**
 * Extend the Apostrophe Actions to add in the meta title to the page settings form. 
 */
class sbApostropheExtraPluginaActions extends BaseaActions 
{
	/**
   * Overide the show method to add in the meta title if it is set
   * @param sfWebRequest $request
   * @return mixed
   */
  public function executeShow(sfWebRequest $request)
  {
    $parent = parent::executeShow($request);
		
		if($this->page instanceof aPage)
		{
			$metaTitle = $this->page->getMetaTitle();
			if(strlen($metaTitle)) 
			{
				$this->getResponse()->addMeta('title', aTools::getOptionI18n('title_prefix').$metaTitle); 
			}
		}

    return $parent;
  }
}