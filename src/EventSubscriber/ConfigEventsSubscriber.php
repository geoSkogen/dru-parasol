<?php

namespace Drupal\parasol\EventSubscriber;

use Drupal\Core\Config\ConfigCrudEvent;

use Drupal\Core\Config\ConfigEvents;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ConfigEventsSubscriber implements EventSubscriberInterface {

  public static function getSubscribedEvents() {
    
	return [
      ConfigEvents::SAVE => 'configSave',
      ConfigEvents::DELETE => 'configDelete'
    ];

  }
  
  public function configSave(ConfigCrudEvent $event) {
	  $config = $event->getConfig();

	  \Drupal::messenger()->addStatus('config update ' . $config->getName() );
	  
	  
  }
  
   public function configDelete(ConfigCrudEvent $event) {
	  $config = $event->getConfig();

	  \Drupal::messenger()->addStatus('config delete' . $config->getName() );
	  
	  
   }
  
}
