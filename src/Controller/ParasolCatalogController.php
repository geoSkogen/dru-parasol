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
    $attach['#markup'] = '<div id="parasol-detail-modal-wrapper" class="flex-row flex-center">
                            <div id="relshell-modal" class="relshell">
                              <article id="product-detail-modal" class="modal">
                                <div class="flex-row flex-end"><div class="close-modal">&times;</div></div>
                                <div id="product-detail-modal-interior"></div>
                              </article>
                            </div>
                          </div>

                          <div id="parasol-catalog-wrapper" class="flex-row flex-center">

                            <div id="parasol-catalog-detail-wrapper" class-"flex-row flex-center">

                              <article id="parasol-catalog-detail" class="product-schema">
                                <a href="#" id="catalog-detail-title-anchor" class="product-nav-anchor">
                                  <h2 id="catalog-detail-title" class="noshout"></h2>
                                </a>
                                <img src="#" id="catalog-detail-image" />
                                <section id="product-detail-meta" class="wristband">
                                <!-- -->
                                </section>
                              </article>

                            </div>

                            <div id="parasol-catalog-select-scroll">

                              <div id="relshell-scroll" class="relshell">
                                <section id="product-select-scroll-nav" class="toolkit">
                                  <p id="product-select-scroll-up" class="scroll-nav">
                                    <i id="scroll-up-icon" class="fa fa-arrow-circle-o-up" aria-hidden="true"></i>
                                  </p>
                                  <p id="product-select-scroll-down" class="scroll-nav">
                                    <i id="scroll-down-icon" class="fa fa-arrow-circle-o-down" aria-hidden="true"></i>
                                  </p>
                                </section>
                              </div>

                            </div>

                            <div id="parasol-catalog-select-wrapper" class="flex-col flex-start">

                              <ul id="parasol-catalog-selector">
                              <!-- -->
                              </ul>
                            </div>
                          </div>';
    return $attach;
  }

}
