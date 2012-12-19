<?php

/**
 * Enhanced Search
 *
 * @author giles
 */
class PluginsbEnhancedSearchActions extends BaseaActions 
{
  public function executeSearch(sfWebRequest $request)
  {
    // we need to overide this before the parent search method has a chance to redirect back to the original search.
    $q = $request->getParameter('q');

    if ($request->hasParameter('x'))
    {
      // We sometimes like to use input type="image" for presentation reasons, but it generates
      // ugly x and y parameters with click coordinates. Get rid of those and come back.
      return $this->redirect(sfContext::getInstance()->getController()->genUrl('sbEnhancedSearch/search', true) . '?' . http_build_query(array("q" => $q)));
    }
    
    // do the search
    parent::executeSearch($request);
    
    // work out search phrase and save
    // only do this if the page parameter isn't present
    if($request->getParameter('page', 0) == 0)
    {
      $phrase = sbEnhancedSearchPhraseTable::cleanPhrase($q);
      $phraseObject = sbEnhancedSearchPhraseTable::getInstance()->findOneByPhrase($phrase);

      if(!($phraseObject instanceof sbEnhancedSearchPhrase))
      { 
        $phraseObject = new sbEnhancedSearchPhrase; 
        $phraseObject->setPhrase($phrase);
        $phraseObject->setUsageCount(0);
      }

      $phraseObject->setUsageCount($phraseObject->getUsageCount() + 1);
      $phraseObject->setLastNumberResults($this->pager->getNbResults());
      $phraseObject->save();
    }
    
    $this->pageUrl = $this->generateUrl('@sb_enhanced_search');
  }
  
  public function executeTerms(sfWebRequest $request)
	{
		$this->getResponse()->setHttpHeader('Content-Type','application/json; charset=utf-8');
		$keylessTerms = array();
		$terms = sbEnhancedSearchPhraseTable::getPhrases($request->getParameter('term'));
		foreach($terms as $term){$keylessTerms[] = $term;}
		$this->getResponse()->setContent(json_encode($keylessTerms));
		return sfView::NONE;
	}
}