<?php

namespace app\components\binary_tree;

class BSTcheck {

    public function testTree() {

        //      8:1
        // 3:2       9:4
        //    5:3       18:5
        //         8:1
        //      3:2      
        //   5:3
        //9:4
        //          8:1 
        //       3:2
        //          5:3
        //       9:4
        //         8:1         1
        //      3:2   5:3      2
        //   9:4   18:5  13:6  3
        // 

        $a = array(
            8 => 1,
            3 => 2,
            5 => 3,
            9 => 4,
            18 => 5,
            13 => 6,
            16 => 7,
            19 => 8,
            1 => 9,
            7 => 10,
            12 => 11,
            4 => 12,
            10 => 13,
            20 => 14,
            11 => 15,
            14 => 16,
            6 => 17,
            2 => 18,
            15 => 19,
            17 => 20
        );

        // $b = new BinarySearchTreeHandler2($a);
        // $array = BSTcheck::object_to_array($b);

        echo "<pre>";
        //  print_r($array);
        echo "</pre>";

        // $array = (array) $b;
        //  BSTcheck::getTreeData($b);

        echo "<pre>";
        //  print_r($b);
        echo "</pre>";

        //=============================================================================

        $nodes = [];
        $nodes[] = "Final";
        $nodes[] = "Semi Final 1";
        $nodes[] = "Semi Final 2";
        $nodes[] = "Quarter Final 1";
        $nodes[] = "Quarter Final 2";
        $nodes[] = "Quarter Final 3";
        $nodes[] = "Quarter Final 4";
        $nodes[] = "Sixteenth Final 5";
        $nodes[] = "Sixteenth Final 6";
        $nodes[] = "Sixteenth Final 7";
        $nodes[] = "Sixteenth Final 8";

        $tree = new BinaryTree2($nodes);
        $a = $tree->traverseLeft(0);
               
        print_r($a);

        //  echo $b->getLog();
        //  echo $s = $b->find(13, "SELF");
        //   echo $b->getLog("search");
//        $b->appendChild("SELF", 34, "straight");
//        $b->appendChild("SELF", 24, "dexterity");
//        $b->appendChild("SELF", 35, "intellegence");
//        $b->appendChild("SELF", 31, "someworlsd");
//
//        echo "<pre>";
//        var_dump($b);
//        echo "</pre>";
        //  echo $b->getLog();
    }

    public static function getTreeData($b) {
        echo "<ul>";
        foreach ($b->_tree as $key => $value) {


            if ($key === "key") {
                // echo "key_0:" . $value . '<br>';
                echo "<li>($key)$value</li>";
            }
            if ($key === "value") {
                // echo "value_0:" . $value . '<br>';
                echo "<li>($key)$value</li>";
            }

            if ($key === "leftChild") {
                if (is_object($value)) {
                    // echo "<ul>";
                    echo "<li>leftChild</li>";
                    BSTcheck::fetchData($value);
                    // echo "</ul>";
                } else {
                    // echo $value;
                }
            }

            if ($key === "rightChild") {
                if (is_object($value)) {
                    // echo "<ul>";
                    echo "<li>rightChild</li>";
                    BSTcheck::fetchData($value);
                    // echo "</ul>";
                } else {
                    // echo $value;
                }
            }
        }
        echo "</ul>";
    }

    public static function fetchData($b) {
        echo "<ul>";
        foreach ($b as $key => $value) {

            // echo "<ul>";
            if ($key === "key") {
                //echo "key_1: " . $value . '<br>';
                echo "<li>($key)$value</li>";
            }
            if ($key === "value") {
                //echo "value_1:" . $value . '<br>';
                echo "<li>($key)$value</li>";
            }

            if ($key === "leftChild") {
                // var_dump($value);
                if (!is_null($value)) {
                    echo "<li>leftChild</li>";
                    foreach ($value as $k => $v) {
                        if (is_object($v)) {
                            echo "<ul>";
                            echo "<li>$k</li>";
                            BSTcheck::fetchData($v);
                            echo "</ul>";
                        } else {
                            //  echo "k_l: " . $k . " " . $v . '<br>';
                            if ($v !== null)
                                echo "<ul><li>($k)$v</li></ul>";
                        }
                    }
                } else {
                    // echo "left is null <br>";
                }
            }

            if ($key === "rightChild") {
                if (!is_null($value)) {
                    echo "<li>rightChild</li>";
                    foreach ($value as $k => $v) {
                        if (is_object($v)) {
                            echo "<ul>";
                            echo "<li>$k</li>";
                            BSTcheck::fetchData($v);
                            echo "</ul>";
                        } else {
                            //echo "k_r: " . $k . " " . $v . '<br>';
                            if ($v !== null)
                                echo "<ul><li>($k)$v</li></ul>";
                        }
                    }
                } else {
                    //echo "right is null <br>";
                }
            }

            //echo "</ul>";
        }
        echo "</ul>";
    }

    public static function object_to_array($obj) {
        //only process if it's an object or array being passed to the function
        if (is_object($obj) || is_array($obj)) {
            $ret = (array) $obj;
            foreach ($ret as &$item) {
                //recursively process EACH element regardless of type
                $item = BSTcheck::object_to_array($item);
            }
            return $ret;
        }
        //otherwise (i.e. for scalar values) return without modification
        else {
            return $obj;
        }
    }

    public static function fetchToArray($b) {

        $tree = [];

        foreach ($b->_tree as $key => $value) {

            if ($key === "leftChild") {
                if (is_object($value))
                    BSTcheck::fetchDataToArray($value);
                else
                // echo $value;
                    $tree[$key] = $value;
            }

            if ($key === "rightChild") {
                if (is_object($value))
                    BSTcheck::fetchDataToArray($value);
                else
                // echo $value;
                    $tree[$key] = $value;
            }

            if ($key === "key") {
                // echo "key_0:" . $value . '<br>';
                $tree[$key] = $value;
            }
            if ($key === "value") {
                // echo "value_0:" . $value . '<br>';
                $tree[$key] = $value;
            }
        }
    }

    public static function fetchDataToArray($b) {
        foreach ($b as $key => $value) {

            if ($key === "leftChild") {
                // var_dump($value);
                if (!is_null($value)) {
                    foreach ($value as $k => $v) {
                        if (is_object($v)) {
                            BSTcheck::fetchData($v);
                        } else {
                            echo "k_l: " . $k . " " . $v . '<br>';
                        }
                    }
                } else {
                    echo "left is null <br>";
                }
            }

            if ($key === "rightChild") {
                if (!is_null($value)) {
                    foreach ($value as $k => $v) {
                        if (is_object($v)) {
                            BSTcheck::fetchData($v);
                        } else {
                            echo "k_r: " . $k . " " . $v . '<br>';
                        }
                    }
                } else {
                    echo "right is null <br>";
                }
            }

            if ($key === "key") {
                echo "key_1: " . $value . '<br>';
            }
            if ($key === "value") {
                echo "value_1:" . $value . '<br>';
            }
        }
    }

}
