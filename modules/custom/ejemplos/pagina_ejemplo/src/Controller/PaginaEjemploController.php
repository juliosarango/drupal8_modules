<?php

namespace Drupal\pagina_ejemplo\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Link;
use Drupal\Core\Url;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

/**
 * Class PaginaEjemploController.
 *
 * @package Drupal\pagina_ejemplo\Controller
 */
class PaginaEjemploController extends ControllerBase {

  /**
   * Description.
   *
   * @return string
   *   Return Hello string.
   */
  public function description() {
      
    $ejemplo_pagina_simple_link = Link::createFromRoute($this->t('simple page'), 'pagina_ejemplo.simple')->toString();
    
    $arguments_url = Url::fromRoute('pagina_ejemplo.arguments', array('first' => '23', 'second' => '56'));
    $ejemplo_pagina_arguments_link = Link::fromTextAndUrl($this->t('arguments page'), $arguments_url)->toString();
      
    $build = array(
        '#markup' => $this->t('<p>Este modulo provee dos páginas, una simple y otra con argumentos</p><p>El @simple_link retorna un array renderizable.</p><p>El @arguments_link toma 2 argumentos y los muestra, como un @arguments_url</p>',
                array(
                    '@simple_link' => $ejemplo_pagina_simple_link,
                    '@arguments_link' => $ejemplo_pagina_arguments_link,
                    '@arguments_url' => $arguments_url->toString(),
                )),
    );
    return $build;
  }
  /**
   * Simple.
   *
   * @return string
   *   Return Hello string.
   */
  public function simple() {
      
//    $perms = array_keys(\Drupal::service('user.permissions')->getPermissions());
//    var_dump($perms);
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Implement method: simple')
    ];
  }
  
  public function arguments($first, $second) {
      
    if (!is_numeric($first) || !is_numeric($second)) {
          throw new AccessDeniedHttpException();
    }
    
    $list[] = $this->t('First number was @numer', array('@number' => $first));
    $list[] = $this->t('Second number was @number', array('@number' => $second));;
    $list[] = $this->t('The total was @number', array('@number' => $first + $second));
      
    $render_array['page_example.arguments'] = array(
        '#theme' => 'item_list',
        '#title' => $this->t('Argument Information'),
    );
    
    return $render_array;
  }

}
