<?php
echo '<pre>';

$data = 
[
    1 => [
        1 => [1,2],
        2 => [3,4]
    ],
    2 => [
        3 => [5,6],
        4 => [7,8]
    ]
];


function tree_to_table(&$root) {
    $table = [];
    helper($root, $table, []);
    return $table;
}

function helper(&$root, &$table, $record) {
    foreach ($root as $val => $child) {
        if (!is_array($child)) {
            $record[] = $child;
            $table[] = $record;
        } else {        
            array_push($record, $val);
            helper($child, $table, $record);
        }
        array_pop($record);
    }
}

$table = tree_to_table($data);
// print_r($table);
$var1 = $var2 = $var3 = 0;
include '../db.php';
$stmt = $con->prepare("INSERT INTO `tree_to_table`(`category`, `attribute`, `option`) VALUES (?,?,?)");
$stmt->bind_param("iii", $var1, $var2, $var3);

foreach ($table as $record) {
    $var1 = $record[0];
    $var2 = $record[1];
    $var3 = $record[2];
    // $stmt->execute();
    // echo "Record Inserted at id : {$con->insert_id}\n";
}
$con->close();





$data2 = 
[
    'label' => 'category',
    1 => [
        'label' => 'attribute',
        1 => ['label' => 'option', 1, 2],
        2 => ['label' => 'option', 3, 4]
    ],
    2 => [
        'label' => 'attribute',
        3 => ['label' => 'option', 5, 6],
        4 => ['label' => 'option', 7, 8]
    ]
];

function tree_to_table2(&$root) {
    $table = [];
    helper2($root, $table, []);
    return $table;
}

function helper2(&$root, &$table, $record) {
    echo "\n";
    foreach ($root as $val => $child) {
        if ($val !== 'label') {    
            if (!is_array($child)) {
                $record[$root['label']] = $child;
                array_push($table, $record);
            } else {
                $record[$root['label']] = $val;
                helper2($child, $table, $record);
            }
        }
    }
}

$table2 = tree_to_table2($data2);
// print_r($data2);
print_r($table2);

$category = $attribute = $option = 0;
include '../db.php';
$stmt = $con->prepare("INSERT INTO `tree_to_table`(`category`, `attribute`, `option`) VALUES (?,?,?)");
$stmt->bind_param("iii", $category, $attribute, $option);

foreach ($table2 as $record) {
    $category = $record['category'];
    $attribute = $record['attribute'];
    $option = $record['option'];
    $stmt->execute();
    echo "Record Inserted at id : {$con->insert_id}\n";
}
$con->close();
