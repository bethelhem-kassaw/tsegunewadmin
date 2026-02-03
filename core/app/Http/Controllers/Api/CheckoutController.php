<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MakePaymentRequest;
use App\Models\Adress;
use App\Models\CountryCity;
use App\Modules\Payment\PaymentProcessor;
use App\Modules\Shippment\ShippmentProcessor;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function getAvailableShippmentOptions($addressId)
    {
        $adress = Adress::findOrFail($addressId);
        $shippmentProcessor = new ShippmentProcessor;
        $destination = CountryCity::with('country')->where('id', $adress->city_id)->first();

        $shippmentMethod = $shippmentProcessor->getShipmentPrice($destination);

        return $shippmentMethod;
    }
    public function getAvailablePaymentMethods(PaymentProcessor $paymentMethods)
    {
        $paymentMethods = $paymentMethods->getAvailabePaymentMethods();
        return $paymentMethods;
    }
    public function makePayment(MakePaymentRequest $request)
    {
        ///////////////////        Payment setup      //////////////////////////////////
        $payment = [];
        $payment['data']['method']  = $request->payment_method;
        if ($request->payment_method == 'cards') {
            $payment['data']['nameonCard'] = $request->nameOnCard;
            $payment['data']['cardNumber'] = $request->cardNumber;
            $payment['data']['expYear']    = $request->expYear;
            $payment['data']['expMonth']   = $request->expMonth;
            $payment['data']['cvv']        = $request->cvv;
        }
        ///////////////////      Shippment Address Setup    ////////////////////////////
        $shippAdress = Adress::find($request->shippmentAddressId);

        
        $shippmentProcessor = new ShippmentProcessor;
        $destination = CountryCity::with('country')->where('id', $shippAdress->city_id)->first();
        $shippmentMethods = $shippmentProcessor->getShipmentPrice($destination);
        $shipp['shippmentMethod'] = $shippmentMethods[$request->shippmentMethod];

        $shippAdress['paymentMethod'] = $request->payment_method;
        session()->put('shippment', $shippAdress);

        $totalPrice = $shipp ? $shipp['shippmentMethod']['price'] + cartTotal()['discounted'] : cartTotal()['discounted'];
        $paymentProcessor = new PaymentProcessor($totalPrice, $payment['method']);
        $paymentProcessor->setFields($payment, $shipp);

        $status = $paymentProcessor->makePayment();
        if ($status instanceof \Livewire\Redirector) {
            return $status;
        }
        if ($status['paymentCompleted']) {
            $orderer = new OrderController;
            $orderId = $orderer->placeOrder($status['preparedData']);
            $this->dispatch('makeAlert', ['type' => 'success', 'message' => 'Your order placed successfully']);
            return redirect()->route('shop.confirmation', $orderId);
        } else {
            $this->dispatch('makeAlert', ['type' => 'danger', 'message' => $status['message']]);
        }
    }
}
