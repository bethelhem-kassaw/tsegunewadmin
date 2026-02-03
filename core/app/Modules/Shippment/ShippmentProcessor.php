<?php
namespace App\Modules\Shippment;
class ShippmentProcessor{

    protected $selectedShippment;
    public function getAvailableShippmentMethods()
    {
        return [
            'dhl-express' => false,
            'warka' => true,
            'test_format' => false,
        ];
    }

    public function getShipmentPrice($destinationAdress, $from = null)
    {
        $methods = $this->getAvailableShippmentMethods();
        $rates = [];
        if($methods['dhl-express']){
           $dhlShippment = new DhlSippment;
           $dhlOutput = $dhlShippment->getDhlProducts($destinationAdress);
           foreach($dhlOutput['products'] as $product) array_push($rates, $product);
        }
        if($methods['warka']){
            $warkaDelivery = new WarkaShippment;
            $rate = $warkaDelivery->setWarkaDelivery($destinationAdress);
            if($rate['available']) array_push($rates, $rate);
        }
        if($methods['test_format']){
            array_push($rates, ['shippmentName' => 'Warka delivery', 'price' => 99, 'currency' => 'USD', 'estimatedTime' => 'today']);
        }
        return $rates;
    }
}