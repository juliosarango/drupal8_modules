<?php

namespace Drupal\loremipsum\Controller;

use Drupal\Component\Utility\SafeMarkup;
use Drupal\Core\Controller\ControllerBase;

/**
 * Controller routines for Lorem ipsum pages
 */

class LoremIpsumController extends ControllerBase {
    
    /**
     * Constructs Lorem ipsum text with arguments.
     * This callback is mapped to the path
     * 'loremipsum/generate/{paragraphs}/{phrases}'
     * 
     * @param string $paragraphs
     *  La cantidad de parrafos que deben ser generados
     * @param string $phrases
     *  La cantidad de frases que se generan dentro de cada parrafo
     */
    
    public function generate($paragraphs, $phrases) {
        
        $config = \Drupal::config("loremipsum.settings");
        
        $page_title = $config->get("loremipsum.page_title");
        $source_text = $config->get("loremipsum.source_text");
        
        $repertory = explode(PHP_EOL, $source_text);
        
        $element["#source_text"] = array();
        
        for ($i = 1; $i <= $paragraphs; $i++){
            $this_paragraph = '';
            $random_phrases = mt_rand(round($phrases/2), $phrases);
            
            $last_number = 0;
            $next_number = 0;
            
            for($j = 1; $j <= $random_phrases; $j++) {
                do {
                    $next_number = floor(mt_rand(0, count($repertory)-1));                    
                } while($next_number === $last_number);
                
                $this_paragraph .= $repertory[$next_number] . ' ';
                $last_number = $next_number;
            }
            $element["source_text"][] = SafeMarkup::checkPlain($this_paragraph);
        }
        
        $element["#title"] = SafeMarkup::checkPlain($page_title);
        $element["#theme"] = 'loremipsum';
        
        return $element;
        
        
    }
}
