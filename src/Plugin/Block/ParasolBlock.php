<?php

namespace Drupal\parasol\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'Parasol' Block.
 *
 * @Block(
 *   id = "parasol_block",
 *   admin_label = @Translation("Parasol Block"),
 *   category = @Translation("hello parasol"),
 * )
 */
class ParasolBlock extends BlockBase {

  public function build() {
    $config = $this->getConfiguration();

    if (!empty($config['parasol_block_name'])) {
      $name = $config['parasol_block_name'];
    }
    else {
      $name = $this->t('no one');
    }

    $attach = [
      '#markup' => $this->t('This Parasol Custom Block Value is @name',[
        '@name' => $name
      ])

    ];

    return $attach;
  }


  public function blockForm($form, FormStateInterface $form_state) {
   $form = parent::blockForm($form, $form_state);

   $config = $this->getConfiguration();

   $form['parasol_block_name'] = [
     '#type' => 'textfield',
     '#title' => $this->t('Who'),
     '#description' => $this->t('Who do you want to say hello to?'),
     '#default_value' => $config['parasol_block_name'] ?? '',
   ];

   return $form;
 }


 public function blockSubmit($form, FormStateInterface $form_state) {
   parent::blockSubmit($form, $form_state);
   $values = $form_state->getValues();
   $this->configuration['parasol_block_name'] = $values['parasol_block_name'];
 }



 public function blockValidate($form, FormStateInterface $form_state) {
   if($form_state->getValue('parasol_block_name') === ''){
     $form_state->setErrorByName('parasol_block_name', $this->t('Field cannot be blank'));
   }
 }

}
