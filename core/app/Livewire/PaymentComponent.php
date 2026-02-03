<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Transaction;
use App\Modules\Payment\PaymentProcessor;

class PaymentComponent extends Component
{
    public $shippmentAdress;
    public $payment = ['method' => null, 'data' => null];
    public $billadress = 0;
    public $paymentMethods;
    public function mount($shippmentAdress = null,PaymentProcessor $paymentMethods)
    {
        $this->shippmentAdress = $shippmentAdress;
        $this->paymentMethods = $paymentMethods->getAvailabePaymentMethods();
    }
    public function continue()
    {
        if(isset($this->payment['method']) && $this->payment['method'] == 'cards'){
            $this->validate([
                'payment.data.nameonCard' => 'required',
                'payment.data.cardNumber' => 'required',
                'payment.data.expYear' => 'required',
                'payment.data.expMonth' => 'required',
                'payment.data.cvv' => 'required',
            ]);
        }
        else {
            $this->validate(['payment.method' => 'required']);
        }

        $this->dispatch('paymentAdded', $this->payment);

    }
    public function calcTotal()
    {
        return $this->shippmentAdress['shippmentMethod']['price'] + cartTotal();
    }
    public function render() 
    {
        return view('livewire.payment-component');
    }
}
