<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\CountryCity;
use App\Models\Adress;
use App\Models\Country;
use App\Models\SubCity;
use App\Modules\Shippment\ShippmentProcessor;
use Stevebauman\Location\Facades\Location;

class ShippmentComponent extends Component
{
    protected $listeners = ['countrySelected', 'citySelected'];
    public $newAdress = false;
    public $adress = ['country_id' => null, 'city_id' => null, 'posta_number' => null, 'postal_code' => null, 'sub_city_id' => null, 'addressLine1' => null, 'addressLine2' => null];
    public $shippment = ['shippment_method' => null, 'shippment_adress_id' => null];
    public $countries;
    public $cities;
    public $country_code = null;
    public $savedAdress = null;
    public $shippmentMethod = null;
    public $shippmentPrice;
    public $subCities = null;

    protected $rules = [
        'adress.fullname'     => 'required|string',
        'adress.phone'        => 'required|numeric',
        'adress.email'        => 'nullable|string',
        'adress.country_id'   => 'required',
        'adress.city_id'      => 'required|numeric',
        'adress.posta_number' => 'nullable',
        'adress.postal_code'  => 'required',
        'adress.sub_city_id'  => 'required',
        'adress.addressLine1' => 'nullable',
        'adress.addressLine2' => 'nullable',
    ];
    public function mount()
    {
        $this->countries = Country::whereHas('cities')->where('shippment_support', true)->get()->sortBy('name');
        $this->findSavedAdresses();
        $this->adress['fullname'] = auth()->user()->first_name . ' ' . auth()->user()->last_name;
        $this->adress['phone'] = auth()->user()->phone;
        $this->adress['email'] = auth()->user()->email;

        // $data = Location::get(request()->ip());

        // $currentCountry = Country::where('name', $data['countryName'])->first();
        $currentCountry = Country::where('name', 'Ethiopia')->first();
        if ($currentCountry) {
            $this->adress['country_id'] = $currentCountry->id;
            $this->findCities($currentCountry->id);
        }
    }
    public function updatedShippmentShippmentAdressId()
    {
        $this->adress = Adress::with('country', 'city')->where('id', $this->shippment['shippment_adress_id'])->first();
        $this->setDisplayShippmet();
    }
    public function countrySelected($id)
    {
        $this->adress['country_id'] = $id;
        $this->findCities($id);
        // $this->setDisplayShippmet();
    }
    public function citySelected($id)
    {
        $this->adress['city_id'] = $id;
        $this->subCities = SubCity::where('city_id', $id)->orderBy('name')->get();

        $this->adress['postal_code'] = $this->cities->where('id', $id)->first()->zipcode;
        $this->setDisplayShippmet();
    }
    public function setDisplayShippmet()
    {
        $shippmentProcessor = new ShippmentProcessor;
        $destination = CountryCity::with('country')->where('id', $this->adress['city_id'])->first();
        $this->shippmentMethod = $shippmentProcessor->getShipmentPrice($destination, $this->countries);

        if (count($this->shippmentMethod) == 0) {
            $this->dispatch('makeAlert', ['type' => 'danger', 'message' => 'Error while fetching available shippments to your address. Please check the information you provided is correct or don\'t hesitate to contat us kindly!']);
        }
    }

    public function findSavedAdresses()
    {
        $this->savedAdress = Adress::with('country', 'city', 'subcity')->where('user_id', auth()->user()->id)->get();
        if (!count($this->savedAdress)) {
            $this->newAdress = true;
        }
    }
    public function continue()
    {
        $adress = null;
        if ($this->newAdress) {
            $this->validate();
            $adress = Adress::create([
                'user_id'       => auth()->user()->id,
                'phone'         => $this->adress['phone'],
                'country_id'    => $this->adress['country_id'],
                'city_id'       => $this->adress['city_id'],
                'posta_number'  => $this->adress['posta_number'],
                'postal_code'   => $this->adress['postal_code'],
                'fullname'      => $this->adress['fullname'],
                'email'         => $this->adress['email'],
                // 'province_name' => $this->adress['province_name'],
                'sub_city_id'   => $this->adress['sub_city_id'],
                'addressLine1'  => $this->adress['addressLine1'],
                'addressLine2'  => $this->adress['addressLine2'],
            ]);
            $this->shippment['shippment_adress_id'] = $adress->id;
            $this->findSavedAdresses();
        } else {
            $this->validate([
                'shippment.shippment_adress_id' => 'required',
                'shippment.shippment_method' => 'required'
            ]);
        }
        $this->adress['country_code'] = $this->countries->where('id', $this->adress['country_id'])->first()->country_code;
        $this->adress['city_name'] = CountryCity::where('id', $this->adress['city_id'])->first()->name;
        $selectedShippment = $this->shippmentMethod[$this->shippment['shippment_method']];
        $selectedShippment['shippment_adress_id'] =  $this->shippment['shippment_adress_id'];
        $selectedShippment['ShippmentTag'] = $this->shippment['shippment_method'];
        $this->adress['shippmentMethod'] = $selectedShippment;
        $this->dispatch('shippmentAdded', $this->adress);
    }

    public function findCities($country_id)
    {
        $this->cities = CountryCity::where('country_id', $country_id)
            ->where('zipcode', '!=', null)
            ->where('status', true)
            ->get()
            ->sortBy('name');

        // $this->cities = CountryCity::where('country_id', $country_id)->where('zipcode', '!=', null)->get()->sortBy('name');   
        $this->country_code = $this->countries->where('id', $country_id)->first()->dial_code;
    }
    public function render()
    {
        return view('livewire.shippment-component');
    }
}
