<?php

/**
 * @file
 * Contains  
 */

namespace Drupal\loremipsum\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

/**
 *  Lorem ipsum block form
 */

class LoremIpsumBlockForm extends FormBase {
    
    public function buildForm(array $form, FormStateInterface $form_state) {
        
        $options  = array_combine(range(1,10),range(1,10));
        
        //how many paragraphs
        $form['paragraphs'] = array(
            '#type' => 'select',
            '#title' => $this->t('Paragraphs'),
            '#options' => $options,
            '#default_value' => 4,
            '#description' => $this->t('How many?'),
        );
        
        //how many phrases?
        $form['phrases'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('Phrases'),
            '#default_value' => '20',
            '#description' => $this->t('Maximum per paragraph'),
        );
        
        //submit
        $form['sumbit'] = array(
            '#type' => 'submit',
            '#value' => $this->t('Generate'),
        );
        
        return $form;
        
    }
    
    /**
     * {@inheritdoc}
     */
    public function validateForm(array &$form, FormStateInterface $form_state) {
        //parent::validateForm($form, $form_state);
        $phrases = $form_state->getValue('phrases');
        
        if (!is_numeric($phrases))
            $form_state->setErrorByName ('phrases', $this->t('Please use a number'));
        if (floor($phrases) != $phrases)
            $form_state->setErrorByName ('phrases', $this->t('No decimal, please.'));
        if ($phrases < 1)
            $form_state->setErrorByName ('phrases', $this->t('Please use a number greater than zero'));
    }          

    /**
     * {@inheritdoc}
     */

    public function getFormId() {
        
        return 'loremipsum_block_form';        
    }

    public function submitForm(array &$form, FormStateInterface $form_state) {
        
        /*$url = Url::fromRoute('loremipsum.generate', array(
                'paragraphs' => $form_state->getValue('paragraphs'),
                'phrases' => $form_state->getValue('phrases')));
    var_dump($url);
    die("aqui");
          $form_state->setRedirectUrl($url);
         */
        
        $form_state->setRedirect(                
                'loremipsum.generate',
                array(
                    'paragraphs' => $form_state->getValue('paragraphs'),
                    'phrases' => $form_state->getValue('phrases')
                )
            );                           
    }
}
