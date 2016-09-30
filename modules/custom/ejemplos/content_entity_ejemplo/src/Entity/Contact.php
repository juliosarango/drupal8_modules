<?php

namespace Drupal\content_entity_ejemplo\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\content_entity_ejemplo\ContactInterface;
use Drupal\user\UserInterface;
use Drupal\Core\Entity\EntityChangedTrait;

class Contact extends ContentEntityBase implements ContactInterface {
    
    use EntityChangedTrait;
    
    
    /**
     * {@inheritdoc}
     * 
     * 
     * when a new entity instance is added, set the user_id entity reference to
     * the current user as the creator of the instance      
     */
    
    public static function preCreate(EntityStorageInterface $storage, array &$values) {
        parent::preCreate($storage, $values);
        $values += array(
            'user_id' => \Drupal::currentUser()->id(),
        );
    }
    
    /**
     * 
     * {@inheritdoc}
     */
    
    public function getCreatedTime() {
        return $this->get('created')->value;
    }

    public function getChangedTime() {
        return $this->get('changed')->value;
    }

    public function getChangedTimeAcrossTranslations() {
        
    }

    public function getOwner() {
        return $this->get('user_id')->entity;
    }

    public function getOwnerId() {
        return $this->get('user_id')->target_id;
        
    }

    public function setChangedTime($timestamp) {
        $this->set('changed',$timestamp);
        return $this;
        
    }

    public function setOwner(UserInterface $account) {
        $this->set('user_id',$account->id());
        return $this;
    }

    public function setOwnerId($uid) {
        $this->set('user_id',$uid);
        return $this;
    }
    
    public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
        $fields['id'] = BaseFieldDefinition::create('integer')
                ->setLabel(t('ID'))
                ->setDescription(t('The Id of the contct entity'))
                ->setReadOnly(TRUE);
        
        $fields['uuid'] = BaseFieldDefinition::create('uuid')
                ->setLabel(t('UUID'))
                ->setDescription(t('The UUID of the Contact entity.'))
                ->setReadOnly(TRUE);
        
        $fields['name'] = BaseFieldDefinition::create('string')
                ->setLabel(t('Name'))
                ->setDescription(t('The name of the contact entity'))
                ->setSettings(array(
                    'default_value' => '',
                    'max_length' => 255,
                    'text_processing' => 0,
                ))
                ->setDisplayOptions('form', array(
                    'type' => 'string_textfield',
                    'weight' => 6,
                ))
                ->setDisplayConfigurable('form', TRUE)
                ->setDisplayConfigurable('view', TRUE);
        
        $fields['first_name'] = BaseFieldDefinition::create('string')
                ->setLabel(t('First Name'))
                ->setDescription(t('The first name of contact'))
                ->setSettings(array(
                    'default_value' => '',
                    'max_length' => 255,
                    'text_processing' => 0,
                ))
                ->setDisplayOptions('view', array(
                    'label' => 'above',
                    'type' => 'string',
                    'weight' => -5
                ))
                ->setDisplayOptions('form', array(
                    'type' => 'string_textfield',
                    'weight' => -5
                ))
                ->setDisplayConfigurable('form', TRUE)
                ->setDisplayConfigurable('view', TRUE);
    }

}
