<?php
namespace Drupal\drupal_parasol\Controller;

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

    $path = drupal_get_path('module', 'drupal_parasol') . '/js/skeleton.js';

    $attach['#attached']['html_head'][] = [

      [
        '#tag' => 'script',
        '#attributes' => [
          '#type' => 'application/javascript',
          'src'=> $path
        ]
      ]
    ];
    return $attach;
  }

}
