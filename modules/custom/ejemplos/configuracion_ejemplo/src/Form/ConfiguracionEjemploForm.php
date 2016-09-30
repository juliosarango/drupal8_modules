<?php

namespace Drupal\configuracion_ejemplo\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class ConfiguracionEjemploForm.
 *
 * @package Drupal\configuracion_ejemplo\Form
 */
class ConfiguracionEjemploForm extends ConfigFormBase {


  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'configuracion_ejemplo_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
      
    $form = parent::buildForm($form, $form_state);
    $config = $this->config('configuracion_ejemplo.settings');     
    
    $form['email'] = array(
      '#type' => 'email',
      '#title' => $this->t('Email address'),
      '#description' => $this->t('Type your email address'),
      '#default_value'   => $config->get('configuracion_ejemplo.email_address'),
    );
    $form['name'] = array(
      '#type'   => 'textfield',
      '#title' => $this->t('Name'),
      '#description' => $this->t('Type your name'),
      '#default_value' => $config->get('configuracion_ejemplo.name'),        
    );
    
    return $form;
  }

  /**
    * {@inheritdoc}
    */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Display result.
    $config = $this->config('configuracion_ejemplo.settings');
    $config->set('configuracion_ejemplo.email_address', $form_state->getValue('email'));
    $config->set('configuracion_ejemplo.name', $form_state->getValue('name'));
    $config->save();
    
    return parent::submitForm($form, $form_state);

  }

    protected function getEditableConfigNames() {
        return ['configuracion_ejemplo.settings'];
    }

}
