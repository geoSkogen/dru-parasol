<?php
namespace Drupal\parasol\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Provides route responses for the Example module.
 */
class ParasolCatalogController extends ControllerBase {

  /**
   * Returns a simple page.
   *
   * @return array
   *   A simple renderable array.
   */
  public function initView() {

    $attach['#attached']['library'][] = 'parasol/parasol_catalog';
    $attach['#markup'] = '<h3>The Chill Markup</h3>';


    return $attach;
  }

}
