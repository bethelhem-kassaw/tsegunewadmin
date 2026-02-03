<?php

namespace App\Http\Controllers\Api;

use App\Filament\Resources\CityResource as ResourcesCityResource;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddressRequest;
use App\Http\Resources\Address\AddressResource;
use App\Http\Resources\Address\CityResource;
use App\Http\Resources\Address\CountryResource;

use App\Http\Resources\ShipmentRateResource;
use App\Models\Adress;
use App\Models\Country;
use App\Models\CountryCity;
use App\Models\ShippmentRate;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function countries(){
        return CountryResource::collection(Country::all());
    }
    public function countryCities($countryId){


      $city = CountryCity::with('shipmentRate')->where('country_id', $countryId)->get();

    //   $city =ShippmentRate::with('city')->get();
    //   $cities = CountryCity::leftJoin('shipment_rates', 'cities.id', '=', 'shipment_rates.city_id')
    // ->select('cities.*')
    // ->get();
      return $city;
        return  ShipmentRateResource::collection($city);


        return new CountryResource(Country::with(['cities.shipmentRate'])->findOrFail($countryId));
    }
    public function subcity($cityId){
        return CountryCity::with('subcityies', 'country')->findOrFail($cityId);
    }
    public function myAddress()
    {
        $myAdresses = Adress::with('country','city')->where('user_id', auth()->id())->get();
        return AddressResource::collection($myAdresses);
    }
    public function addNewAddress(AddressRequest $request)
    {
        $data = $request->all();
        $adress = Adress::create([
            'user_id'       => auth()->user()->id,
            'phone'         => $data['phone'],
            'country_id'    => $data['country_id'],
            'city_id'       => $data['city_id'],
            'posta_number'  => $data['posta_number'],
            'postal_code'   => $data['postal_code'],
            'fullname'      => $data['fullname'],
            'email'         => $data['email'],
            // 'province_name' => $data['province_name'],
            'sub_city_id'   => $data['sub_city_id'],
            'addressLine1'  => $data['addressLine1'],
            'addressLine2'  => $data['addressLine2'],
        ]);
    return $this->myAddress();
    }
    public function removeAddress($adressId)
    {
        $adress = Adress::where('id', $adressId)->where('user_id', auth()->id())->firstOrFail();
        $adress->delete();
        return ['status' => 'success', 'message' => 'deleted successfully!'];
    }
}
