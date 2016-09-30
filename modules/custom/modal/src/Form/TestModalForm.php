<?php

namespace Drupal\modal\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\OpenModalDialogCommand;

/**
 * Class TestModalForm.
 *
 * @package Drupal\modal\Form
 */
class TestModalForm extends FormBase {


  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'test_modal_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    
    $form['#attached']['library'][] = 'core/drupal.dialog.ajax';
          
    $form['node_title'] = array(
      '#type' => 'textfield',
      '#title' => $this->t("Node's title"),
      '#description' => $this->t("Node's title"),
      '#maxlength' => 64,
      '#size' => 64,
    );

    $form['submit'] = array(
        '#type' => 'submit',
        '#value' => t('Submit'),
        '#ajax' => array(
            'callback' => '::open_modal',
        ),
    );

    return $form;
  }
  
  public function open_modal(&$form, FormStateInterface $form_state) {
    $node_title = $form_state->getValue('node_title');

    $query = \Drupal::entityQuery('node')
            ->condition('title', $node_title);
    $entity = $query->execute();

    $key = array_keys($entity);
    $id = !empty($key[0])? $key[0] : NULL;
            
    $response = new AjaxResponse();

    $title = 'Node ID';

    if ($id !== NULL) {
        $content = '<div class="test-popup-content"> Node id is: '.$id . "<br/>";
        $content .= "Esta es una prueba de modales";
        $content .= "</div>";
        $options = array(
            'dialogClass' => 'popup-dialog-class',
            'width' => '300',
            'height' => '300',
        );
      $response->addCommand(new OpenModalDialogCommand($title,$content, $options));
    }
    else {
        $content = 'Not found record with this title';
        $response->addCommand(new OpenModalDialogCommand($title, $content));
    }

    return $response;
          
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
    foreach ($form_state->getValues() as $key => $value) {
        drupal_set_message($key . ': ' . $value);
    }

  }

}
