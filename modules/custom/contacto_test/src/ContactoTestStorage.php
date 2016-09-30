<?php

namespace Drupal\contacto_test;

class ContactoTestStorage {
    
    /**
     * 
     * @param array $entry
     *   An array containing asll the fields of the database record
     * @return int
     *    The number of the update rows.
     * @throws \Exception
     *   When the database insert fails.
     * 
     * @see db_insert()
     */
    
    public static function insert($entry) {
        $return_value = NULL;
        
        try {
            $return_value = db_insert('contacto_test')
                    ->fields($entry)
                    ->execute();
        } catch (\Exception $ex) {
            drupal_set_message('db_insert failed. Message= %message, query= %query', array(
                '%message' => $ex->getMessage(),
                '%query' => $ex->query_string,
            ),'error');

        }
        return $return_value;
    }
    
    /**
     * Update an entry in the database
     * @param array $entry
     *    An array containing all the fields of the item to be updated
     *   
     * @return int
     *    The number of updated rows.
     * 
     * @see db_update()
     */
    
    
    public static function update($entry) {
        $count = null;
                
        try {
            $count = db_update('contacto_test')
                    ->fields($entry)
                    ->condition('pid',$entry['pid'])
                    ->execute();
        } catch (\Exception $ex) {
            
            drupal_set_message('db_update failed. Message= %message, query= %query', array(
                '%message' => $ex->getMessage(),
                '%query' => $ex->query_string,
            ),'error');

        }
        
        return $count;
    }
    
    /**
     * Delete an entry from the database
     * 
     * @param array $entry
     * 
     *    An array containing at least the person identidier 'pid' element of the
     *    entry to delete
     * 
     * @see db_delete()
     */
    
    public static function delete($entry) {
        db_delete('contacto_test')
            ->condition('pid', $entry['pid'])
                ->execute();
    }
    
    /**
     * 
     * @param array $entry
     *    An array containing all the fields used to search the entries on the table
     * @return object
     *    An object containing the loaded entries if found
     * 
     * @see db_select()
     * @see db_query()
     */
    
    public static function load($entry = array()) {        
        $select = db_select('contacto_test','contacto');
        $select->fields('contacto');
        
        foreach ($entry as $field => $value) {
            $select->condition($field,$value);
        }
        
        return $select->execute()->fetchAll();
            
    }
    
    /**
     * Load contacto_test records joined with user records
     * 
     * @return object
     */
    
    public static function advancedLoad() {
        $select = db_select('contacto_test', 'contacto');
        
        $select->join('users_field_data','u', 'contacto.uid = u.uid');
        
        $select->addField('contacto', 'pid');
        $select->addField('u', 'name','username');
        $select->addField('contacto', 'name');
        $select->addField('contacto', 'surname');
        $select->addField('contacto', 'age');
        
        $select->condition('contacto.name', 'John');
        $select->condition('contacto.age', 18, '>');
        $select->range(0,50);
        
        $entries = $select->execute()->fetchAll(\PDO::FETCH_ASSOC);
        
        return $entries;
                
    }
    
    
    
}
