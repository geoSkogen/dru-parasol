<?php

namespace Drupal\drupal_parasol\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'Hello' Block.
 *
 * @Block(
 *   id = "hello_block",
 *   admin_label = @Translation("Hello block"),
 *   category = @Translation("Hello World"),
 * )
 */
class ParasolBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $config = $this->getConfiguration();

    if (!empty($config['hello_block_name'])) {
      $name = $config['hello_block_name'];
    }
    else {
      $name = $this->t('to no one');
    }

    //drupal_add_js(drupal_get_path('module', 'drupal_parasol') . 'js/skeleton.js');

    return [
      '#title' => 'Another Contentful Drupal Block',
      '#markup' => '<h1 class="translate" data-toggle="1" data="meet">HELLO</h1>
                    <h1 class="translate" data-toggle="1" data="JavaScript">DRUPAL</h1>
                    <h1 class="translate" data-toggle="1" data="hello">MEET</h1>
                    <h1 class="translate" data-toggle="1" data="Drupal">JAVASCRIPT</h1>
                    <h1 class="translate" data-toggle="1" data="meet">HELLO</h1>
                    <h1 class="translate" data-toggle="1" data="Drupal">JAVASCRIPT</h1>
                    <h1 class="translate" data-toggle="1" data="hello">MEET</h1>
                    <h1 class="translate" data-toggle="1" data="JavaScript">DRUPAL</h1>'
    ];
  }

  public function blockForm($form, FormStateInterface $form_state) {
   $form = parent::blockForm($form, $form_state);

   $config = $this->getConfiguration();

   $form['hello_block_name'] = [
     '#type' => 'textfield',
     '#title' => $this->t('Who'),
     '#description' => $this->t('Who do you want to say hello to?'),
     '#default_value' => $config['hello_block_name'] ?? '',
   ];

   return $form;
 }

 /**
 * {@inheritdoc}
 */
 public function blockSubmit($form, FormStateInterface $form_state) {
   parent::blockSubmit($form, $form_state);
   $values = $form_state->getValues();
   $this->configuration['hello_block_name'] = $values['hello_block_name'];
 }

 /**
  * {@inheritdoc}
  */
 public function blockValidate($form, FormStateInterface $form_state) {
   if($form_state->getValue('hello_block_name') === 'John'){
     $form_state->setErrorByName('hello_block_name', $this->t('You can not say hello to John.'));
   }
 }

}
