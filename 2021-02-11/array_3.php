<?php echo '<pre>';

$table = [

	['category'=>1,'categoryname'=>'c1','attribute'=>1,'attributename'=>'a1','option'=>1,'optionname'=>'o1'],
	['category'=>1,'categoryname'=>'c1','attribute'=>1,'attributename'=>'a1','option'=>2,'optionname'=>'o2'],
	['category'=>1,'categoryname'=>'c1','attribute'=>2,'attributename'=>'a2','option'=>3,'optionname'=>'o3'],
	['category'=>1,'categoryname'=>'c1','attribute'=>2,'attributename'=>'a2','option'=>4,'optionname'=>'o4'],
	['category'=>2,'categoryname'=>'c2','attribute'=>3,'attributename'=>'a3','option'=>5,'optionname'=>'o5'],
	['category'=>2,'categoryname'=>'c2','attribute'=>3,'attributename'=>'a3','option'=>6,'optionname'=>'o6'],
	['category'=>2,'categoryname'=>'c2','attribute'=>4,'attributename'=>'a4','option'=>7,'optionname'=>'o7'],
	['category'=>2,'categoryname'=>'c2','attribute'=>4,'attributename'=>'a4','option'=>8,'optionname'=>'o8']

];

$table2 = [
    ['car'=>1,'carbrand'=>'lambourghini','carorigin'=>'italy','model'=>1,'modelname'=>'Aventador S','modelhorsepower'=>'544kW','modelprice'=>'5cr'],
    ['car'=>1,'carbrand'=>'lambourghini','carorigin'=>'italy','model'=>2,'modelname'=>'Sian Roadster','modelhorsepower'=>'820kW','modelprice'=>'24cr'],
    ['car'=>2,'carbrand'=>'koenigsegg','carorigin'=>'sweden','model'=>1,'modelname'=>'Agera','modelhorsepower'=>'947kW','modelprice'=>'12.5cr'],
    ['car'=>2,'carbrand'=>'koenigsegg','carorigin'=>'sweden','model'=>2,'modelname'=>'Gemera','modelhorsepower'=>'1700kW','modelprice'=>'13.81cr'],
];

function table_to_tree($table) {
    $tree = [];
    foreach ($table as $record) {
        $cur = &$tree;
        $prev_k = null;
        foreach ($record as $key => $value) {
            if (!array_key_exists($key, $cur)) {
                if (strpos($key, $prev_k) === 0) {  //  substr($key, 0, strlen($prev_k)) === $prev_k   // str_starts_with($key, $prev_k)
                    $cur[str_replace($prev_k,'',$key)] = $value;
                } else {
                    $cur[$key] = [];
                    $cur[$key][$value] = [];
                    $prev_k = $key;
                    $cur = &$cur[$key][$value];
                }
            } else {
                if (!array_key_exists($value, $cur[$key])) {
                    $cur[$key][$value] = [];
                }
                $prev_k = $key;
                $cur = &$cur[$key][$value];
            }
        }
    }
    return $tree;
}

// $tree = table_to_tree($table2);
// print_r($tree);
// die();

function table_to_tree2($table) {
    $tree = [];
    foreach ($table as $record) {
        $tree['category'][$record['category']]['name'] = $record['categoryname'];
        $tree['category'][$record['category']]['attribute'][$record['attribute']]['name'] = $record['attributename'];
        $tree['category'][$record['category']]['attribute'][$record['attribute']]['option'][$record['option']]['name'] = $record['optionname'];
    }
    return $tree;
}

$tree = [
	'category'=> [
		'1'=>[
			'name' => 'c1',
			'attribute'=>[
				'1' => [
					'name'=>'a1',
					'option' => [
						'1'=>[
							'name' => 'o1'
						],
						'2'=>[
							'name' => 'o2'
						]
					]
				],
				'2' => [
					'name'=>'a2',
					'option' => [
						'3'=>[
							'name' => 'o3'
						],
						'4'=>[
							'name' => 'o4'
						]
					]
				]
			]
		],
		'2'=>[
			'name' => 'c2',
			'attribute'=>[
				'3' => [
					'name'=>'a3',
					'option' => [
						'5'=>[
							'name' => 'o5'
						],
						'6'=>[
							'name' => 'o6'
						]
					]
				],
				'4' => [
					'name'=>'a4',
					'option' => [
						'7'=>[
							'name' => 'o7'
						],
						'8'=>[
							'name' => 'o8'
						]
					]
				]
			]
		]
	]
];

function tree_to_table($tree) {
    $table = [];
    helper($tree, $table, null, []);
    return $table;
}

function helper(&$root, &$table, $prev_k, $record) {
    foreach ($root as $key => $value) {
        if (is_array($value) && !isset($prev_k)) {
            helper($value, $table, $key, $record);
        } else if (is_array($value)) {
            if (array_key_last($root) === $key) {
                helper($value, $table, $key, $record);
            } else {
                $record[$prev_k] = $key;
                helper($value, $table, $prev_k, $record);
            }
        } else {
            if (array_key_last($root) === $key) {
                $record[$prev_k.$key] = $value;
                $table[] = $record;
            } else {
                $record[$prev_k.$key] = $value;
            }
        }
    }
}

$result = tree_to_table($tree);
print_r($result);