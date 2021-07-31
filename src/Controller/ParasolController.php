<?php
namespace Drupal\parasol\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Provides route responses for the Example module.
 */
class ParasolController extends ControllerBase {

  /**
   * Returns a simple page.
   *
   * @return array
   *   A simple renderable array.
   */
  public function helloContent() {
    /*
    $jspath = drupal_get_path('module', 'parasol') . '/js/skeleton.js';
    $csspath = drupal_get_path('module', 'parasol') . '/css/skeleton.css';
    */
    $attach['#attached']['library'][] = 'parasol/parasol';

    return $attach;
  }

}
