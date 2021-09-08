<?php

namespace Drupal\parasol\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Session\AccountInterface;
/**
* @Block(
*  id = "parasol_monologue_block",
*   admin_label = @Translation("parasol monologue block")
*  )
*/
class ParasolMonologueBlock extends BlockBase {

  public function build() {
    error_log('PARASOL-MONOLOGUE-BLOCK -form build call');
    return \Drupal::formBuilder()->getForm('Drupal\parasol\Form\ParasolMonologueBlockForm');
  }

  public function blockForm($form, FormStateInterface $form_state) {
    $form = parent::blockForm($form, $form_state);
    $config = $this->getConfiguration();
    return $form;
  }
  /*
  public function blockAccess(AccountInterface $account) {
    return AccessResult::allowedIfHasPermission( $account, 'administer site configuration' );
  }
  */

  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->setConfigurationValue('parasol_block_settings', $form_state->getValue('parasol_block_settings'));
  }
}
?>
