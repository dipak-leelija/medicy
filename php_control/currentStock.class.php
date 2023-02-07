<?php

require_once 'dbconnect.php';




class CurrentStock extends DatabaseConnection{



    function addCurrentStock($productId, $batchNo, $expDate, $distributorId, $looselyCount, $looselyPrice, $weightage, $unit, $qty, $mrp, $ptr, $gst, $addedBy){

        $insert = "INSERT INTO `current_stock` (`product_id`, `batch_no`, `exp_date`, `distributor_id`, `loosely_count`, `loosely_price`, `weightage`, `unit`, `qty`, `mrp`, `ptr`, `gst`, `added_by`) VALUES ('$productId', '$batchNo', '$expDate', '$distributorId', '$looselyCount', '$looselyPrice', '$weightage', '$unit', '$qty', '$mrp', '$ptr', '$gst', '$addedBy')";

        $res = $this->conn->query($insert);

        return $res;
    }//eof addProduct function 




    function incrCurrentStock($productId, $quantity){

        $incrCurrentStock = " UPDATE `current_stock` SET `qty` = '$quantity' WHERE `current_stock`.`product_id` = '$productId'";

        $incrCurrentStockQuery = $this->conn->query($incrCurrentStock);

        return $incrCurrentStockQuery;
    }//eof incrementCurrentStock function 



    function updateStock($productId, $batchNo, $newQuantity, $newLCount){
        $sale = " UPDATE `current_stock` SET qty = '$newQuantity', loosely_count = '$newLCount' WHERE product_id = '$productId' AND batch_no = '$batchNo'";
        $res = $this->conn->query($sale);
        return $res;
    }//eof updateStock

    // function updateStockByReturn($productId, $batchNo, $newQuantity){
    //     $sale = " UPDATE `current_stock` SET qty = '$newQuantity' WHERE product_id = '$productId' AND batch_no = '$batchNo'";
    //     $res = $this->conn->query($sale);
    //     return $res;
    // }//eof updateStock


    function checkStock($productId, $batchNo){
        $data = array();
        $check = " SELECT * FROM `current_stock` WHERE product_id = '$productId' AND batch_no = '$batchNo'";
        $res = $this->conn->query($check);
        while ($result = $res->fetch_array()) {
            $data[] = $result;
        }
        return $data;
    }





    function showCurrentStock(){
        $data = array();
        $select = "SELECT * FROM current_stock WHERE qty > 0 OR loosely_count > 0  ORDER BY added_on ASC";
        $selectQuery = $this->conn->query($select);
        while ($result = $selectQuery->fetch_array()) {
            $data[] = $result;
        }
        return $data;
    }//eof showCurrentStoc function




    function showStockExpiry($newMnth){
        $data = array();
        $select = "SELECT * FROM current_stock  WHERE exp_date <=  '$newMnth' ORDER BY exp_date ASC";
        $selectQuery = $this->conn->query($select);
        while ($result = $selectQuery->fetch_array()) {
            $data[] = $result;
        }
        return $data;
    }//eof showCurrentStoc function





    function showCurrentStocByPId($productId){
        // echo $productId;
        $data = array();
        $select = "SELECT * FROM current_stock WHERE `current_stock`.`product_id` = '$productId' ORDER BY added_on ASC";
        // echo $select;
        $selectQuery = $this->conn->query($select);
        while ($result = $selectQuery->fetch_array()) {
            $data[] = $result;
        }
        return $data;
    }//eof showCurrentStocByPId



    

    function showCurrentStocByUnit($productId, $unitType){
        // echo $productId;
        $data = array();
        $select = "SELECT * FROM current_stock WHERE `current_stock`.`product_id` = '$productId' AND `current_stock`.`$unitType` > 0  ORDER BY added_on ASC";
        // echo $select;
        $selectQuery = $this->conn->query($select);
        while ($result = $selectQuery->fetch_array()) {
            $data[] = $result;
        }
        return $data;
    }//eof showCurrentStocByPId




    function checkStockExist($productId){
        $data = array();
        $select = "SELECT product_id FROM current_stock WHERE `current_stock`.`product_id` = '$productId'";
        $selectQuery = $this->conn->query($select);
        while ($result = $selectQuery->fetch_array()) {
            $data[] = $result;
        }
        return $data;
    }//eof checkStockExist



    function deleteCurrentStock($productId, $batchNo){
        $delQry = "DELETE FROM `current_stock` WHERE product_id = '$productId' AND batch_no = '$batchNo'";
        // echo $delQry.$this->conn->error;exit;
        $delSql = $this->conn->query($delQry);
        return $delSql;
    }// eof stockInDelete



}//eof Products class
