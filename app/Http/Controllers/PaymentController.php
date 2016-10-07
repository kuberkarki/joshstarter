<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
/*use Payum\Core\GatewayInterface;
use Payum\Core\Model\PaymentInterface;
use Payum\Core\Payum;
use Payum\Core\Request\GetHumanStatus;
use Payum\Core\Security\TokenInterface;
use Payum\Core\Storage\StorageInterface;
use Recca0120\LaravelPayum\Service\Payum as PayumService;*/

// use PayPal\Api\Amount;
// use PayPal\Api\Payer;
// use PayPal\Api\RedirectUrls;
// use PayPal\Api\Transaction;
/*use PayPal;
use Srmklive\PayPal\Services\ExpressCheckout;
use Srmklive\PayPal\Services\AdaptivePayments;*/

use Omnipay\Omnipay;
use Omnipay\PayPal;
use Omnipay\Common\CreditCard;
use URL;
use Session;
use Sentinel;
use App\Ad;
use App\ads_prices;
use App\Booking;
use App\Payment;

class PaymentController extends BaseController
{

    
    public function prepare1(PayumService $payumService)
    {
        return $payumService->prepare('offline', function (
            PaymentInterface $payment,
            $gatewayName,
            StorageInterface $storage,
            Payum $payum
        ) {


           

           
            $payment->setNumber(uniqid());
              $payment->setCurrencyCode('PHP');// Needed For Payum to Work
              $payment->setClientId('customer-001'); // Auth User ID
              $payment->setClientEmail('customer@example.com'); // Auth User Email
              $payment->setDetails([
                'BRANDNAME' => 'My Company', // Provide name for cancel and return url
                'LOGOIMG' => 'https://profugo.org/wp-content/uploads/2013/08/logo-190x60.png', // Show at Top
                'SOLUTIONTYPE' => 'Mark', //Buyer must have a PayPal account to check out
                'LANDINGPAGE' => 'Login', // Billing(Credit Card) or Login Type Pages
                'CARTBORDERCOLOR' => '009688', // Border Color
                'CHANNELTYPE' => 'Merchant',
                'L_BILLINGTYPE0' => '0',//Api::BILLINGTYPE_RECURRING_PAYMENTS, // Enables Recurring
                'L_BILLINGAGREEMENTDESCRIPTION0' => '1 Week Free Trial then PREMIUM Membership ₱500 PHP Per Month', // Billing Agreement
                'PAYMENTREQUEST_0_AMT' => 0, // Zero Transaction
                'NOSHIPPING' => 1, // Enable no Shipping Fee for Digital Products
              ]);
        });
    }

    public function done1(PayumService $payumService, Request $request, $payumToken)
    {
        return $payumService->done($request, $payumToken, function (
            GetHumanStatus $status,
            PaymentInterface $payment,
            GatewayInterface $gateway,
            TokenInterface $token
        ) {
            return response()->json([
                'status' => $status->getValue(),
                'client' => [
                    'id'    => $payment->getClientId(),
                    'email' => $payment->getClientEmail(),
                ],
                'number'        => $payment->getNumber(),
                'description'   => $payment->getCurrencyCode(),
                'total_amount'  => $payment->getTotalAmount(),
                'currency_code' => $payment->getCurrencyCode(),
                'details'       => $payment->getDetails(),
            ]);
        });
    }

    public function done(Request $request){
        //echo $request->get('token');exit;
        $gateway = Omnipay::create('PayPal_Express');
        $gateway->setUsername('karki.kuber_api1.gmail.com');
        $gateway->setPassword('YPZ2VJPMNNKW8V7F');
        $gateway->setSignature('An5ns1Kso7MWUdW4ErQKJJJ4qi4-ASuSuCUJVsm.Tdya5GhFc7JzkhJC'); 
        $gateway->setTestMode(true); 
        $params = session()->get('params');
        if(!$params){
            url::Redirect('404');exit;
        }

        $response = $gateway->completePurchase($params)->send(); 
        $paypalResponse = $response->getData(); // this is the raw response object 

        if(isset($paypalResponse['PAYMENTINFO_0_ACK']) && $paypalResponse['PAYMENTINFO_0_ACK'] === 'Success') {
            // here you process the response. Save to database ...
            // 
            

            $id=Session::get('bookData.ads_id');;
            $dateswithcomma=Session::get('bookData.dates');
            $price=Session::get('bookData.price');

            $dates=explode(',',$dateswithcomma);

            foreach($dates as $date){
                $booking=new Booking();
                $booking->ads_id=$id;
                $booking->book_date=$date;
                $booking->price=$price;
                $booking->user_id=Sentinel::getUser()->id;
                $booking->save();
            }

            $paypalResponse->booking_id=$booking->id;
            $paypalResponse->payer=Sentinel::getUser()->id;
            $paypalResponse->receiver=Sentinel::getUser()->id;
            $paypalResponse->product_type='ads';
            $paypalResponse->product_id=$id;


            Payment::save($paypalResponse);

            Session::forget('bookData');
            //dd($paypalResponse);
            return view('user.mybookings');

        } 
        else { 
            dd($paypalResponse);
            return redirect('ads/book')->with('failed', 'Payment Failed');
            // dd($paypalResponse);
            // Failed transaction ...
        }
    }

    public function prepare2(){
        $provider = PayPal::setProvider('express_checkout'); 
        $data = [];
        $data['items'] = [
            [
                'name' => 'Product 1',
                'price' => 9.99,
                'qty' => 1
            ],
            [
                'name' => 'Product 2',
                'price' => 4.99,
                'qty' => 2
            ]
        ];

        $data['invoice_id'] = 1;
        $data['invoice_description'] = "Order #$data[invoice_id] Invoice";
        $data['return_url'] = url('/payment/success');
        $data['cancel_url'] = url('/cart');

        $total = 0;
        foreach($data['items'] as $item) {
            $total += $item['price'];
        }

        $data['total'] = $total;

        $response = $provider->setExpressCheckout($data);
        dd($response);
        return redirect($response['paypal_link']);

    }

