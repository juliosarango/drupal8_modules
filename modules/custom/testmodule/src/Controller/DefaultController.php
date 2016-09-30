<?php

namespace Drupal\testmodule\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class DefaultController.
 *
 * @package Drupal\testmodule\Controller
 */
class DefaultController extends ControllerBase {

  /**
   * Contenido.
   *
   * @return string
   *   Return Hello string.
   */
  public function contenido($num) {    
    return [
      '#theme' => 'test_module',
      '#test_var' => $this->t('esta es la segunda prueba'),
      '#num_var' => (int)$num
    ];
  }

}
