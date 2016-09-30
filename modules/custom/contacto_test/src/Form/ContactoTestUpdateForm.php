<?php

namespace Drupal\contacto_test\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\contacto_test\ContactoTestStorage;

/**
 * Class ContactoTestUpdateForm.
 *
 * @package Drupal\contacto_test\Form
 */
class ContactoTestUpdateForm extends FormBase {


  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'contacto_test_update_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
      
    $form = array(
        '#prefix' => '<div id="updateform">',
        '#sufix' => '</div>',
    );
    
    $form['message'] = array(
        '#markup'=> $this->t('Demostrate a database update operation'),
    );
    
    $entries = ContactoTestStorage::load();
    if (empty($entries)) {
        $form['no_values'] = array(
            '#value' => t('No entries esist in then tabla contacto_test'),
        );
        return $form;
    }
    
    $keyed_entries = array();
    foreach ($entries as $entry)
    {
        $options[$entry->pid] = t('@pid: @name @surname (@age)',array(
            '@pid' => $entry->pid,
            '@name' => $entry->name,
            '@surname' => $entry->surname,
            '@age' => $entry->age,
        ));
        $keyed_entries[$entry->pid] = $entry;
    }
    
    $pid = $form_state->getValue('pid');
    $default_entry = !empty($pid) ? $keyed_entries : $entries[0];
    $form_state->setValue('entries', $keyed_entries);
            
    $form['pid'] = array(
        '#type' => 'select',
        '#options' => $options,
        '#title' => t('Choose entry to update'),
        '#default_value' => $default_entry->pid,
        '#ajax' => array(
            'wrapper' => 'updateform',
            'callback' => array($this, 'updateCallback'),
        ),
    );
      
    $form['name'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Name'),
      '#maxlength' => 64,
      '#size' => 64,
      '#default_value'   => $default_entry->name,
    );
    $form['surname'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('surname'),
      '#maxlength' => 64,
      '#size' => 64,
      '#default_value'   => $default_entry->surname,
    );
    $form['age'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('age'),
      '#maxlength' => 64,
      '#size' => 64,
      '#default_value'   => $default_entry->age,  
    );

    $form['submit'] = array(
        '#type' => 'submit',
        '#value' => t('Submit'),
    );

    return $form;
  }
  
  public function updateCallback(array $form, FormStateInterface $form_state) {
      
      $entries = $form_state->getValue('entries');      
      $entry = $entries[$form_state->getValue('pid')];
      
      foreach (array('name','surname','age') as $item) {
          $form[$item]['#value'] = $entry->$item;
      }
      
      return $form;
  }

  /**
    * {@inheritdoc}
    */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
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
          'pid' => $form_state->getValue('pid'),
          'name' => $form_state->getValue('name'),
          'surname' => $form_state->getValue('surname'),
          'age' => $form_state->getValue('age'),
          'uid' => $account->id(),
      );
      
      $count = ContactoTestStorage::update($entry);
      drupal_set_message(t('Updated entry @entry (@count row updated)',array(
          '@count' => $count,
          '@entry' => print_r($entry,TRUE),
      )));
      
      
  }

}