    public function preparecard(Request $request){
        $gateway = Omnipay::create('PayPal_Rest');
        //$gateway->clientId('karki.kuber_api1.gmail.com');
        //$gateway->secret('YPZ2VJPMNNKW8V7F');

        $gateway->initialize(array(
        'clientId' => 'AfMGFi1jXzgJZt2JvdMK5KSqgRrD-xRrozoOrOahS0aJ7Tu53oNRkIKkqZbpbKPCXESn3XZslTspjejs',
        'secret'   => 'An5ns1Kso7MWUdW4ErQKJJJ4qi4-ASuSuCUJVsm.Tdya5GhFc7JzkhJC',
       'testMode' => true, // Or false when you are ready for live transactions
        ));


        $card = new CreditCard(array(
                'Name' => $request->get('card_holder_name'),
                'number' => $request->get('card_number'),
                'expiryMonth' => $request->get('expiry_month'),
                'expiryYear'=> $request->get('expiry_year'),
                'cvv'=> $request->get('cvv'),

               //  'billingAddress1'       => '1 Scrubby Creek Road',
               //  'billingCountry'        => 'AU',
               //  'billingCity'           => 'Scrubby Creek',
               //  'billingPostcode'       => '4999',
               // 'billingState'          => 'QLD',
        ));

        

        try {

            $id=Session::get('bookData.ads_id');;
            $dates=Session::get('bookData.dates');

            $days=count(explode(',',$dates));
            $ad=Ad::find($id); 

            $price_id=$request->get('price')*$days;


            if($price_id){
                $price_amount=ads_prices::find($price_id)->price;
            }else{
                $price_amount=$ad->price;
            }

             $dates=Session::set('bookData.price',$price_amount);


            if(!$price_amount && !is_numeric($price)){
                return  Redirect::to('ads/book')->with('error', 'Price Not Selected');
            }

            if(!$ad){
                return  Redirect::to('ads/book')->with('error', 'No Ads Selected');
            }

            if($days<1){
                return  Redirect::to('ads/book')->with('error', 'Date Selected');
            }
            $transaction = $gateway->purchase(array(
                'cancelUrl' => url('ads/detail',$ad),//'http://localhost:8888/eventdayplanner/public/', 
                'returnUrl' => url('payment/done'),//'http://localhost:8888/eventdayplanner/public/payment/done',
                'amount' => (float)$price_amount, 
                'currency'      => 'USD',
                'description' => 'Booking '.$ad->title,
                'BRANDNAME' => 'Event Day Planner',
            ));
            $response = $transaction->send();

          //$response = $gateway->purchase($params)->send(); // here you send details to PayPal
        
        if ($response->isRedirect()) { 
            // redirect to offsite payment gateway 
            $response->redirect(); 
         } 
         else { 

            dd($response);
            // payment failed: display message to customer 
            echo $response->getMessage();
        } 





            $data = $response->getData();
            echo "Gateway purchase response data == " . print_r($data, true) . "\n";
     
            if ($response->isSuccessful()) {
                echo "Purchase transaction was successful!\n";
            }
        } catch (\Exception $e) {
            echo "Exception caught while attempting authorize.\n";
            echo "Exception type == " . get_class($e) . "\n";
            echo "Message == " . $e->getMessage() . "\n";
        }



    }

    public function prepare(Request $request)
    {   

    $id=Session::get('bookData.ads_id');;
    $dates=Session::get('bookData.dates');

    $days=count(explode(',',$dates));
    $ad=Ad::find($id); 

    $price_id=$request->get('price')*$days;


    if($price_id){
        $price_amount=ads_prices::find($price_id)->price;
    }else{
        $price_amount=$ad->price;
    }

     $dates=Session::set('bookData.price',$price_amount);


    if(!$price_amount && !is_numeric($price)){
        return  Redirect::to('ads/book')->with('error', 'Price Not Selected');
    }

    if(!$ad){
        return  Redirect::to('ads/book')->with('error', 'No Ads Selected');
    }

    if($days<1){
        return  Redirect::to('ads/book')->with('error', 'Date Selected');
    }
        $params = array( 
            'cancelUrl' => url('ads/detail',$ad),//'http://localhost:8888/eventdayplanner/public/', 
            'returnUrl' => url('payment/done'),//'http://localhost:8888/eventdayplanner/public/payment/done',
            'amount' => (float)$price_amount, 
            'image_url' => asset('assets/images/eventday/eventdayPlanner.png'),
            'description' => 'Booking '.$ad->title,
            'BRANDNAME' => 'Event Day Planner',
        );

        session()->put('params', $params); // here you save the params to the session so you can use them later.
        session()->save();

        $gateway = Omnipay::create('PayPal_Express');
        $gateway->setUsername('karki.kuber_api1.gmail.com');
        $gateway->setPassword('YPZ2VJPMNNKW8V7F');
        
        $gateway->setSignature('An5ns1Kso7MWUdW4ErQKJJJ4qi4-ASuSuCUJVsm.Tdya5GhFc7JzkhJC'); // and the signature for the account 
        $gateway->setTestMode(true); // set it to true when you develop and when you go to production to false
        $response = $gateway->purchase($params)->send(); // here you send details to PayPal
        
        if ($response->isRedirect()) { 
            // redirect to offsite payment gateway 
            $response->redirect(); 
         } 
         else { 
            // payment failed: display message to customer 
            echo $response->getMessage();
        } 
    }
}