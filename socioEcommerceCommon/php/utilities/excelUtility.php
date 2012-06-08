<?php

include 'reader.php';

function parseExcel($excel_file_name_with_path,$baseUrl) {

    $data = new Spreadsheet_Excel_Reader();
    $data->setUTFEncoder('iconv');
    $data->setOutputEncoding('UTF-8');
    $data->read($excel_file_name_with_path);

    $colname = array('title', 'description', 'category', 'url', 'options', 'provider', 'price', 'discount', 'itemId', 'width', 'height', 'display');

    $startloging = false;

    $k = 0;

    for ($i = 1; $i <= $data->sheets[0]['numRows']; $i++) {

        for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {

            if ($data->sheets[0]['cells'][$i][$j] == 'title') {
                $startloging = true;
                break;
            }
            if ($startloging) {

                // $product[$k - 1][$j - 1] = $data->sheets[0]['cells'][$i][$j];

                if ($j == 4) {
                    $product[$k - 1][$colname[$j - 1]] = is_null($data->sheets[0]['cells'][$i][$j]) ? "NA" : $baseUrl . $data->sheets[0]['cells'][$i][$j];
                } else {

                    $product[$k - 1][$colname[$j - 1]] = is_null($data->sheets[0]['cells'][$i][$j]) ? "NA" : $data->sheets[0]['cells'][$i][$j];
                }
            }
        }

        if ($startloging) {

            $k = $k + 1;
        }
    }

    return $product;
}

?>
