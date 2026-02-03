<div>
    <style>
        .country-code-text {
            position: absolute;
            z-index: 2000;
            left: 25px;
            bottom: 14px;
            background-color: rgb(196, 196, 196);
            font-size: 17px;
            padding-bottom: 5px;
            padding-top: 5px;
            padding-left: 2px;
            padding-right: 2px;
        }

        #phone-number {
            position: relative;
            /* border-left: 1px; */
            height: 50px;
            /* padding-left: 58px; */
        }
    </style>
    <div class="row">
        @if(sizeof($savedAdress) > 0)
        <!-- select shipping adress -->
        <div class="col-12">
            <h3 class="mb-5 border-bottom pb-2">Select A Shipping Adress</h3>
        </div>
        @foreach ($savedAdress as $adr)
        <div class="col-sm-6 mb-4">
            <input wire:model.live="shippment.shippment_adress_id" id="{{$adr->id}}" class="custom-checkbox" type="radio" value="{{$adr->id}}" name="adress_id">
            <label for="{{$adr->id}}">{{ $adr->city->name.', '. $adr->subcity->name }}</label>
            <small class="d-block ml-3">{{'Receiver : '.$adr->fullname.'('.$adr->phone.')' }}</small>
        </div>
        @endforeach
        @error('shippment.shippment_adress_id')
        <span for="zip-code" style="color:red;margin-left:20px;">{{$message}}</span> </br>
        @enderror
        @endif
        <div class="col-sm-6 mb-4 row ml-1">

            New adress :
            <li class="list-inline-item mr-4">
                <label class="radio ml-2">
                    <input wire:model.live="newAdress" type="checkbox" name="radio">
                    <span class="radio-box bg-magenta"></span>
                </label>
            </li>

        </div>
    </div>

    <!-- /select shipping method -->
    @if($newAdress)
    <h3 class="mb-5 border-bottom pb-2">Shippment Address</h3>
    <div class="row">
        <div class="row" style="border: solid 1px rgba(233, 233, 233, 0.5);margin: 0px 0px 10px 10px;padding:20px 0px;">
            <div class="col-sm-6 mb-2">
                <label for="country">Country</label>
                <select disabled wire:model.live="adress.country_id" onchange="countrySelected()" style="margin-bottom:0px;" class="form-control" id="countrySelect">
                    <option value="">Country</option>
                    @foreach ($countries as $country)
                    <option value="{{ $country['id'] }}">{{ $country['name'] }}</option>
                    @endforeach
                </select>
                @error('adress.country_id')
                <span for="zip-code" style="color:red;">{{$message}}</span>
                @enderror
            </div>

            <div class="col-sm-6 mb-2">
                <label for="city">City</label>
                <select wire:model.blur="adress.city_id" onchange="citySelected()" style="margin-bottom:0px;" class="form-control" id="citySelect">
                    <option value="">Your city</option>
                    @if($cities)
                    @foreach ($cities as $city)
                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                    @endforeach
                    @endif
                </select>
                @error('adress.city')
                <span for="zip-code" style="color:red;">{{$message}}</span>
                @enderror
            </div>

            <div class="col-sm-6 mb-2">
                <label for="address">Town/Sub City</label>
                <select wire:model.blur="adress.sub_city_id" style="margin-bottom:0px;" class="form-control" id="citySelect">
                    <option value="">Sub city</option>
                    @if($subCities)
                    @foreach ($subCities as $subCity)
                    <option value="{{ $subCity->id }}">{{ $subCity->name }}</option>
                    @endforeach
                    @endif
                </select>
                @error('adress.sub_city_id')
                <span for="zip-code" style="color:red;">{{$message}}</span>
                @enderror
            </div>

            <div class="col-sm-6 mb-2">
                <label for="addressLine1">Apartment, Suite, Street, etc.. (optional)</label>
                <input wire:model.blur="adress.addressLine1" style="margin-bottom:0px;" class="form-control" type="text" id="address" required>
                @error('adress.addressLine1')
                <span for="zip-code" style="color:red;">{{$message}}</span>
                @enderror
            </div>

            <div class="col-sm-6 mb-2">
                <label for="zip-code">Zip Code</label>
                <input wire:model.blur="adress.postal_code" style="margin-bottom:0px;" class="form-control" type="text" id="zip-code">
                @error('adress.postal_code')
                <span for="zip-code" style="color:red;">{{$message}}</span>
                @enderror
            </div>
        </div>

        <div class="row" style="border: solid 1px rgba(233, 233, 233, 0.5);margin: 0px 10px 10px 10px;padding:20px 0px  ">

            <div class="col-sm-6">
                <label for="firstName">Receiver Name</label>
                <input class="form-control" wire:model.blur="adress.fullname" value="" style="margin-bottom:0px;" type="text" id="firstName" name="firstName" required>
                @error('adress.fullname')
                <span for="zip-code" style="color:red;">{{$message}}</span>
                @enderror
            </div>

            <div class="col-sm-6 mb-2">
                <label for="lastName">Phone Number</label>
                <div class="input-group-prepend">
                    <!-- @if($country_code)
                    <span class="country-code-text">{{ $country_code }}</span>
                    @endif -->
                    <input wire:model.blur="adress.phone" style="margin-bottom:0px;" id="phone-number" class="form-control" type="tel">
                </div>
                @error('adress.phone')
                <span for="zip-code" style="color:red;">{{$message}}</span>
                @enderror
            </div>

            <div class="col-sm-6 mb-2">
                <label for="email">Email (optional)</label>
                <input wire:model.blur="adress.email" style="margin-bottom:0px;" class="form-control" type="email" id="email" name="email" required>
                @error('adress.email')
                <span for="zip-code" style="color:red;">{{$message}}</span>
                @enderror
            </div>
            <div class="col-sm-6 mb-2">
                <label for="company">Posta Number (optional)</label>
                <input wire:model.blur="adress.posta_number" style="margin-bottom:0px;" class="form-control" type="text" id="company" name="company" required>
                @error('adress.posta_number')
                <span for="zip-code" style="color:red;">{{$message}}</span>
                @enderror
            </div>
        </div>


        <!-- <div class="col-sm-6 mb-2">
            <label for="addressLine3">Address line 3(optional)</label>
            <input wire:model.blur="adress.addressLine3"  style="margin-bottom:0px;" class="form-control" id="address type="text"  required>
            @error('adress.addressLine3') 
                <span for="zip-code" style="color:red;">{{$message}}</span>
            @enderror
        </div> -->

    </div>
    @endif

    <div class="row">
        <!-- select shipping method -->
        @if($shippmentMethod != null)
        <div class="col-12">
            <h3 class="mb-5 border-bottom pb-2">Select A Shippment Method</h3>
        </div>
        @if($shippmentMethod == 'unavailable')
        <div div class="col-12">
            <h5 class="mb-5 border-bottom pb-2">Sorry! Shippment method is not available for your adress!</h5>
        </div>
        @else

        @foreach ($shippmentMethod as $method => $shipp)
        @if($shipp['shippmentName'] != 'DHL : EXPRESS EASY DOC')
        <div class="col-sm-6 mb-4">
            <input wire:model.live="shippment.shippment_method" id="{{$shipp['shippmentName'] }}" class="custom-checkbox" type="radio" value="{{ $method }}" name="shippment_method">
            <label for="{{$shipp['shippmentName']}}"> {{ $shipp['shippmentName'] }}</label>
            <span class="ml-3 d-block">{{'Estimated price : '.$shipp['price'].$shipp['currency']}}</span>
            <small class="d-block ml-3">{{'Estimated delivery time : '. $shipp['estimatedTime']}}</small>
        </div>
        @endif
        @endforeach
        @error('shippment.shippment_method')
        <span for="zip-code" style="color:red;margin-left:20px">{{$message}}</span>
        @enderror
        @endif
        @endif
    </div>


    <!-- /shipping-address -->
    <div class="p-4 bg-gray text-right mt-4">
        <div wire:loading>
            <button class="btn btn-primary buttonload"><i class="fa fa-spinner fa-spin"></i> Please wait</button>
        </div>
        <div wire:loading.remove>
            <button wire:click="continue" class="btn btn-primary">Continue</button>
        </div>
    </div>



    <script>
        function countrySelected() {
            let select = document.getElementById('countrySelect');
            let id = select.options[select.selectedIndex].value;
            Livewire.emit('countrySelected', id)
        }

        function citySelected() {
            let select = document.getElementById('citySelect');
            let id = select.options[select.selectedIndex].value;
            Livewire.emit('citySelected', id)
        }
    </script>
</div>