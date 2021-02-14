<?php
echo '<pre>';
$data = [
	['category'=>1,'attribute'=>1,'option'=>1],
	['category'=>1,'attribute'=>1,'option'=>2],
	['category'=>1,'attribute'=>2,'option'=>3],
	['category'=>1,'attribute'=>2,'option'=>4],
	['category'=>2,'attribute'=>3,'option'=>5],
	['category'=>2,'attribute'=>3,'option'=>6],
	['category'=>2,'attribute'=>4,'option'=>7],
	['category'=>2,'attribute'=>4,'option'=>8]
];

$data2 = [
    ['category'=>1,'attribute'=>1,'option'=>1,'suboption'=>1],
	['category'=>1,'attribute'=>1,'option'=>2,'suboption'=>2],
	['category'=>1,'attribute'=>2,'option'=>3,'suboption'=>3],
	['category'=>1,'attribute'=>2,'option'=>4,'suboption'=>4],
	['category'=>2,'attribute'=>3,'option'=>5,'suboption'=>5],
	['category'=>2,'attribute'=>3,'option'=>6,'suboption'=>6],
	['category'=>2,'attribute'=>4,'option'=>7,'suboption'=>7],
	['category'=>2,'attribute'=>4,'option'=>8,'suboption'=>8],

	['category'=>1,'attribute'=>1,'option'=>1,'suboption'=>9],
	['category'=>1,'attribute'=>1,'option'=>2,'suboption'=>10],
	['category'=>1,'attribute'=>2,'option'=>3,'suboption'=>11],
	['category'=>1,'attribute'=>2,'option'=>4,'suboption'=>12],
	['category'=>2,'attribute'=>3,'option'=>5,'suboption'=>13],
	['category'=>2,'attribute'=>3,'option'=>6,'suboption'=>14],
	['category'=>2,'attribute'=>4,'option'=>7,'suboption'=>15],
	['category'=>2,'attribute'=>4,'option'=>8,'suboption'=>16]
];

// Output must be
//             --------*--------
//         ----1----       ----2----
//       --1--   --2--   --3--   --4--
//       1   2   3   4   5   6   7   8
// 

// convert a table of records to tree view
// param $table : 2-D array
function table_to_tree(&$table) {
    $root = [];


    foreach ($table as $record) {
        $cur = &$root;
        // echo 'recored #'. $i;
        foreach ($record as $k => $v) {
            if (empty($cur)) $cur['label'] = $k;
            // if on last cell ie leaf node then simply insert
            if ($k == array_key_last($record)) {
                $cur[] = $v;
            } 
            // if on internal node then check if node already exists
            // if it doesn't then insert the node
            else if (!array_key_exists($v, $cur)) {
                $cur[$v] = [];
                $cur = &$cur[$v];
            } 
            // if already exists then move to it
            else {
                $cur = &$cur[$v];
            }
        }
    }

    return $root;
}

// print_r($data);
$tree = table_to_tree($data);
print_r($tree);

