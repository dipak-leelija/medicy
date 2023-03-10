<?php

require_once 'dbconnect.php';




class StockInDetails extends DatabaseConnection{



    function addStockInDetails($productId, $distBill, $batchNo, $expDate, $weightage, $unit, $qty, $freeQty, $looselyCount, $mrp, $ptr, $discount, $base, $gst, $gstPerItem, $margin, $amount, $addedBy){

        $insert = "INSERT INTO `stock_in_details` (`product_id`, `distributor_bill`, `batch_no`, `exp_date`, `weightage`, `unit`, `qty`, `free_qty`, `loosely_count`, `mrp`, `ptr`,	`discount`,	`base`,	`gst`, `gst_amount`, `margin`, `amount`, `added_by`) VALUES ('$productId', '$distBill', '$batchNo', '$expDate', '$weightage', '$unit', '$qty', '$freeQty', '$looselyCount', '$mrp', '$ptr', '$discount', '$base', '$gst', '$gstPerItem', '$margin', '$amount', '$addedBy')";
        // echo $insert.$this->conn->error;exit;
        $addStockInQuery = $this->conn->query($insert);
        // echo var_dump($addStockInQuery);exit;
        return $addStockInQuery;
    }//eof addProduct function 



    function showStockInDetails(){
        $select = " SELECT * FROM stock_in_details ";
        $selectQuery = $this->conn->query($select);
        while ($result = $selectQuery->fetch_array()) {
            $data[] = $result;
        }
        return $data;
    }//eof showStockInDetails function



    function showStockInDetailsByTable($table1, $table2, $data1, $data2){
        $data   = array();
        $select = "SELECT * FROM stock_in_details WHERE `$table1`= '$data1' AND `$table2`= '$data2'";
        $selectQuery = $this->conn->query($select);
        while ($result = $selectQuery->fetch_array()) {
            $data[] = $result;
        }
        return $data;
    }//eof showStockInByTable function




    function showStockInDetailsById($DistBill){
        $select = " SELECT * FROM stock_in_details WHERE  `stock_in_details`.`distributor_bill`= '$DistBill'";
        $selectQuery = $this->conn->query($select);
        while ($result = $selectQuery->fetch_array()) {
            $data[] = $result;
        }
        return $data;
    }//eof showStockInDetails function



    function showStockInDetailsByPId($productId){
        $select = "SELECT * FROM stock_in_details WHERE `stock_in_details`.`product_id` = '$productId'";
        $selectQuery = $this->conn->query($select);
        while ($result = $selectQuery->fetch_array()) {
            $data[] = $result;
        }
        return $data;
    }// eof showStockInDetailsByPId



    function showStockInMargin($productId){
        $select = "SELECT margin FROM stock_in_details WHERE `stock_in_details`.`product_id` = '$productId'";
        $selectQuery = $this->conn->query($select);
        while ($result = $selectQuery->fetch_array()) {
            $data[] = $result;
        }
        return $data;
    } // eof showStockInMargin



    function showStockInByBatch($batchNo){
        $data = array();
        $sql = "SELECT * FROM stock_in_details WHERE `batch_no` = '$batchNo'";
        $sqlRes = $this->conn->query($sql);
        while ($result = $sqlRes->fetch_array()) {
            $data[] = $result;
        }
        return $data;
    }// eof stockInDelete

    function stockDistributorBillNo($batchNo, $productId){
        
        $data = array();
        $sql = "SELECT * FROM stock_in_details WHERE `batch_no` = '$batchNo' AND `product_id` = '$productId'";
        $sqlRes = $this->conn->query($sql);
        while ($result = $sqlRes->fetch_array()) {
            $data[] = $result;
        }
        return $data;
    }// fetching stock Distributor Bill no

    

    function stockInDelete($distBill, $batchNo){
        $delQry = "DELETE FROM stock_in_details WHERE distributor_bill = '$distBill' AND batch_no = '$batchNo'";
        $delSql = $this->conn->query($delQry);
        return $delSql;
    }// eof stockInDelete


    
}//eof Products class

