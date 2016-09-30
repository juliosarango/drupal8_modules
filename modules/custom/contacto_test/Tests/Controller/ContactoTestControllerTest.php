<?php

namespace Drupal\contacto_test\Tests;

use Drupal\simpletest\WebTestBase;

/**
 * Provides automated tests for the contacto_test module.
 */
class ContactoTestControllerTest extends WebTestBase {


  /**
   * {@inheritdoc}
   */
  public static function getInfo() {
    return array(
      'name' => "contacto_test ContactoTestController's controller functionality",
      'description' => 'Test Unit for module contacto_test and controller ContactoTestController.',
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
   * Tests contacto_test functionality.
   */
  public function testContactoTestController() {
    // Check that the basic functions of module contacto_test.
    $this->assertEquals(TRUE, TRUE, 'Test Unit Generated via Drupal Console.');
  }

}
