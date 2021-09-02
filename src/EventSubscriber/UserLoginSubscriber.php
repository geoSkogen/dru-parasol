<?php

namespace Drupal\parasol\EventSubscriber;

use Drupal\parasol\Event\UserLoginEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class UserLoginSubscriber implements EventSubscriberInterface {

  protected $database;
  protected $dateFormatter;

  public static function getSubscribedEvents() {
    return [
      UserLoginEvent::EVENT_NAME => 'onUserLogin'
    ];
  }

  public function onUserLogin(UserLoginEvent $event) {
    $database = \Drupal::database();
    $dateFormatter = \Drupal::service('date.formatter');

    $account_created = $database->select('users_field_data', 'ud')
     ->fields('ud',['created'])
     ->condition('ud.uid', $event->account->id() )
     ->execute()->fetchField();
    $formtted_date =   $dateFormatter->format($account_created, 'short');
     error_log('\r\nPARASOL\r\nThe custom user login event fired: fetched registration date ' . $formatted_date);
     \Drupal::messenger()->addStatus('welcome back, your account was created on %created_date',
       [
         '%created_data' => $dateFormatter->format($account_created, 'short')
       ]
     );
  }
}
?>
