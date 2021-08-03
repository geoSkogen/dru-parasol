<?php

/**
 * @file
 * Contains \Drupal\parasol\Plugin\field\formatter\ParasolFormatter.
 */

namespace Drupal\snippets\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;

/**
 * Plugin implementation of the 'snippets_default' formatter.
 *
 * @FieldFormatter(
 *   id = "parasol_default",
 *   label = @Translation("Parasol default"),
 *   field_types = {
 *     "parasol_code"
 *   }
 * )
 */
class ParasolFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = array();
    foreach ($items as $delta => $item) {
      // Render output using snippets_default theme.
      $source = array(
        '#theme' => 'parasol_default',
        '#source_description' => $item->source_description,
        '#source_code' => $item->source_code,
      );

      $elements[$delta] = array('#markup' => \Drupal::service('renderer')->render($source));
    }

    return $elements;
  }

}
