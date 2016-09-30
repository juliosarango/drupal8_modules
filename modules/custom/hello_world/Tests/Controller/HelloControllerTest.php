<?php

namespace Drupal\hello_world\Tests;

use Drupal\simpletest\WebTestBase;

/**
 * Provides automated tests for the hello_world module.
 */
class HelloControllerTest extends WebTestBase {


  /**
   * {@inheritdoc}
   */
  public static function getInfo() {
    return array(
      'name' => "hello_world HelloController's controller functionality",
      'description' => 'Test Unit for module hello_world and controller HelloController.',
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
   * Tests hello_world functionality.
   */
  public function testHelloController() {
    // Check that the basic functions of module hello_world.
    $this->assertEquals(TRUE, TRUE, 'Test Unit Generated via Drupal Console.');
  }

}
