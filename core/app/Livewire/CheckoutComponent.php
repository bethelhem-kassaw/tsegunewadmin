<?php

namespace App\Livewire;

use Livewire\Component;

class CheckoutComponent extends Component
{
    protected $listeners = ['shippmentAdded', 'paymentAdded', 'pageSelector'];

    public $page = 'shippment';
    public $shippmentAdress = null;
    public $paymentDetail = null;
    
    public function shippmentAdded($adress)
    {
        $this->shippmentAdress = $adress;
        $this->pageSelector('payment');
    }
    public function pageSelector($page)
    {
        $this->page = $page;
    }
    public function paymentAdded($paymentDetail)
    {
        $this->paymentDetail = $paymentDetail;
        $this->pageSelector('review');
    }
    
    public function render()
    {
        return view('livewire.checkout-component')
                    ->layout('layouts.customer.app');
    }
}
