<?php

namespace app\components\binary_tree;
 
function shuffle_assoc(&$array) {
        $keys = array_keys($array);
 
        shuffle($keys);
 
        foreach($keys as $key) {
            $new[$key] = $array[$key];
        }
 
        $array = $new;
 
        return true;
    }
 
/**
 * A tree-node class, contains all attributes for creating nodes
 */
class TreeNode
{
    public $leftChild = null;
    public $rightChild = null;
    public $key = null;
    public $value = null;  
}
 
/**
 * A binary search tree handler class, contains methods to manipulate with trees
 */
class BinarySearchTreeHandler
{
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
    protected $_buildLog = array ();
   
    /**
     * The raw variable to store lines of tree-searching log
     *
     * @access  protected
     * @var     array
     */
    protected $_searchLog = array ();
   
    /**
     * Class constructor, builds a binary search tree if array is given
     *
     * @access  public
     * @param   array   given array, indexes must be integers
     */
    public function __construct ($array = null)
    {
        if ($array !== null)
        {
            $this->buildTree ($array);
        }
    }
   
    /**
     * Method which build new binary search tree from given array
     *
     * @access  public
     * @param   array   given array, indexes must be integers
     * @return  obj     binary search tree
     */
    public function buildTree ($array)
    {
        $this->_tree = new TreeNode;
       
      //  shuffle_assoc($array);
       
        foreach ($array as $key => $value)
        {
            echo "out : " . $key . '<br>';
            $this->appendChild($this->_tree, $key, $value);
        }
        return $this->_tree;
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
    public function appendChild ($tree, $key, $value)
    {
        if (is_string($tree))
        {
            if (strtoupper($tree) === "SELF")
            {
                $tree = $this->_tree;
            }
        }
        
        echo  "in tree : " . $tree->key . "<br>";
       
        if($tree->key === null)
        {
            $tree->key = $key;
            $tree->value = $value;
            echo  "tree: " . $tree->key . "<br>";
            return $tree;
        }
        
        echo "key: " . $tree->key  . "  " . $key . "<br>";
        
        if($tree->key > $key)
        {
            if($tree->leftChild !== null)
            {
                $this->_buildLog[] = "key given (<strong>key</strong> = <u>" . $key . "</u>,"
                        . " <strong>value</strong> = <u>" . $value . "</u>) is smaller than key of current node"
                        . " (<em><strong>key</strong>: <u>" . $tree->key . "</u>, <strong>value</strong>: <u>" .
                        $tree->value . "</u></em>), but this node already has LEFT CHILD."
                        . " So <strong>passing</strong> key-value pair to the LEFT CHILD (<em><strong>key</strong>: <u>" 
                        . $tree->leftChild->key . "</u>, <strong>value</strong>: <u>"
                        . $tree->leftChild->value . "</u></em>).";
                return $this->appendChild($tree->leftChild, $key, $value);
            }
            else
            {
                $this->_buildLog[] = "<strong>appending</strong> LEFT CHILD to node (<em><strong>key</strong>: <u>" 
                        . $tree->key . "</u>, <strong>value</strong>: <u>" . $tree->value . 
                        "</u></em>): <strong>key</strong> = <u>" . $key . "</u>, <strong>value</strong> = <u>"
                        . $value . "</u>";
                return $tree->leftChild = $this->appendChild(new TreeNode, $key, $value);
            }
        }
        if ($tree->key <= $key)
        {
            if ($tree->rightChild !== null)
            {
                $this->_buildLog[] = "key given (<strong>key</strong> = <u>" . $key . 
                        "</u>, <strong>value</strong> = <u>" . $value . 
                        "</u>) is bigger than key of current node (<em><strong>key</strong>: <u>" 
                        . $tree->key . "</u>, <strong>value</strong>: <u>" . $tree->value .
                        "</u></em>), but this node already has RIGHT CHILD. "
                        . "So <strong>passing</strong> key-value pair to the RIGHT CHILD (<em><strong>key</strong>: <u>" 
                        . $tree->rightChild->key . "</u>, <strong>value</strong>: <u>"
                        . $tree->rightChild->value . "</u></em>).";
                return $this->appendChild($tree->rightChild, $key, $value);
            } else
            {
                $this->_buildLog[] = "<strong>appending</strong> RIGHT CHILD to node (<em><strong>key</strong>: <u>" 
                        . $tree->key . "</u>, <strong>value</strong>: <u>" . $tree->value 
                        . "</u></em>): <strong>key</strong> = <u>" . $key . "</u>, <strong>value</strong> = <u>"
                        . $value . "</u>";
                return $tree->rightChild = $this->appendChild (new TreeNode, $key, $value);
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
    public function find($key, $tree)
    {
        if (is_string($tree))
        {
            if (strtoupper($tree) === "SELF") {
                $tree = $this->_tree;
            }
        }
       
        if (!is_object($tree) AND $tree !== null)
        {
            $this->_searchLog[] = "given tree isn't a tree at all";
            return false;
        }
       
        if ($tree === null) {
            $this->_searchLog[] = "requested key <strong>wasn't found</strong>";
            return false;
        }
       
        if ($tree->key === $key)
        {
            $this->_searchLog[] = "given key <strong>found</strong>, returned value is " . $tree->value;
            return $tree->value;
        }
        if ($tree->key > $key)
        {
            $this->_searchLog[] = "given key (" . $key . ") is <strong>smaller</strong> than the key in the node (" 
                    . $tree->key . "), trying to find in LEFT child...";
            return $this->find ($key, $tree->leftChild);
        }
        if ($tree->key < $key)
        {
            $this->_searchLog[] = "given key (" . $key . ") is <strong>bigger</strong> than the key in the node (" 
                    . $tree->key . "), trying to find in RIGHT child...";
            return $this->find ($key, $tree->rightChild);
        }
    }
   
    /**
     * Returns requested log, buildLog by default
     *
     * @access  public
     * @param   string  keyword for log, can be either "build" or "search"
     * @return  string  html log of operations
     */
    public function getLog ($type = "build")
    {
        $type = strtolower ($type);
       
        if (!in_array ($type, array ("build", "search"))) {
            $type = "build";
        }
       
        $name = "_" . $type . "Log";
       
        return implode ("<br />", $this->$name);
    }
}

