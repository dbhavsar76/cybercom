<?php
namespace Model\Core;

class Collection extends \ArrayObject {
    protected $dataType = null;

    public function __construct(array $array = [], string $type = '\\Model\\Core\\Table') {
        parent::__construct([]);
        $this->setDataType($type);

        if (!empty($array)) {
            foreach ($array as $key => $rowData) {
                $this[$key] = (new $this->dataType)->setData($rowData);
            }
        }
    }

    public function setDataType(string $type) {
        $this->dataType = $type;
        return $this;
    }

    public function getDataType() {
        return $this->dataType;
    }
}