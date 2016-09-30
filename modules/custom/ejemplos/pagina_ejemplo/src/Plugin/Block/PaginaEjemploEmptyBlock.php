<?php

namespace Drupal\pagina_ejemplo\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'PaginaEjemploEmptyBlock' block.
 *
 * @Block(
 *  id = "pagina_ejemplo_empty_block",
 *  admin_label = @Translation("Bloque de Prueba"),
 * )
 */
class PaginaEjemploEmptyBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    $build['pagina_ejemplo_empty_block']['#markup'] = 'Implement PaginaEjemploEmptyBlock.';

    return $build;
  }

}
