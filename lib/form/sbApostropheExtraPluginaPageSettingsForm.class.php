<?php

class sbApostropheExtraPluginaPageSettingsForm extends BaseaPageSettingsForm 
{ 
	public function configure() 
	{ 
		parent::configure(); 

    // Create the page metatitle widget
		$metaTitle = $this->getObject()->getMetaTitle(); 
		$this->setWidget('meta_title', new sfWidgetFormInputText(array('default' => html_entity_decode($metaTitle, ENT_COMPAT, 'UTF-8')))); 
		$this->setValidator('meta_title', new sfValidatorString(array('required' => false)));
    
    // Create the page categories widget
    $categories = $this->getObject()->getProjectCategories();
    $defaultCategories = array();
    foreach($categories as $category){ $defaultCategories[] = $category->getId(); }
    
    $this->setWidget('ProjectCategories', new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'aCategory', 'label' => 'Page Categories'), array()));
    $this->setDefault('ProjectCategories', $defaultCategories);
    $this->setValidator('ProjectCategories', new sfValidatorDoctrineChoice(array('multiple' => true, 'model' =>  'aCategory', 'required' => false)));
	} 
}
