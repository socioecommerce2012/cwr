<?php

/**
 * Description of FBInterests_Class
 *
 * @author kodakand
 */
class FBGeneral {

    private $dataArray;
    private $nextUrl;
    private $previousUrl;

    public function __construct($dataArray) {
        $this->setDataArray($dataArray);
    }

    public function getDataArray() {
        return $this->dataArray;
    }

    public function setDataArray($dataArray) {
        $this->dataArray = $dataArray;
    }

    public function getNextUrl() {
        return $this->dataArray["paging"]["next"];
    }

    public function setNextUrl($nextUrl) {
        $this->nextUrl = $nextUrl;
    }

    public function getPreviousUrl() {
        return $this->dataArray["paging"]["prev"];
    }

    public function setPreviousUrl($previousUrl) {
        $this->previousUrl = $previousUrl;
    }

    function getAllInterests($toBeAppendedString) {

        $array = array_values($this->dataArray["data"]);
        $nextUrl = $this->dataArray["paging"]["next"];

        for ($i = 0; $i < count($array); $i++) {
            $toBeAppendedString = $toBeAppendedString . $array[$i]["name"] . "::" . $array[$i]["category"] . "::" . $array[$i]["id"] . "::" . $array[$i]["created_time"] . "$$";
        }
        return $toBeAppendedString;
    }

    /**
     * @param type $categories
     * @return type interests array
     */
    function interestBasedOnCategory($categories) {
        $keys = array_key_exists($categories, $search);
    }

}

?>
