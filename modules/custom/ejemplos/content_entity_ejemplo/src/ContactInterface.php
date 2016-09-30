<?php

namespace Drupal\content_entity_ejemplo;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\user\EntityOwnerInterface;
use Drupal\Core\Entity\EntityChangedInterface;

/**
 * Provides an interface defining a Contact entity
 * 
 * we have this interface so we can join the other interface
 * 
 * 
 * 
 */
interface ContactInterface extends ContentEntityInterface, EntityOwnerInterface, EntityChangedInterface {
    
}
