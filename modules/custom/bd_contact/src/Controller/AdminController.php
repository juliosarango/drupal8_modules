<?php

namespace Drupal\bd_contact\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\bd_contact\BdContactStorage;
use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * Class AdminController.
 *
 * @package Drupal\bd_contact\Controller
 */
class AdminController extends ControllerBase {

  /**
   * Content.
   *
   * @return string
   *   Return Hello string.
   */
  public function content() {
    
    $url = Url::fromRoute('bd_contact_add');  
    $add_link = Link::fromTextAndUrl(t('New Message'), $url);
        
    $header = array(
        'id' => t('Id'),
        'name' => t('Submiter name'),
        'message' => t('Message'),
        'operations' => t('Delete'),
    );
    
    $rows = array();
    
    foreach (BdContactStorage::getAll() as $id => $content) {
        $url2 = Url::fromRoute('bd_contact_delete', array('id' => $id));
        $rows[] = array(
            'data' => array($id, $content->name, $content->message, Link::fromTextAndUrl('Delete',$url2))
            );
        
    }
    $rows[] = array(
        'data' => array($add_link,"","",""),
    );
    
    $table = array(        
        '#type' => 'table',
        '#header' => $header,
        '#rows' => $rows,
        '#attributes' => array(
            'id' => 'bd-contact-table',
        ),        
    );
    return $table;
  }

}
