<?php

namespace Drupal\bd_contact\Tests;

use Drupal\simpletest\WebTestBase;

/**
 * Provides automated tests for the bd_contact module.
 */
class AdminControllerTest extends WebTestBase {


  /**
   * {@inheritdoc}
   */
  public static function getInfo() {
    return array(
      'name' => "bd_contact AdminController's controller functionality",
      'description' => 'Test Unit for module bd_contact and controller AdminController.',
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
   * Tests bd_contact functionality.
   */
  public function testAdminController() {
    // Check that the basic functions of module bd_contact.
    $this->assertEquals(TRUE, TRUE, 'Test Unit Generated via Drupal Console.');
  }

}
