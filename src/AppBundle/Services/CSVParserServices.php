<?php
namespace AppBundle\Services;

class CSVParserServices{
    
    /**
     * get csv & return it with first row as array key
     * @param type $csv
     * @return type
     */
    public function parse($csv){
        $data=[];
        $header=null;
        if (($handle = fopen($csv, "r")) !== FALSE) {
            while (($row = fgetcsv($handle, 0, ";")) !== FALSE) {
                if(!$header){
                    $header=$row;
                }else{
                    $data[]=array_combine($header, $row);
                }
            }
            fclose($handle);
        }
        
        return $data;
    }
}