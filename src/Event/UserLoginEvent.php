<?php

namespace Drupal\parasol\Event;

use Drupal\Component\EventDispatcher\Event;
use Drupal\user\UserInterface;

class UserLoginEvent extends Event {

  const EVENT_NAME = 'parasol_user_login';

  public $account;

  public function __construct(UserInterface $account) {
    $this->account = $account;
  }


}

?>
