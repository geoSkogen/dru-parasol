<?php

namespace Drupal\parasol\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

class ParasolSyllableMillForm extends ConfigFormBase {

  public function getFormID() {
    return 'parasol_syllablemill_form';
  }

  public function buildForm( array $form, FormStateInterface $form_state) {
    $form = parent::buildForm($form, $form_state);
    $config = $this->config('parasol.syllablemill');

    $fields = [
      'syllables_qty'=> array_combine(range(1,12), range(1,12)),
      'syllables_cap'=> array_combine(range(1, 9), range(1, 9)),
      'words_cap'=> array_combine(range(1, 25), range(1, 25)),
      'phrases_cap'=> array_combine(range(1, 25), range(1, 25)),
      'paragraphs_qty'=> array_combine(range(1, 9), range(1, 9)),
    ];

    $form['syllables_qty'] = [
      '#type' => 'select',
      '#options' => $fields['syllables_qty'],
      '#title' => 'syllables',
      '#description' => 'get a radom word with this many syllables'
    ];

    $form['syllables_cap'] = [
      '#type' => 'select',
      '#options' => $fields['syllables_cap'],
      '#title' => 'syllable cap',
      '#description' => 'max syllables per random word'
    ];

    $form['words_cap'] = [
      '#type' => 'select',
      '#options' => $fields['words_cap'],
      '#title' => 'word cap',
      '#description' => 'max number of words per phrase'
    ];

    $form['phrases_cap'] = [
      '#type' => 'select',
      '#options' => $fields['phrases_cap'],
      '#title' => 'phrase cap',
      '#description' => 'max number of phrases per paragraph'
    ];

    $form['paragraphs_qty'] = [
      '#type' => 'select',
      '#options' => $fields['paragraphs_qty'],
      '#title' => 'paragraphs',
      '#description' => 'number of paragraphs'
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#title' => 'go'
    ];

    return $form;
  }

  public function validateForm(array &$form, FormStateInterface $form_state) {

  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = $this->config('parasol.syllablemill');
    $config->set('parasol.syllables_qty',$form_state->getValue('syllables_qty'));
    $config->set('parasol.syllables_cap', $form_state->getValue('syllables_cap'));
    $config->set('parasol.words_cap',$form_state->getValue('words_cap'));
    $config->set('parasol.phrases_cap', $form_state->getValue('phrases_cap'));
    $config->set('parasol.paragraphs_qty', $form_state->getValue('paragraphs_qty'));
    $config->save();
    return parent::submitForm($form, $form_state);
  }

  protected function getEditableConfigNames() {
    return [
      'parasol.syllablemill'
    ];
  }
}



?>
