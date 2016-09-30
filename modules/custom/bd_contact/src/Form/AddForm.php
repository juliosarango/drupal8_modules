<?php

namespace Drupal\bd_contact\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\bd_contact\BdContactStorage;

/**
 * Class AddForm.
 *
 * @package Drupal\bd_contact\Form
 */
class AddForm extends FormBase {


  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'bd_contact_add';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['name'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Name'),
      '#description' => $this->t('Add contact&#039;s name'),
      '#maxlength' => 40,
      '#size' => 40,
    );
    $form['message'] = array(
      '#type' => 'textarea',
      '#title' => $this->t('Add a message'),
      '#description' => $this->t('Add a message'),
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
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
          
      $name = $form_state->getValue('name');
      $message = $form_state->getValue('message');
      
      BdContactStorage::add($name, $message);
      
      \Drupal::logger('bd_contact')->notice('Bd Contact message from %name has been submited', array('%name' => $name));
      drupal_set_message(t('Contacto agregado correctamente.'));
      
      $form_state->setRedirect('bd_contact_list');
      
      

  }

}
