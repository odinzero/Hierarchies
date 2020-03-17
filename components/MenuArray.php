<?php

namespace app\components;

use app\models\creocoderModel\Menu;

// https://stackoverflow.com/questions/44432459/how-to-recursively-filter-an-array-if-value-exists-on-another-array/44434579#44434579
class MenuArray {

    static function getData() {

        //$collection = Menu::find()->select('name, depth')->orderBy('lft')->asArray()->all();
        $collection = Menu::find()->orderBy('lft')->asArray()->all();
        //  echo "1:: " . var_dump($collection) . "<br>";

        $menu = [];

        if ($collection) {
            $nsTree = new NestedSetsTreeMenu();
            $dataMenu = $nsTree->tree($collection); //создаем дерево в виде массива
            // $menu = $dataMenu[0]['items']; //убираем корневой элемент
//            $display = ['display' => 'inline'];
            $arr2 = ['url' => '#'];
            // this version is OK
            MenuArray::recursive_TreeMenu($dataMenu);
            // this version is OK
            // MenuArray::recursive_addElement1($dataMenu, $arr2); 

            //MenuArray::array_merge_recursive_simple($dataMenu, $arr2); nok
            //MenuArray::recursive_addElement($dataMenu);
            //MenuArray::recursive_unset($dataMenu, "depth");
            // MenuArray::array_merge_recursive_leftsource($dataMenu, $arr2); nok
            // MenuArray::array_merge_recursive_distinct_1($dataMenu, $arr2);
            //MenuArray::MergeArrays($dataMenu, $arr2);

            MenuArray::recursive_unset_ifempty($dataMenu, "items");

            //MenuArray::array_merge_recursive_distinct($dataMenu, ['url' => 'index']);
            //array_merge_recursive($dataMenu, ['url' => 'index']);
//            $dataMenu[0] += ['url' => 'index'];
//            $dataMenu[0]['items'][0] += ['url' => 'index'];
//            $dataMenu[0]['items'][0]['items'][0] += ['url' => 'index'];
//            
            // array_push($dataMenu, ['url' => 'index']);
            //array_push($dataMenu, ['url' => 'index']);
            //$newDataMenu = array_merge_recursive($dataMenu, ['url' => 'index']);

           // print_r($dataMenu);

            // print_r(MenuArray::array_replace_keys(['one'=>'apple', 'two'=>'orange'], ['one'=>'ett', 'bla'=>'tvo'] ));

            $menu = $dataMenu;
        }

        return $menu;
    }
    
     static function defineMenuOptionData($child_lft, $child_rgt,  $click) {  
         
        //$collection = Menu::find()->select('name, depth')->orderBy('lft')->asArray()->all();
        $collection = Menu::find()->orderBy('lft')->asArray()->all();

        $menu = [];

        if ($collection) {
            $nsTree = new NestedSetsTreeMenu();
            $dataMenu = $nsTree->tree($collection); //создаем дерево в виде массива
            // $menu = $dataMenu[0]['items']; //убираем корневой элемент
            $arr2 = ['url' => '#'];
            // this version is OK
            //MenuArray::recursive_TreeMenu($dataMenu, $arr2); 
           
            if($click == "false")
                $click = "true";
            else if($click == "true")
                $click = "false";
            
            MenuArray::recursive_addElement2($dataMenu, $child_lft, $child_rgt, $click);

            MenuArray::recursive_unset_ifempty($dataMenu, "items");

        //    print_r($dataMenu);

            $menu = $dataMenu;
        }

        return $menu;
     }
     
     
     static function check($data) {
         
       $collection = Menu::find()->orderBy('lft')->asArray()->all();

        $menu = [];

        if ($collection) {
            $nsTree = new NestedSetsTreeMenu();
            $dataMenu = $nsTree->tree($collection); //создаем дерево в виде массива
            // $menu = $dataMenu[0]['items']; //убираем корневой элемент
//            $data = [ "9" => "true", "11" => "false", "10" => "false", "16"=> "false", "12" => "false", "13" => "false",
//                 "14" => "false", "15" => "false" ];
            // this version is OK
            MenuArray::recursive_TreeMenu2($dataMenu, $data);
           
//            if($click == "false")
//                $click = "true";
//            else if($click == "true")
//                $click = "false";
//            
//            MenuArray::recursive_addElement2($dataMenu, $child_lft, $child_rgt, $click);

            MenuArray::recursive_unset_ifempty($dataMenu, "items");

           // print_r($dataMenu);

            $menu = $dataMenu;
        }

        return $menu;
     }
    
    

    // ok 
    static function recursive_unset(&$array, $unwanted_key) {
        unset($array[$unwanted_key]);
        foreach ($array as &$value) {
            if (is_array($value)) {
                MenuArray::recursive_unset($value, $unwanted_key);
            }
        }
    }

