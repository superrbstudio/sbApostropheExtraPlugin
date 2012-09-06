<?php

/**
 * Description of PluginsbApostropheExtraPluginaPageSettingsForm
 *
 * @author Giles Smith <tech@superrb.com>
 */
class PluginsbApostropheExtraPluginaPageSettingsForm extends BaseaPageSettingsForm 
{
  public function configure() 
	{ 
		parent::configure(); 
    
    // Create the page categories widget
    $categories = $this->getObject()->getProjectCategories();
    $defaultCategories = array();
    foreach($categories as $category){ $defaultCategories[] = $category->getId(); }
    
    $this->setWidget('ProjectCategories', new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'aCategory', 'label' => 'Page Categories'), array()));
    $this->setDefault('ProjectCategories', $defaultCategories);
    $this->setValidator('ProjectCategories', new sfValidatorDoctrineChoice(array('multiple' => true, 'model' =>  'aCategory', 'required' => false)));
	} 
}