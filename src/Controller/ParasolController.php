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
    $attach['#markup'] = '<div id="translator-wrapper" class="flex-row flex-center">
                  <h1 class="translate" data-toggle="1" data="meet">HELLO</h1>
                  <h1 class="translate" data-toggle="1" data="JavaScript">DRUPAL</h1>
                  <h1 class="translate" data-toggle="1" data="hello">MEET</h1>
                  <h1 class="translate" data-toggle="1" data="Drupal">JAVASCRIPT</h1>
                  <h1 class="translate" data-toggle="1" data="meet">HELLO</h1>
                  <h1 class="translate" data-toggle="1" data="Drupal">JAVASCRIPT</h1>
                  <h1 class="translate" data-toggle="1" data="hello">MEET</h1>
                  <h1 class="translate" data-toggle="1" data="JavaScript">DRUPAL</h1></div>';
    $attach['#title'] = 'The Parasol Route Callback';              

    return $attach;
  }

}