    // ok
    static function recursive_unset_ifempty(&$array, $unwanted_key) {
        // remove element if it is empty 
        if (empty($array[$unwanted_key])) {
            unset($array[$unwanted_key]);
        }
        foreach ($array as &$value) {
            if (is_array($value)) {
                MenuArray::recursive_unset_ifempty($value, $unwanted_key);
            }
        }
    }
    
    // ok
    static function recursive_addElement1(&$array1, $array2) {
       
        foreach ($array1 as $key => &$value) {
            if (is_array($value)) {
                //print_r($value);
                echo "<ARRAY>\n";
                //array_push($value, ['url' => 'index']);
                // array_merge($value, ['url' => 'index']);
                //MenuArray::array_replace_keys($value, ['tree' => 'index']);
                
                if (array_key_exists('label', $value)) {
                    if (in_array($value['label'], $value)) {
                        
                        $value += $array2;
                        echo "CCC::: " . count($value);
                        print_r($value);
                    }
                }
                MenuArray::recursive_addElement1($value, $array2 );
            } else {
                echo "<NOT ARRAY>\n";
                // print implode('.', array_merge($tree, array($key, $value)));

                echo "count:: " . $key . " " . $value . '<br>';
            }
        }
    }

    /**
     * This function replaces the keys of an associate array by those supplied in the keys array
     *
     * @param $array target associative array in which the keys are intended to be replaced
     * @param $keys associate array where search key => replace by key, for replacing respective keys
     * @return  array with replaced keys
     */
    private static function array_replace_keys($array, $keys) {
        foreach ($keys as $search => $replace) {
            if (isset($array[$search])) {
                $array[$replace] = $array[$search];
                echo " inside: " . $array[$replace] . "  " . $array[$search];
                echo " inside: " . $replace . "  " . $search;
                unset($array[$search]);
            }
        }

        return $array;
    }

    // ok  , $child_lft1, $child_rgt1, $click1
    static function recursive_addElement2(&$array1, $child_lft, $child_rgt, $click) {

        foreach ($array1 as &$value) {
            if (is_array($value)) {
                // array_push($value, ['tree' => 'index']);
                // $value['tree'] = 'index';
                // MenuArray::array_replace_keys($value, ['tree' => 'index']);
                // MenuArray::array_replace_keys2($value, ['tree' => 'index'], false);


                if (array_key_exists('label', $value)) {
                    if (in_array($value['label'], $value)) {
                        
                        $array2 = ['url' => 
                            '/index.php?r=dragdropnested%2Ftreemenunode&id='.$value['id']
                            .'&lft='.$value['lft'].'&rgt='.$value['rgt'].'&click='.$click ];
                        $value += $array2;
                        
                        $display = ['display' => 'inline'];
                        $notdisplay = ['display' => 'none'];
                        
                       // $name = "New Zeeland";
//                        $child_lft = "1";
//                        $child_rgt =  "8";
                        $depth = "1";
//                        $click = "false";
                        
                        if($value['lft'] <= $child_lft) {
//                           if($click == true)
                            $value += $display;
//                            else 
//                            $value += $notdisplay; 
                        }
                        
                        //&& $value["depth"] != $depth
                        if ($value['lft'] > $child_lft && $value['rgt'] <= $child_rgt   ) {
                            if ($click == "true") {
                                $value += $display;
                            } else
                                $value += $notdisplay;
                        } 
//                        else {
//                            $value += $notdisplay;
//                        }

                        if($value['rgt'] > $child_rgt) {
//                           if($click == true)
                            $value += $display;
//                            else 
//                            $value += $notdisplay;
                        }
                        
                        
                        //echo "CCC::: " . count($value) . "    " . print_r($value);
                    }
                } else {
                   // array_push($value, "2222222");
                   // echo "CCC2::: " . count($value) . "    " . print_r($value);
                }
                
                //, $child_lft1, $child_rgt1, $click1
                MenuArray::recursive_addElement2($value, $child_lft, $child_rgt, $click);
            } 
        }
    }
    
    static function recursive_TreeMenu(&$array1) {

        foreach ($array1 as &$value) {
            if (is_array($value)) {
                // array_push($value, ['tree' => 'index']);
                // $value['tree'] = 'index';
                // MenuArray::array_replace_keys($value, ['tree' => 'index']);
                // MenuArray::array_replace_keys2($value, ['tree' => 'index'], false);

                if (array_key_exists('label', $value)) {
                    if (in_array($value['label'], $value)) {
                        
                        
                        $array2 = ['url' => 
                            '/index.php?r=dragdropnested%2Ftreemenunode&id='.$value['id']
                            .'&lft='.$value['lft'].'&rgt='.$value['rgt'].'&click=true' ];
                        $value += $array2;
                        //echo "CCC::: " . count($value) . "    " . print_r($value);
                    }
                } else {
                   // array_push($value, "2222222");
                   // echo "CCC2::: " . count($value) . "    " . print_r($value);
                }
                MenuArray::recursive_TreeMenu($value);
            } 
        }
    }
    
