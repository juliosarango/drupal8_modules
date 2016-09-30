<?php

namespace Drupal\testmodule\Tests;

use Drupal\simpletest\WebTestBase;

/**
 * Provides automated tests for the testmodule module.
 */
class DefaultControllerTest extends WebTestBase {


  /**
   * {@inheritdoc}
   */
  public static function getInfo() {
    return array(
      'name' => "testmodule DefaultController's controller functionality",
      'description' => 'Test Unit for module testmodule and controller DefaultController.',
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
   * Tests testmodule functionality.
   */
  public function testDefaultController() {
    // Check that the basic functions of module testmodule.
    $this->assertEquals(TRUE, TRUE, 'Test Unit Generated via Drupal Console.');
  }

}
