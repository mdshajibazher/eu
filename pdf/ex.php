<?php
ob_start ();
require('invoice.php');
include '../classes/sold_product.php'; 
include '../classes/product.php'; 

$si = new soldItem;

$oid = $_GET['order_id'];

$getsoldItem= $si->getSpecificSoldItem($oid);
if($getsoldItem){
  $i=0;
  while($result=$getsoldItem->fetch_assoc()){

$user_id = $result['user_id'];
$order_id = $result['order_id'];
$purchaseDate = $result['purchaseAt'];
$payement_mode = $result['payment_mode'];
if($payement_mode == 1){
  $payement_mode = "CASH ON DELIVERY";
}else{
  $payement_mode = "Credit/Debit Card";
}
$payement_status = $result['payment_status'];
if($payement_status == 0){
    $payement_status = "UNPAID";
}else{
    $payement_status = "PAID";
}
$timeStamp = date( "d/m/Y", strtotime($purchaseDate));



$pdf = new PDF_Invoice( 'P', 'mm', 'A4' );
$pdf->AddPage();
$pdf->Image('banner.png',10,10,0,0,'PNG');
$pdf->fact_dev( "", "Invoice-Order No. ".$order_id );
$pdf->temporaire($payement_status);


$pdf->addDate($timeStamp);
$pdf->addClient($user_id);
$pdf->addPageNumber("1");

$getUserInf= $si->getUserInformation($user_id);


if($getUserInf){
  while($sresult=$getUserInf->fetch_assoc()){
    $name = $sresult['name'];
    $address = $sresult['Address'];


$pdf->addClientName($name);
$pdf->addClientAdresse("$address");


  }
}
$pdf->addPaymentMethod($payement_mode);
// $pdf->addEcheance("03/12/2003");
$pdf->addpaymentStatus($payement_status);
$pdf->addReference("");


$cols=array( "Sl."    => 23,
             "PRODUCT"  => 78,
             "QUANTITE"     => 22,
             "PRICE"      => 26,
             "TOTAL" => 30,
             "REF"          => 11 );
$pdf->addCols( $cols);
$cols=array( "Sl."    => "L",
             "PRODUCT"  => "L",
             "QUANTITE"     => "C",
             "PRICE"      => "R",
             "TOTAL" => "R",
             "REF"          => "C" );
$pdf->addLineFormat( $cols);
$pdf->addLineFormat($cols);

$y    = 109;


$getcartInf= $si->getCartInformation($order_id);


if($getcartInf){
  $j=0;
  $sum = 0;
  while($sresult=$getcartInf->fetch_assoc()){
  $j++;


$productName = $sresult['productname'];
$product_qty = $sresult['quantity'];
$price = $sresult['price'];
$total_price = $price*$product_qty;


$sum = $sum+$total_price;
$discount = $sum*.1;
$payable = $sum-$discount;
$line = array( "Sl."    => $j,
               "PRODUCT"  => $productName ."\n\n",
               "QUANTITE"     => $product_qty,
               "PRICE"      => $price,
               "TOTAL" => $total_price,
               "REF"          => "0" );
$size = $pdf->addLine( $y, $line );
$y   += $size + 2;

} }




} }


$pdf->totalAmountBox($sum, $discount, $payable);
$pdf->Output();
ob_end_flush();
?>
