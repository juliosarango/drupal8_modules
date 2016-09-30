<?php

namespace Drupal\hello_world\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class HelloController.
 *
 * @package Drupal\hello_world\Controller
 */
class HelloController extends ControllerBase {

  /**
   * Content.
   *
   * @return string
   *   Return Hello string.
   */
  public function content() {
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Hola mundo, esta es una prueba')
    ];
  }

}
