<?php

namespace Drupal\contacto_test\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\contacto_test\ContactoTestStorage;

/**
 * Class ContactoTestController.
 *
 * @package Drupal\contacto_test\Controller
 */
class ContactoTestController extends ControllerBase {

  /**
   * Entrylist.
   *
   * @return string
   *   Return Hello string.
   */
  public function entryList() {
      
    $content = array();
    
    $content['message'] = array(
        '#markup' => $this->t('Generate a list of all entries in the database'),
    );
    
    $rows = array();
    
    $headers = array(t('Id'),t('uid'),t('Name'),t('Surname'),t('Age'));
    $entries = ContactoTestStorage::load();
    
    
    foreach ($entries = ContactoTestStorage::load() as $entry)
    {
        $rows[] = array_map('\Drupal\Component\Utility\SafeMarkup::checkPlain', (array)$entry);
    }
    
    
    
   $content['table'] = array(
        '#type' => 'table',
        '#header' => $headers,
        '#rows' => $rows,
        '#empty' => t('No entries available'),
    );
    
    //Don't cache this page
    $content['#cache']['max-age'] = 0;
    
    return $content;  
    
  }
  
  /**
   * 
   * Render a filtered list of entries iin the database
   */
  
  public function entryAdvancedList() {
      
    $content = array();
    
    $content['message'] = array(
        '#markup' => $this->t('A more complex list of entries in the database') . ' '. 
        $this->t('Only the entries with name = "John" and age older than 18 years are shown, the username of the person who created the entry is also shown.')
    );
    
    $headers = array(t('Id'),t('Created by'), t('Name'),t('Surname'),t('Age'));
    
    $rows =  array();
    foreach ($entries = ContactoTestStorage::advancedLoad() as $entry) {
        $rows[] = array_map('Drupal\Component\Utility\SafeMarkup::checkPlain', $entry);        
    }
    
    $content['table'] = array(
        '#type' => 'table',
        '#header' => $headers,
        '#rows' => $rows,
        '#attributes' => array('id' => 'contacto_test-advanced-list'),
        '#empty' => t('No entries available'),
    );
    
    $content['#cache']['max-age'] = 0;
    
    return $content;
            
    
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Implement method: entryAdvancedList')
    ];
  }
  

}
