<?php
/*sd_id
date_issued
cust_id
empid

sp_id
sd_id
cp_id
qty_sold
amount_sold*/

class SaleController
{
    public function getSaleDetailsList()
    {
    }

    public function getSaleDetails()
    {
    }

    public function getSaleProduct()
    {
    }

    public function createSaleProduct()
    {
        include $_SERVER['DOCUMENT_ROOT'] . "/app/Models/SaleProductModel.php";
        $salproduct = new SaleProductModel();
        $result = $salproduct->createSaleProduct($_POST['sd_id'], $_POST['cp_id'], $_POST['qty_sold'], $_POST["amount_sold"]);
        echo $result;
    }

    public function updateSaleProduct()
    {
    }

    public function deleteSaleProduct()
    {
    }

    public function createSaleDetails()
    {
        include $_SERVER['DOCUMENT_ROOT'] . "/app/Models/SaleDetailsModel.php";
        $saldetails = new SaleDetailsModel();
        $result = $saldetails->createSaleDetails($_POST['date_issued'], $_POST['cust_id'], $_POST['empid']);
        echo $result;
    }

    public function updateSaleDetails()
    {
    }

    public function deleteSaleDetails()
    {
    }
}
