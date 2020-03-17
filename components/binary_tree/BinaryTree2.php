<?php

namespace app\components\binary_tree;

class BinaryTree2 { 

    public $nodes = []; 

    public function __construct(Array $nodes) { 
      $this->nodes = $nodes; 
    } 
    
     public function traverseLeft(int $num = 0, int $level = 0, int $cntL = 0) { 

         $array = [];
      if (isset($this->nodes[$num])) { 
          echo "<span>";
          //echo str_repeat("-", $level) ; 
          if($level === 0) {
          $array['0'] = "<span>" . $this->nodes[$num] . "</span><br>";
          }
          if($level === 1) {
           $array['1'] = "<span>" . $this->nodes[$num] . "</span>";        
          }
          if($level === 2) {
          $array['2'] =  "<span>" . $this->nodes[$num] . "</span>";
          }
          

          //$cntL++;
         // echo " L:" . $cntL . "<br>";
          // LEFT node
          $this->traverseLeft(2 * $num + 1, $level+1, $cntL+1); 
          
          //$cntR++;
         // echo " R:" . $cntR . "<br>";
          // RIGHT node
          $this->traverseLeft(2 * ($num + 1), $level+1, $cntL); 
          
          echo "</span>";
      }
      
      return $array;
     }

    public function traverseVer(int $num = 0, int $level = 0) { 

      if (isset($this->nodes[$num])) { 
          echo "<ul>";
          //echo str_repeat("-", $level) ; 
          echo "<li>" . $this->nodes[$num] . "</li>"; 

          // LEFT node
          $this->traverseVer(2 * $num + 1, $level+1); 
          // RIGHT node
          $this->traverseVer(2 * ($num + 1), $level+1); 
          
          echo "</ul>";
      } 
      
      
    }
    
    
}
