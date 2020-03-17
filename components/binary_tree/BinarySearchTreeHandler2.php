<?php

namespace app\components\binary_tree;

function shuffle_assoc(&$array) {
    $keys = array_keys($array);

    shuffle($keys);

    foreach ($keys as $key) {
        $new[$key] = $array[$key];
    }

    $array = $new;

    return true;
}

/**
 * A tree-node class, contains all attributes for creating nodes
 */
class TreeNode {

    public $leftChild = null;
    public $rightChild = null;
    public $key = null;
    public $value = null;

}

/**
 * A binary search tree handler class, contains methods to manipulate with trees
 */
class BinarySearchTreeHandler2 {

    /**
     * The raw binary search tree variable
     *
     * @access  protected
     * @var     object
     */
    public $_tree = null;

    /**
     * The raw variable to store lines of tree-building log
     *
     * @access  protected
     * @var     array
     */
    protected $_buildLog = array();

    /**
     * The raw variable to store lines of tree-searching log
     *
     * @access  protected
     * @var     array
     */
    protected $_searchLog = array();

    /**
     * Class constructor, builds a binary search tree if array is given
     *
     * @access  public
     * @param   array   given array, indexes must be integers
     */
    public function __construct($array = null) {
        if ($array !== null) {
            $this->buildTree($array);
        }
    }

    /**
     * Method which build new binary search tree from given array
     *
     * @access  public
     * @param   array   given array, indexes must be integers
     * @return  obj     binary search tree
     */
    public function buildTree2($array) {
        $this->_tree = new TreeNode;

        //  shuffle_assoc($array);

        $i = 0;
        foreach ($array as $key => $value) {
            $i++;
            if ($i === 1) {
                $switch = "1";
            } else if ($i === 2) {
                $switch = "2";
                $i = 0;
            }

            $this->appendChild2($this->_tree, $key, $value, $switch);
        }
        return $this->_tree;
    }

    public function buildTree($array) {
        $this->_tree = new TreeNode;

        //  shuffle_assoc($array);
        $position = 0;
        // 1 
        $level = 0;
        //         0(1)     1(2)          2(4)    
        $values = [10, 20, 30, 40, 50, 60, 70]; // 1 2 4 8 16
        $tree = [];
        $len = 0;

        for ($level = 0; $level < 3; $level++) {

            $cntLevel = pow(2, $level); // 2 
            if ($level === 0)
                $offset = 0;
            $len = $cntLevel + $level;
            if ($level === 1)
                $offset = 1;
            $len = $cntLevel + $level;
            if ($level === 2) {
                $offset = 3;
                $len = $cntLevel + $level + 1;
            }

            // L0 offset: 0; L1 offset: 1; L2 offset: 3; L3 offset: 7; L4 offset: 7;
            for ($i = $offset; $i < $len; $i++) { // L0: 0 ; L1: 1,2; L2:3,4,5,6
                // $tree["$level"] = $values[$i];
                echo "cntLevel:" . $cntLevel . '<br>';

                //  echo  $values[$i] . "  " . (int)$level .  '<br>';

                if ($level === 0)
                    $tree[$i] = ['left' => $values[$i], 'right' => $values[$i]];
                if ($level === 1)
                    $tree[$i][] = ['left' => $values[$i], 'right' => $values[$i]];

//                if($level === 2)
//               $tree[$i][][] = ['left' => $values[$i], 'right' => $values[$i]];
//               
//               
//                switch ($level) {
//                    case 1:
//                        $tree[$level] = $values[$i];
//                        $tree[$level]['left'] = break;
//                    default: break;
//                }
            }
        }

      //  print_r($tree);
        
        $a = array(
            '8' => '1',
            '3' => '2'
//            5 => 3,
//            9 => 4, 
        );
        
        $bbb =  $this->array_tree($a);
        
        print_r($bbb);

//        $i = 0;
//        foreach ($array as $key => $value)
//        {
//            $i++;
//            if($i === 1) {
//               $switch = "1";
//            }
//            else if($i === 2) {
//               $switch = "2";
//               $i = 0;
//            }
//            
//            $this->appendChild($this->_tree, $key, $value, $switch);
//        }
        return $this->_tree;
    }

     function array_tree($array, $id = 'id', $parent_id = 'parent_id', $children = 'children') {
        $tree = [[$children => []]];
        $references = [&$tree[0]];

        foreach ($array as $item) {
            if (isset($references[$item[$id]])) {
                $item[$children] = $references[$item[$id]][$children];
            }

            $references[$item[$parent_id]][$children][] = $item;
            $references[$item[$id]] =
             &$references[$item[$parent_id]][$children][count($references[$item[$parent_id]][$children]) - 1];
        }

        return $tree[0][$children];
    }

