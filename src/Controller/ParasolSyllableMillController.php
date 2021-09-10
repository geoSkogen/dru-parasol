<?php

namespace Drupal\parasol\Controller;

use Drupal\Core\Controller\ControllerBase;

class ParasolSyllableMillController extends ControllerBase {

    public function initView() {
      $attach['#attached']['library'][] = 'parasol/parasol_generator';
      
      return $attach;

    }

}


?>
