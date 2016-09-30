<?php

namespace Drupal\pagina_ejemplo\Tests;

use Drupal\simpletest\WebTestBase;

/**
 * Provides automated tests for the pagina_ejemplo module.
 */
class PaginaEjemploControllerTest extends WebTestBase {


  /**
   * {@inheritdoc}
   */
  public static function getInfo() {
    return array(
      'name' => "pagina_ejemplo PaginaEjemploController's controller functionality",
      'description' => 'Test Unit for module pagina_ejemplo and controller PaginaEjemploController.',
      'group' => 'Other',
    );
  }

  /**
   * {@inheritdoc}
   */
  public function setUp() {
    parent::setUp();
  }

  /**
   * Tests pagina_ejemplo functionality.
   */
  public function testPaginaEjemploController() {
    // Check that the basic functions of module pagina_ejemplo.
    $this->assertEquals(TRUE, TRUE, 'Test Unit Generated via Drupal Console.');
  }

}
