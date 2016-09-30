<?php

namespace Drupal\contacto_test\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\contacto_test\ContactoTestStorage;

/**
 * Class ContactoTestAddForm.
 *
 * @package Drupal\contacto_test\Form
 */
class ContactoTestAddForm extends FormBase {


  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'contacto_test_add_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
      
    $form = array();
              
    $form['add'] = array(
      '#type' => 'fieldset',
      '#title' => $this->t('Add a person entry'),
    );
    $form['add']['name'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Name'),
      '#description' => $this->t("Add person's name"),
      '#maxlength' => 64,
      '#size' => 64,
    );
    $form['add']['surname'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Surname'),
      '#description' => $this->t("Add person's surname"),
      '#maxlength' => 64,
      '#size' => 64,
    );
    $form['add']['age'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Age'),
      '#description' => $this->t("Add person's age"),
      '#maxlength' => 5,
      '#size' => 5,
    );

    $form['add']['submit'] = array(
        '#type' => 'submit',
        '#value' => t('Add'),
    );

    return $form;
  }

  /**
    * {@inheritdoc}
    */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    if (!intval($form_state->getValue('age'))){
        $form_state->setErrorByName('age', $this->t('Age needs to be a number'));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
      
      $account = $this->currentUser();
      
      $entry = array(
          'name' => $form_state->getValue('name'),
          'surname' => $form_state->getValue('surname'),
          'age' => $form_state->getValue('age'),
          'uid' => $account->id(),
      );
      $return = ContactoTestStorage::insert($entry);
      if ($return) {
          //drupal_set_message(t('Created entry @entry', array('@entry' => print_r($entry, TRUE))));
           \Drupal::logger('contacto_test')->notice('Entry %name has been submited', array('%name' => $entry['name']));
            drupal_set_message(t('Contacto agregado correctamente.'));
      }
    
      
    

  }

}
