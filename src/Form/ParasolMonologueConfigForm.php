<?php

namespace Drupal\parasol\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class ParasolMonologueConfigForm extends ConfigFormBase {

  public function getFormID() {
    return 'parasol_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildForm($form, $form_state);
    $config = $this->config('parasol.settings');

    $form['page_title'] = [
      '#type' =>'textfield',
      '#title'=> $this->t('what you call it'),
      '#default_value' => $config->get('parasol.page_title'),
      '#description' => $this->t('enter a title here')
    ];

    $form['source_text'] = [
      '#type' =>'textarea',
      '#title'=> 'what it is',
      '#default_value' => $config->get('parasol.source_text'),
      '#description' => $this->t('make some good words')
    ];

    return $form;
  }

  public function validateForm(array &$form, FormStateInterface $form_state) {

  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = $this->config('parasol.settings');
    $config->set('parasol.page_title',$form_state->getValue('page_title'));
    $config->set('parasol.source_text', $form_state->getValue('source_text'));
    $config->save();
    return parent::submitForm($form, $form_state);
  }

  protected function getEditableConfigNames() {
    return [
      'parasol.settings'
    ];
  }

}
?>
