<?php

class sbApostropheExtraPluginaPageSettingsForm extends BaseaPageSettingsForm 
{ 
	public function configure() 
	{ 
		parent::configure(); 

		$metaTitle = $this->getObject()->getMetaTitle(); 
		$this->setWidget('meta_title', new sfWidgetFormInputText(array('default' => html_entity_decode($metaTitle, ENT_COMPAT, 'UTF-8')))); 
		$this->setValidator('meta_title', new sfValidatorString(array('required' => false)));
	} 
}