    /**
     * Method to append new node to the tree
     *
     * @access  public
     * @param   viod    object - binary search tree to append to
     *               OR string - keyword SELF to append to already formed tree
     *               OR boolean (null) - if we have ran into the bottom of the
     *                                   tree and have to create a leaf
     * @param   int     key of new node
     * @param   void    value of new node
     */
    public function appendChild2($tree, $key, $value, $switch) {
        if (is_string($tree)) {
            if (strtoupper($tree) === "SELF") {
                $tree = $this->_tree;
            }
        }

        if ($tree->key === null) {
            $tree->key = $key;
            $tree->value = $value;
            return $tree;
        }

        echo "key: " . $tree->key . "  " . $key . "<br>";

        if ($switch === "1") {
            if ($tree->leftChild !== null) {
                $this->_buildLog[] = "key given (<strong>key</strong> = <u>" . $key . "</u>,"
                        . " <strong>value</strong> = <u>" . $value . "</u>) is smaller than key of current node"
                        . " (<em><strong>key</strong>: <u>" . $tree->key . "</u>, <strong>value</strong>: <u>" .
                        $tree->value . "</u></em>), but this node already has LEFT CHILD."
                        . " So <strong>passing</strong> key-value pair to the LEFT CHILD (<em><strong>key</strong>: <u>"
                        . $tree->leftChild->key . "</u>, <strong>value</strong>: <u>"
                        . $tree->leftChild->value . "</u></em>).";
                //return $this->appendChild($tree->leftChild, $key, $value, "2");
                return $tree->rightChild = $this->appendChild2(new TreeNode, $key, $value, "2");
            } else {
                $this->_buildLog[] = "<strong>appending</strong> LEFT CHILD to node (<em><strong>key</strong>: <u>"
                        . $tree->key . "</u>, <strong>value</strong>: <u>" . $tree->value .
                        "</u></em>): <strong>key</strong> = <u>" . $key . "</u>, <strong>value</strong> = <u>"
                        . $value . "</u>";
                return $tree->leftChild = $this->appendChild2(new TreeNode, $key, $value, "2");
            }
        }
        if ($switch === "2") {
            if ($tree->rightChild !== null) {
                $this->_buildLog[] = "key given (<strong>key</strong> = <u>" . $key .
                        "</u>, <strong>value</strong> = <u>" . $value .
                        "</u>) is bigger than key of current node (<em><strong>key</strong>: <u>"
                        . $tree->key . "</u>, <strong>value</strong>: <u>" . $tree->value .
                        "</u></em>), but this node already has RIGHT CHILD. "
                        . "So <strong>passing</strong> key-value pair to the RIGHT CHILD (<em><strong>key</strong>: <u>"
                        . $tree->rightChild->key . "</u>, <strong>value</strong>: <u>"
                        . $tree->rightChild->value . "</u></em>).";
                // return $this->appendChild($tree->rightChild, $key, $value, "1");
                return $tree->leftChild = $this->appendChild2(new TreeNode, $key, $value, "1");
            } else {
                $this->_buildLog[] = "<strong>appending</strong> RIGHT CHILD to node (<em><strong>key</strong>: <u>"
                        . $tree->key . "</u>, <strong>value</strong>: <u>" . $tree->value
                        . "</u></em>): <strong>key</strong> = <u>" . $key . "</u>, <strong>value</strong> = <u>"
                        . $value . "</u>";
                return $tree->rightChild = $this->appendChild2(new TreeNode, $key, $value, "1");
            }
        }
    }

    /**
     * Method to search a node in binary search tree
     *
     * Tries to find a node in a binary search tree with given key
     * If finds - returns it's value
     * If fails - returns false
     *
     * @access  public
     * @param   int     key of node to find
     * @param   viod    object - binary search tree to search in
     *               OR string - keyword SELF to search in already formed tree
     *               OR boolean (null) - if we fail to find what we look for
     * @return  void    false on failure, node value on success
     */
    public function find($key, $tree) {
        if (is_string($tree)) {
            if (strtoupper($tree) === "SELF") {
                $tree = $this->_tree;
            }
        }

        if (!is_object($tree) AND $tree !== null) {
            $this->_searchLog[] = "given tree isn't a tree at all";
            return false;
        }

        if ($tree === null) {
            $this->_searchLog[] = "requested key <strong>wasn't found</strong>";
            return false;
        }

        if ($tree->key === $key) {
            $this->_searchLog[] = "given key <strong>found</strong>, returned value is " . $tree->value;
            return $tree->value;
        }
        if ($tree->key > $key) {
            $this->_searchLog[] = "given key (" . $key . ") is <strong>smaller</strong> than the key in the node ("
                    . $tree->key . "), trying to find in LEFT child...";
            return $this->find($key, $tree->leftChild);
        }
        if ($tree->key < $key) {
            $this->_searchLog[] = "given key (" . $key . ") is <strong>bigger</strong> than the key in the node ("
                    . $tree->key . "), trying to find in RIGHT child...";
            return $this->find($key, $tree->rightChild);
        }
    }

    /**
     * Returns requested log, buildLog by default
     *
     * @access  public
     * @param   string  keyword for log, can be either "build" or "search"
     * @return  string  html log of operations
     */
    public function getLog($type = "build") {
        $type = strtolower($type);

        if (!in_array($type, array("build", "search"))) {
            $type = "build";
        }

        $name = "_" . $type . "Log";

        return implode("<br />", $this->$name);
    }

}
