<?php

class aActions extends BaseaActions 
{
	/**
   * DOCUMENT ME
   * @param sfWebRequest $request
   * @return mixed
   */
  public function executeShow(sfWebRequest $request)
  {
    $slug = $this->getRequestParameter('slug');
    
    // remove trailing slashes from $slug
    $pattern = '/\/$/';
    if (preg_match($pattern, $slug) && ($slug != '/'))
    {
      sfContext::getInstance()->getConfiguration()->loadHelpers(array('Url'));
      
      $new_slug = preg_replace($pattern, '', $slug);
      $slug = addcslashes($slug, '/');
      $new_uri = preg_replace( '/' . $slug . '/' , $new_slug, $request->getUri());
    
      $this->redirect($new_uri);
    }
    
    if (substr($slug, 0, 1) !== '/')
    {
      $slug = "/$slug";
    }

    $page = aPageTable::retrieveBySlugWithSlots($slug);
    if (!$page)
    {
      $redirect = Doctrine::getTable('aRedirect')->findOneBySlug($slug);
      if ($redirect)
      {
        $page = aPageTable::retrieveByIdWithSlots($redirect->page_id);        
        return $this->redirect($page->getUrl(), 301);
      }
    }
    aTools::validatePageAccess($this, $page);
    aTools::setPageEnvironment($this, $page);
    $this->page = $page;
    $this->setTemplate($page->template);

    $tagstring = implode(',', $page->getTags());
    if (strlen($tagstring))
    {
      $this->getResponse()->addMeta('keywords', htmlspecialchars($tagstring));
    }
    if (strlen($page->getMetaDescription()))
    {
      $this->getResponse()->addMeta('description', $page->getMetaDescription());
    }
		
		$metaTitle = $page->getMetaTitle();
		if(strlen($metaTitle)) 
		{
			$this->getResponse()->addMeta('title', aTools::getOptionI18n('title_prefix').$metaTitle); 
		}
		
		var_dump($metaTitle);

    return 'Template';
  }
}