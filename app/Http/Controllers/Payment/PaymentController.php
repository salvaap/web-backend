<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use SoapClient;
use function GuzzleHttp\Psr7\str;

class PaymentController extends Controller
{
    public $TransactionDetails = [];
    public $CardDetails = [];
    public $BillingDetails = [];

    public function checkout(Request $request) {
//        marlin
        $wsdlurl = 'https://ecm.firstatlanticcommerce.com/PGService/Services.svc?wsdl';
        $options = array(
            'location' =>
                'https://ecm.firstatlanticcommerce.com/PGService/Services.svc',
            'soap_version'=>SOAP_1_1,
            'exceptions'=>0,
            'trace'=>1,
            'cache_wsdl'=>WSDL_CACHE_NONE
        );

        $expireDate = $this->formatExpireDate($request->expire_dates);

        try {
            $client = new SoapClient($wsdlurl , $options);
        }catch (\Exception $exception) {
            return response()->json([
                'transaction' => false,
                'exception' => $exception->getMessage()
            ]);
        }

//        $facId = env('FACID');
//        $password = env('FACPASSWORD');
//        $acquirerId = env('ACQUIREID');

        $password = '9mvlOhSg';
        $facId = '88802979';
        $acquirerId = '464748';

        $orderNumber = 'FACPGPROD' . Carbon::now()->timestamp;
        $amount = '000000003502';
        $amount = $this->getCurrencyValue($request->amount);
        $currency = '558';

        $MerchantResponseURL = env('RESPONSE_URL');

        $signature = $this->Sign($password, $facId, $acquirerId, $orderNumber, $amount,$currency);

        // Transaction Details.
        $TransactionDetails = array(
            'AcquirerId' => $acquirerId,
            'Amount' => $amount,
            'Currency' => $currency,
            'CurrencyExponent' => 2,
            'IPAddress' => '',
            'MerchantId' => $facId,
            'OrderNumber' => $orderNumber,
            'Signature' => $signature,
            'SignatureMethod' => 'SHA1',
            'TransactionCode' => '8');

        //Card Detail
        $CardDetails = array(
            'CardCVV2' => $request->cvv,
            'CardExpiryDate' => $expireDate,
            'CardNumber' => $request->card_number,
            'IssueNumber' => '1',
            'StartDate' => '');

        // BillingDetails Details.
        $BillingDetails = array(
            'BillToFirstName' => $request->first_name,
            'BillToLastName' => $request->last_name,
            'BillToMobile' => $request->phone_number,
            'BillToCountry' => $request->country,
            'BillToCity' => $request->city,
        );

        $AuthorizeRequest = array(
            'Request' => array('CardDetails' => $CardDetails,
                'TransactionDetails' => $TransactionDetails,
                'BillingDetails' => $BillingDetails,
                'MerchantResponseURL' => $MerchantResponseURL
            ));

        if($request->card_type === 'visa' || $request->card_type === 'master-card')
        {
            $formattedHtmlForm = '';
            $result = $client->Authorize3Ds($AuthorizeRequest);

            if($result->Authorize3DSResult) {
                if($result->Authorize3DSResult->HTMLFormData) {
                    $htmlFormData =$result->Authorize3DSResult->HTMLFormData;
                    $formattedHtmlForm = str_replace('<HTML>','', $htmlFormData);
                    $formattedHtmlForm = str_replace('<BODY>','', $formattedHtmlForm);
                    $formattedHtmlForm = str_replace('</BODY>','', $formattedHtmlForm);
                    $formattedHtmlForm = str_replace('</HTML>','', $formattedHtmlForm);
                }
            }

            return response()->json([
                'result' =>$result->Authorize3DSResult,
                'htmlForm' => $formattedHtmlForm,
                'transaction3Ds' => true
            ]);
        }else if ($request->card_type === 'amex') {
            $result = $client->Authorize($AuthorizeRequest);

            $reasonCodeDescription = '';
            $reasonCode = '';
            $paddedCardNumber = '';
            if(isset($result->AuthorizeResult) && $result->AuthorizeResult->CreditCardTransactionResults->ReasonCode) {
                $transaction =  true;
                $reasonCodeDescription = $result->AuthorizeResult->CreditCardTransactionResults->ReasonCodeDescription;
                $reasonCode = $result->AuthorizeResult->CreditCardTransactionResults->ReasonCode;
                $paddedCardNumber = $result->AuthorizeResult->CreditCardTransactionResults->PaddedCardNumber;
            }else {
                $transaction =  false;
            }
            return response()->json([
              'result' =>$result->AuthorizeResult->CreditCardTransactionResults,
                'reasonCodeDescription' => $reasonCodeDescription,
                'reasonCode' => $reasonCode,
                'paddedCardNumber' => $paddedCardNumber,
                'transaction' => $transaction
            ]);
        }


//        Visa Card
//        'CardNumber' => '4256677522029246',
//        CardCVV2' => '932',
//        'CardExpiryDate' => '1221',

//        Master Card
//        'CardCVV2' => '489',
//        'CardExpiryDate' => '1224',
//        'CardNumber' => '5470519516810586',

//        Amex
//        'CardCVV2' => '3374',
//        'CardExpiryDate' => '0522',
//        'CardNumber' => '37770164216983',


//        Production
//        $facId = '33303690';
//        $password = '8FADTOpP';
//        $acquirerId = '464748';

//        Test
//        $password = '9mvlOhSg';
//        $facId = '88802979';
//        $acquirerId = '464748';

    }



// Useful for generation of test Order numbers
    function msTimeStamp() {
        return (string)round(microtime(1) * 1000);
    }

    // How to sign a FAC Authorize message
    function Sign($passwd, $facId, $acquirerId, $orderNumber, $amount, $currency) {
        $stringtohash = $passwd.$facId.$acquirerId.$orderNumber.$amount.$currency;
        $hash = sha1($stringtohash, true);
        $signature = base64_encode($hash);
        return $signature;
    }


    public function result (Request $request)
    {
        return view('receipt')->withResult($request->all());
    }

    public function _3DsPayment()
    {

    }

    public function _authorize()
    {

    }
    public function formatExpireDate($date)
    {

        $formattedDate = Carbon::createFromDate($date);
        $month = sprintf("%02d",  $formattedDate->month);
        $year = substr($formattedDate->year, 2);
        return $month.''.$year;
    }

    public function getCurrencyValue($payment) {
        $currency = (object) Http::get('https://free.currconv.com/api/v7/convert?q=NIO_USD&compact=ultra&apiKey=25dc2e30304ce3778287')->json();
        $result = $currency->NIO_USD * $payment;

        $result = str_replace('.','',$result);
        $result = substr($result,0,4);
        return '00000000'.$result;

    }
}
