<?php

/**
 * Description of PluginsbExternalLinkClickActions
 *
 * @author giles
 */
class PluginsbExternalLinkClickActions extends sfActions 
{
  public function executeSave(sfWebRequest $request)
  {
    $this->forward404Unless($request->getMethod() == 'POST');
    $sbExternalLinkClickForm = new sbExternalLinkClickForm();
    
    $values = array('external_uri' => $request->getParameter('external_uri'), 
                    'referrer_uri' => $request->getParameter('referrer_uri'));
    $sbExternalLinkClickForm->bind($values);
    
    if($sbExternalLinkClickForm->isValid()) 
    {
      $sbExternalLinkClickForm->save();
      $success = true;
    }
    else
    {
      $success = false;
    }
    
    $this->getResponse()->setHttpHeader('Content-Type','application/json; charset=utf-8');
    $this->getResponse()->setContent(json_encode(array('success' => $success)));
    return sfView::NONE;
  }
}