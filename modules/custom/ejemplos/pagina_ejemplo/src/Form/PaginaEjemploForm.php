<?php

namespace Drupal\pagina_ejemplo\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class PaginaEjemploForm.
 *
 * @package Drupal\pagina_ejemplo\Form
 */
class PaginaEjemploForm extends FormBase {


  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'pagina_ejemplo_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['email'] = array(
      '#type' => 'email',
      '#title' => $this->t('Type your email address'),
      '#description' => $this->t('You email address'),
    );

    $form['submit'] = array(
        '#type' => 'submit',
        '#value' => t('Submit'),
    );

    return $form;
  }

  /**
    * {@inheritdoc}
    */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    if (strpos($form_state->getValue('email'), '.com') === FALSE ) {
        $form_state->setErrorByName('email', $this->t('This is a not a .com email address'));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Display result.
    drupal_set_message($this->t('Your email address is @email', array('@email' => $form_state->getValue('email'))));

  }

}
