<?php
/**
 * @file
 * Contains \Drupal\parasol\Plugin\Field\FieldType\ParasolItem.
 */

namespace Drupal\snippets\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Plugin implementation of the 'snippets' field type.
 *
 * @FieldType(
 *   id = "parsol_code",
 *   label = @Translation("Parasol field"),
 *   description = @Translation("This field stores code snippets in the database."),
 *   default_widget = "parasol_default",
 *   default_formatter = "parasol_default"
 * )
 */
class ParasolItem extends FieldItemBase {

  /**
  * {@inheritdoc}
  */
  static $propertyDefinitions;

  /**
 * {@inheritdoc}
 */
  public static function schema(FieldStorageDefinitionInterface $field) {
    return array(
      'columns' => array(
        'source_description' => array(
          'type' => 'varchar',
          'length' => 256,
          'not null' => FALSE,
        ),
        'source_code' => array(
          'type' => 'text',
          'size' => 'big',
          'not null' => FALSE,
        ),
        'source_lang' => array(
          'type' => 'varchar',
          'length' => 256,
          'not null' => FALSE,
        ),
      ),
    );
  }
  //
  /**
 * {@inheritdoc}
 */
 public function isEmpty() {
   $value = $this->get('source_code')->getValue();
   return $value === NULL || $value === '';
 }

 /**
 * {@inheritdoc}
 */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    $properties['source_description'] = DataDefinition::create('string')
      ->setLabel(t('Snippet description'));

    $properties['source_code'] = DataDefinition::create('string')
      ->setLabel(t('Snippet code'));

    $properties['source_lang'] = DataDefinition::create('string')
      ->setLabel(t('Programming Language'))
      ->setDescription(t('Snippet code language'));

    return $properties;
  }
}
