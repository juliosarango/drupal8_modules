<?php

namespace Drupal\loremipsum\Tests;

use Drupal\simpletest\WebTestBase;

/**
 * Test for the Lorem Ipsum module.
 * @group loremipsum
 */

class LoremIpsumTests extends WebTestBase {
    /**
     * Modules to install
     * 
     * @var array
     */
    public static $modules = array('loremipsum');
    
    private $user;
    
    public function setUp() {
        parent::setUp();
        $this->user = $this->createUser(array(
            'administer site configuration',
            'generate lorem ipsum',
        ));
                
    }
    
    public function testLoremIpsumPageExists() {
        $this->drupalLogin($this->user);
        
        $this->drupalGet('loremipsum/generate/4/20');
        $this->assertResponse(200);
    }
    
    public function testConfigForm() {
        $this->drupalLogin($this->user);
        
        $this->drupalGet('admin/config/development/loremipsum');
        $this->assertResponse(200);
        
        $config = $this->config('loremipsum.settings');
        $this->assertFieldByName(
                'page_title',
                $config->get('loremipsum.settings.page_title'),
                'Page title field has the default value'                    
                );
        $this->assertFieldByName(
                'source_text',
                $config->get('loremipsum.settings.source_text'),
                'Source text field has the default value'
                );
        
                $this->drupalPostForm(NULL, array(
                    'page_title' => 'Test lorem ipsum',
                    'source_text' => 'Test phrase 1 \nTest phrase 2\nTest phrase 3\n',
                ), t('Save configuration'));
                
        $this->assertText(
                'The configuration options have been saved.',
                'The form was saved correctly.'
                );
        
        $this->drupalGet('admin/config/development/loremipsum');
        $this->assertResponse(200);
        $this->assertFieldByName(
                'page_title',
                'Test lorem ipsum',
                'Page title is OK'
                );
        $this->assertFieldByName(
                'source_text',
                'Test phrase 1 \nTest phrase 2 \nTest phrase 3 \n',
                'Soruce text is OK.'
                );
    }
}
