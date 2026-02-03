<?php

namespace App\Livewire;

use App\Http\Controllers\OrderController;
use App\Modules\Payment\PaymentProcessor;
use Livewire\Component;

class ReviewComponent extends Component
{
    public $carts;
    public $paymentDetail;
    public $shippmentAdress;
    public function mount($shippmentAdress = null, $paymentDetail = null)
    {
        $this->carts = session()->get('cart');  
        $this->shippmentAdress = $shippmentAdress;
        $this->paymentDetail = $paymentDetail;
    }
    public function placeOrder()
    {
        $payment = $this->paymentDetail;
        $shipp = $this->shippmentAdress;

        $shipp['paymentMethod'] = $payment['method'];
        session()->put('shippment', $shipp);
        dump($payment);
        dd($shipp);
        $totalPrice = $shipp?$shipp['shippmentMethod']['price'] + cartTotal()['discounted']:cartTotal()['discounted'];
        $paymentProcessor = new PaymentProcessor($totalPrice, $payment['method']);
        $paymentProcessor->setFields($payment, $shipp);

        $status = $paymentProcessor->makePayment();
        if($status instanceof \Livewire\Redirector){
            return $status;
        }
        if($status['paymentCompleted']){
            $orderer = new OrderController;
            $orderId = $orderer->placeOrder($status['preparedData']);
            $this->dispatch('makeAlert', ['type' => 'success', 'message' => 'Your order placed successfully']);
            return redirect()->route('shop.confirmation', $orderId);
        }
        else{
            $this->dispatch('makeAlert', ['type' => 'danger', 'message' => $status['message']]);
        }
    }
    
    public function render()
    {
        return view('livewire.review-component');
    }
}
