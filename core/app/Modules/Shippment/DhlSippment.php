<?php

namespace App\Modules\Shippment;

use Exception;
use Illuminate\Support\Facades\Http;

class DhlSippment
{
  protected $DHL_LIVE = "https://express.api.dhl.com/mydhlapi";
  protected $DHL_MOCK = "https://api-mock.dhl.com/mydhlapi";
  protected $DHL_TEST = "https://express.api.dhl.com/mydhlapi/test/";
  protected $ACC_NUM = "388030862";

  public function getDhlProducts($destinationAdress)
  {
    
    $dhlStatus = $this->getRate(['country_code' => $destinationAdress->country->country_code, 'postal_code' => $destinationAdress->zipcode, 'city_name' => $destinationAdress->name], ['weight' => cartWeight()]);
     $shippmentMethod = [];
    if($dhlStatus['status'] == 'success'){
      $dhlProduct = $dhlStatus['data'];
        if (array_key_exists('products', $dhlProduct)) {
        $dhlProduct = $dhlProduct['products'];
        foreach ($dhlProduct as $product) {
          $shippmentMethod['DHL : '.$product['productName']] = [
            'available' => true,
            'shippmentName' => 'DHL : '.$product['productName'],
            'price' => $product['totalPrice'][0]['price'],
            'currency' =>  array_key_exists('priceCurrency', $product['totalPrice'][0])?$product['totalPrice'][0]['priceCurrency']:'' ,
            'estimatedTime' => $product['deliveryCapabilities']['estimatedDeliveryDateAndTime'],
          ];
        }
      }
    }
    $dhlStatus['products'] = $shippmentMethod;
    return $dhlStatus;
    
  }
  public function getRate($adress, $product)
  {
    $output = ['status' => 'failed', 'data' => null, 'cause' => 'Some unknown error has been ocured', 'products' => []];
    
    $url =  $this->DHL_TEST;
    $url .= "rates?accountNumber=". $this->ACC_NUM;
    $url .= "&originCountryCode=ET&originPostalCode=1000&originCityName=Addis Ababa&destinationCountryCode=".$adress['country_code'];
    $url .= "&destinationPostalCode=".$adress['postal_code'];
    $url .= "&destinationCityName=".$adress['city_name'];
    $url .= "&weight=".$product['weight'];
    $url .= "&length=0.5&width=0.5&height=0.5";
    $url .= "&plannedShippingDate=".now()->addDays(6)->format('Y-m-d');
    $url .= "&isCustomsDeclarable=false&unitOfMeasurement=metric&nextBusinessDay=false&strictValidation=false&getAllValueAddedServices=false&requestEstimatedDeliveryDate=true&estimatedDeliveryDateType=QDDF";


    try{
      $response = Http::withBasicAuth("brillianthiET", "J!2rG#0bA!3eB@4n")->get($url);
      if ($response->status() == 200) {
        $output['status'] = 'success';
        $output['data'] = $response->json();
        return $output;
      }
      if(array_key_exists('detail', $response->json())){
        throw new Exception($response->json()['detail']); 
      }
      throw new Exception("Some error with network has been ocured, response code: ". $response->status()); 
    }
    catch(Exception $e){
      $output['cause'] = $e->getMessage();
      if(auth()->check() && auth()->user()->email == 'nesrusadik0@gmail.com'){
          dd($output);
      }
      return $output;
    }
    return $output;
  }
  public function createShippment($from, $to, $contactInfo)
  {
    $response = Http::withBasicAuth("brillianthiET", "J!2rG#0bA!3eB@4n")->post($this->DHL_TEST . 'shipments?strictValidation=false&bypassPLTError=false&validateDataOnly=false', $this->prepareData(''));
    dd($response);
  }
  public function prepareData($data)
  {
    $sample =  '{
                      "plannedShippingDateAndTime": "2023-05-19T19:19:40 GMT+00:00",
                      "pickup": {
                        "isRequested": false
                      },
                      "productCode": "P",
                      "localProductCode": "P",
                      "getRateEstimates": false,
                      "accounts": [
                        {
                          "typeCode": "shipper",
                          "number": "388030862"
                        }
                      ],
                      "valueAddedServices": [
                        // {
                        //   "serviceCode": "II",
                        //   "value": 10,
                        //   "currency": "USD"
                        // }
                      ],
                      "outputImageProperties": {
                        "printerDPI": 300,
                        "encodingFormat": "pdf",
                        "imageOptions": [
                          {
                            "typeCode": "invoice",
                            "templateName": "COMMERCIAL_INVOICE_P_10",
                            "isRequested": true,
                            "invoiceType": "commercial",
                            "languageCode": "eng",
                            "languageCountryCode": "US"
                          },
                          {
                            "typeCode": "waybillDoc",
                            "templateName": "ARCH_8x4",
                            "isRequested": true,
                            "hideAccountNumber": false,
                            "numberOfCopies": 1
                          },
                          {
                            "typeCode": "label",
                            "templateName": "ECOM26_84_001",
                            "renderDHLLogo": true,
                            "fitLabelsToA4": false
                          }
                        ],
                        "splitTransportAndWaybillDocLabels": true,
                        "allDocumentsInOneImage": false,
                        "splitDocumentsByPages": false,
                        "splitInvoiceAndReceipt": true,
                        "receiptAndLabelsInOneImage": false
                      },
                      "customerDetails": {
                        "shipperDetails": {
                          "postalAddress": {
                            "postalCode": "1000",
                            "cityName": "Addis ababa",
                            "countryCode": "ET",
                            "addressLine1": "4FENQU, 2HAOKU, WEIPINHUI WULIU YUAN，DAWANG",
                            "addressLine2": "GAOXIN QU, BEIJIANG DADAO, SIHUI,",
                            "addressLine3": "ZHAOQING, GUANDONG",
                            "countyName": "SIHUI",
                            "countryName": "Addis ababa Ethiopia"
                          },
                          "contactInformation": {
                            "email": "nesru@gmail.com",
                            "phone": "18211309039",
                            "mobilePhone": "18211309039",
                            "companyName": "Shop Kager",
                            "fullName": "Nesru Sadik"
                          },
                          "registrationNumbers": [
                            {
                              "typeCode": "SDT",
                              "number": "CN123456789",
                              "issuerCountryCode": "CN"
                            }
                          ],
                          "bankDetails": [
                            {
                              "name": "Bank of China",
                              "settlementLocalCurrency": "RMB",
                              "settlementForeignCurrency": "USD"
                            }
                          ],
                          "typeCode": "business"
                        },
                        "receiverDetails": {
                          "postalAddress": {
                            "cityName": "Graford",
                            "countryCode": "US",
                            "postalCode": "76449",
                            "addressLine1": "116 Marine Dr",
                            "countryName": "UNITED STATES OF AMERICA"
                          },
                          "contactInformation": {
                            "email": "recipient_create_shipmentapi@dhltestmail.com",
                            "phone": "9402825665",
                            "mobilePhone": "9402825666",
                            "companyName": "Baylee Marshall",
                            "fullName": "Baylee Marshall"
                          },
                          "registrationNumbers": [
                            {
                              "typeCode": "SSN",
                              "number": "US123456789",
                              "issuerCountryCode": "US"
                            }
                          ],
                          "bankDetails": [
                            {
                              "name": "Bank of America",
                              "settlementLocalCurrency": "USD",
                              "settlementForeignCurrency": "USD"
                            }
                          ],
                          "typeCode": "business"
                        }
                      },
                      "content": {
                        "packages": [
                          {
                            "typeCode": "2BP",
                            "weight": 0.5,
                            "dimensions": {
                              "length": 1,
                              "width": 1,
                              "height": 1
                            },
                            "customerReferences": [
                              {
                                "value": "3654673",
                                "typeCode": "CU"
                              }
                            ],
                            "description": "Piece content description",
                            "labelDescription": "bespoke label description"
                          }
                        ],
                        "isCustomsDeclarable": true,
                        "declaredValue": 120,
                        "declaredValueCurrency": "USD",
                        "exportDeclaration": {
                          "lineItems": [
                            {
                              "number": 1,
                              "description": "Harry Steward biography first edition",
                              "price": 15,
                              "quantity": {
                                "value": 4,
                                "unitOfMeasurement": "GM"
                              },
                              "commodityCodes": [
                                {
                                  "typeCode": "outbound",
                                  "value": "84713000"
                                },
                                {
                                  "typeCode": "inbound",
                                  "value": "5109101110"
                                }
                              ],
                              "exportReasonType": "permanent",
                              "manufacturerCountry": "US",
                              "exportControlClassificationNumber": "US123456789",
                              "weight": {
                                "netValue": 0.1,
                                "grossValue": 0.7
                              },
                              "isTaxesPaid": true,
                              "additionalInformation": [
                                "450pages"
                              ],
                              "customerReferences": [
                                {
                                  "typeCode": "AFE",
                                  "value": "1299210"
                                }
                              ],
                              "customsDocuments": [
                                {
                                  "typeCode": "COO",
                                  "value": "MyDHLAPI - LN#1-CUSDOC-001"
                                }
                              ]
                            },
                            {
                              "number": 2,
                              "description": "Andromeda Chapter 394 - Revenge of Brook",
                              "price": 15,
                              "quantity": {
                                "value": 4,
                                "unitOfMeasurement": "GM"
                              },
                              "commodityCodes": [
                                {
                                  "typeCode": "outbound",
                                  "value": "6109100011"
                                },
                                {
                                  "typeCode": "inbound",
                                  "value": "5109101111"
                                }
                              ],
                              "exportReasonType": "permanent",
                              "manufacturerCountry": "US",
                              "exportControlClassificationNumber": "US123456789",
                              "weight": {
                                "netValue": 0.1,
                                "grossValue": 0.7
                              },
                              "isTaxesPaid": true,
                              "additionalInformation": [
                                "36pages"
                              ],
                              "customerReferences": [
                                {
                                  "typeCode": "AFE",
                                  "value": "1299211"
                                }
                              ],
                              "customsDocuments": [
                                {
                                  "typeCode": "COO",
                                  "value": "MyDHLAPI - LN#1-CUSDOC-001"
                                }
                              ]
                            }
                          ],
                          "invoice": {
                            "number": "2667168671",
                            "date": "2022-10-22",
                            "instructions": [
                              "Handle with care"
                            ],
                            "totalNetWeight": 0.4,
                            "totalGrossWeight": 0.5,
                            "customerReferences": [
                              {
                                "typeCode": "UCN",
                                "value": "UCN-783974937"
                              },
                              {
                                "typeCode": "CN",
                                "value": "CUN-76498376498"
                              },
                              {
                                "typeCode": "RMA",
                                "value": "MyDHLAPI-TESTREF-001"
                              }
                            ],
                            "termsOfPayment": "100 days",
                            "indicativeCustomsValues": {
                              "importCustomsDutyValue": 150.57,
                              "importTaxesValue": 49.43
                            }
                          },
                          "remarks": [
                            {
                              "value": "Right side up only"
                            }
                          ],
                          "additionalCharges": [
                            {
                              "value": 10,
                              "caption": "fee",
                              "typeCode": "freight"
                            },
                            {
                              "value": 20,
                              "caption": "freight charges",
                              "typeCode": "other"
                            },
                            {
                              "value": 10,
                              "caption": "ins charges",
                              "typeCode": "insurance"
                            },
                            {
                              "value": 7,
                              "caption": "rev charges",
                              "typeCode": "reverse_charge"
                            }
                          ],
                          "destinationPortName": "New York Port",
                          "placeOfIncoterm": "ShenZhen Port",
                          "payerVATNumber": "12345ED",
                          "recipientReference": "01291344",
                          "exporter": {
                            "id": "121233",
                            "code": "S"
                          },
                          "packageMarks": "Fragile glass bottle",
                          "declarationNotes": [
                            {
                              "value": "up to three declaration notes"
                            }
                          ],
                          "exportReference": "export reference",
                          "exportReason": "export reason",
                          "exportReasonType": "permanent",
                          "licenses": [
                            {
                              "typeCode": "export",
                              "value": "123127233"
                            }
                          ],
                          "shipmentType": "personal",
                          "customsDocuments": [
                            {
                              "typeCode": "INV",
                              "value": "MyDHLAPI - CUSDOC-001"
                            }
                          ]
                        },
                        "description": "Shipment",
                        "USFilingTypeValue": "12345",
                        "incoterm": "DAP",
                        "unitOfMeasurement": "metric"
                      },
                      "shipmentNotification": [
                        {
                          "typeCode": "email",
                          "receiverId": "shipmentnotification@mydhlapisample.com",
                          "languageCode": "eng",
                          "languageCountryCode": "UK",
                          "bespokeMessage": "message to be included in the notification"
                        }
                      ],
                      "getTransliteratedResponse": false,
                      "estimatedDeliveryDate": {
                        "isRequested": true,
                        "typeCode": "QDDC"
                      },
                      "getAdditionalInformation": [
                        {
                          "typeCode": "pickupDetails",
                          "isRequested": true
                        }
                      ]
                    }';
    $sample = objectToArray(json_decode($sample));
    dd($sample);
    return json_encode($sample);
  }
}
