<?php

namespace Drupal\pagina_ejemplo\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'PaginaEjemploConfigurableTextBlock' block.
 *
 * @Block(
 *  id = "pagina_ejemplo_configurable_text_block",
 *  admin_label = @Translation("Pagina ejemplo configurable text block"),
 * )
 */
class PaginaEjemploConfigurableTextBlock extends BlockBase {
    
  /**
   * {@inheritdoc}
   */  
  public function defaultConfiguration() {
      return [
          'pagina_ejemplo_string' => $this->t('A default value, this block was created at %time', ['%time' => date('c')]),
          ];
  }

  
  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form['pagina_ejemplo_string_text'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Block contents'),
      '#description' => $this->t('This text will appear in the example block'),
      '#default_value' => $this->configuration['pagina_ejemplo_string'],
      '#maxlength' => 80,
      '#size' => 80,
      '#weight' => '0',
    );

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['pagina_ejemplo_string'] = $form_state->getValue('pagina_ejemplo_string_text');
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    $build['pagina_ejemplo_string_text']['#markup'] = '<p>' . $this->configuration['pagina_ejemplo_string'] . '</p>';

    return $build;
  }

}
