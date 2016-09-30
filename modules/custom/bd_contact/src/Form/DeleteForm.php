<?php

namespace Drupal\bd_contact\Form;

use Drupal\Core\Form\ConfirmFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Drupal\bd_contact\BdContactStorage;

/**
 * Class DeleteForm.
 *
 * @package Drupal\bd_contact\Form
 */
class DeleteForm extends ConfirmFormBase {
    
    protected $id;


    /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'bd_contact_delete';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, $id = '') {
      
    $this->id = $id;

    /*$form['submit'] = array(
        '#type' => 'submit',
        '#value' => t('Submit'),
    );

    return $form;*/
    return parent::buildForm($form, $form_state);
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
    
      BdContactStorage::delete($this->id);
      
      \Drupal::logger('bd_contact')->notice('Bd Contact %id ha sido eliminado', array('%id' => $this->id));
      drupal_set_message(t('Contacto eliminado correctamente.'));
      
      $form_state->setRedirect('bd_contact_list');

  }

    public function getCancelUrl() {
        
        return new Url('bd_contact_list');
        
    }

    public function getQuestion() {
        
        return t('Are you sure you want to delete submiss %id', array('%id' => $this->id));        
    }
    
    function getConfirmText() {
        return t('Delete');
    }
    
    function getCancelRoute() {
        return new Url('bd_contact.list');
    }

}
