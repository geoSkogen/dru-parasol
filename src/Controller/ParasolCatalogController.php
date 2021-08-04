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

    //$items = '{{ select-item }}';

    $attach['#attached']['library'][] = 'parasol/parasol_catalog';
    $attach['#title'] = 'The Parasol Catalog Demo';
    $attach['#markup'] = '<div id="parasol-catalog-wrapper" class="flex-row flex-center">
                            <div id="parasol-catalog-detail-wrapper" class-"flex-row flex-center">
                              <article id="parasol-catalog-detail" class="product-schema">
                                <h2 id="catalog-detail-title" class="noshout"></h2>
                                <img src="#" id="catalog-detail-image" />
                                <section id="product-detail-meta" class="wristband">

                                </section>
                              </article>
                            </div>
                            <div id="parasol-catalog-select-wrapper" class="flex-col flex-start">
                              <ul id="parasol-catalog-selector">
                              
                              </ul>
                            </div>
                          </div>';
    return $attach;
  }

}
