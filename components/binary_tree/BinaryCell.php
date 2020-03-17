<?php

namespace app\components\binary_tree;

class BinaryCell {

    /**
     * @var int
     */
    public $parent_id = 'lft';

    /**
     * @var int
     */
    public $user_id = 'user_id';

    /**
     * @var int
     */
    public $level = 'level';

    /**
     * @var string
     */
    public $path = 'path';

    /**
     * @var string
     */
    public $position = 'position';

    // $parent_id, $position
    public function generateCell() {
        $id = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15];
        $parent_id = [0, 1, 1, 2, 2, 13, 13, 3, 3, 22, 22, 23, 23, 61, 61];
        $user_id = [1,2,13,3,61,23,22,4,156,1568,26,1476,690716,1051,62];
        $arr = array();
        $i = -1;
        foreach ($id as $v) {
            $i++;
          //  foreach ($arr as $row) {
                $arr["".$v] = array('id' => $v,
                                    'parent_id' => $parent_id[$i],
                                    'user_id'   => $user_id[$i]
//                                     'level'   => $row['level'], 
//                                     'path'   => $row['path'],
//                                     'position'   => $row['position']
                );
          //  }
        }

        print_r($arr);
    }

//                          (1,        0,           1,        1,           '0',         0),
//                          (2,        1,           2,        2,           '1',         1),
//                          (3,        1,           13,       2,           '1',         2),
//                          (4,	       2,	    3,	      3            '1.2',       1),
//                          (5,	       2,	    61,	      3,           '1.2',       2),
//                          (6,	       13,	    23,	      3,	   '1.13',      1),
//                          (7,	       13,	    22,	      3,	   '1.13',      2),
//                          (8,	       3,	    4,	      4,	   '1.2.3',     1),
//                          (9,	       3,	    156,      4,	   '1.2.3',     2),
//                          (10,       22,	    1568,     4,	   '1.13.22',   1),
//                          (11,       22,	    26,	      4,	   '1.13.22',   2),
//                          (12,       23,	    1476,     4,	   '1.13.23',   1),
//                          (13,       23,	    690716,   4,	   '1.13.23',   2),
//                          (14,       61,	    1051,     4,	   '1.2.61',    1),
//                          (15,       61,	    62,       4,	   '1.2.61',    2)
}