    static function recursive_TreeMenu2(&$array1, &$data) {

        foreach ($array1 as &$value) {
            if (is_array($value)) {
                // array_push($value, ['tree' => 'index']);
                // $value['tree'] = 'index';
                // MenuArray::array_replace_keys($value, ['tree' => 'index']);
                // MenuArray::array_replace_keys2($value, ['tree' => 'index'], false);

                if (array_key_exists('label', $value)) {
                    if (in_array($value['label'], $value)) {
                        
                        $display = ['display' => 'inline'];
                        $notdisplay = ['display' => 'none'];
                        
                        foreach ($data as $key => $val) {
                            if ($value['id'] === "" . $key) {
                                $value += ['click' => $val];
                                
                                 $array2 = ['url' => 
                            '/index.php?r=dragdropnested%2Ftreemenu2&id='.$value['id']
                            .'&lft='.$value['lft'].'&rgt='.$value['rgt'].'&click='. $val ];
                                 $value += $array2;
                            }
                        }
                        
                        if($value['click'] === "true") {
                           $value += $display;
                           
                        } else if($value['click'] === "false") {
                           $value += $notdisplay;
                        }
                       // $value += $data;
                    }
                } else {
                   // array_push($value, "2222222");
                }
                MenuArray::recursive_TreeMenu2($value, $data);
            } 
        }
    }

    /**
     * @param array $array
     * @param array $replacements
     * @param boolean $override
     * @return array
     */
//    static function array_replace_keys2(array $array, array $replacements, $override = false) {
//        foreach ($replacements as $old => $new) {
//            if (is_int($new) || is_string($new)) {
//                if (array_key_exists($old, $array)) {
//                    if (array_key_exists($new, $array) && $override === false) {
//                        continue;
//                    }
//                    $array[$new] = $array[$old];
//                    unset($array[$old]);
//                }
//            }
//        }
//        return $array;
//    }

    static function array_merge_recursive_distinct(array &$array1, array &$array2) {
        $merged = $array1;

        foreach ($array2 as $key => &$value) {
            if (is_array($value) && isset($merged [$key]) && is_array($merged[$key])) {
                $merged [$key] = array_merge_recursive_distinct($merged [$key], $value);
            } else {
                $merged [$key] = $value;
            }
        }

        return $merged;
    }

    static function array_merge_recursive_simple() {

        if (func_num_args() < 2) {
            trigger_error(__FUNCTION__ . ' needs two or more array arguments', E_USER_WARNING);
            return;
        }
        $arrays = func_get_args();
        $merged = array();
        while ($arrays) {
            $array = array_shift($arrays);
            if (!is_array($array)) {
                trigger_error(__FUNCTION__ . ' encountered a non array argument', E_USER_WARNING);
                return;
            }
            if (!$array)
                continue;
            foreach ($array as $key => $value)
                if (is_string($key))
                    if (is_array($value) && array_key_exists($key, $merged) && is_array($merged[$key]))
                        $merged[$key] = call_user_func(__FUNCTION__, $merged[$key], $value);
                    else
                        $merged[$key] = $value;
                else
                    $merged[] = $value;
        }
        return $merged;
    }

    static function array_merge_recursive_leftsource(&$a1, &$a2) {
        $newArray = array();
        foreach ($a1 as $key => $v) {
            if (!isset($a2[$key])) {
                $newArray[$key] = $v;
                continue;
            }

            if (is_array($v)) {
                if (!is_array($a2[$key])) {
                    $newArray[$key] = $a2[$key];
                    continue;
                }
                $newArray[$key] = array_merge_recursive_leftsource($a1[$key], $a2[$key]);
                continue;
            }

            $newArray[$key] = $a2[$key];
        }
        return $newArray;
    }

    static function &array_merge_recursive_distinct_1(array &$array1, &$array2 = null) {
        $merged = $array1;

        if (is_array($array2))
            foreach ($array2 as $key => $val)
                if (is_array($array2[$key]))
                    $merged[$key] = is_array($merged[$key]) ? array_merge_recursive_distinct($merged[$key], $array2[$key]) : $array2[$key];
                else
                    $merged[$key] = $val;

        return $merged;
    }

    static function MergeArrays($Arr1, $Arr2) {
        foreach ($Arr2 as $key => $Value) {
            if (array_key_exists($key, $Arr1) && is_array($Value))
                $Arr1[$key] = MergeArrays($Arr1[$key], $Arr2[$key]);
            else
                $Arr1[$key] = $Value;
        }

        return $Arr1;
    }

}
