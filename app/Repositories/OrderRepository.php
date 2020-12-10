<?php
namespace App\Repositories;
use GuzzleHttp\Client;

class OrderRepository {
    public function  getChargeRequest($amount,$name,$email,$number)
    {
    $client=new Client([
       'base_uri'=>'https://api.tap.company/v2/charges',
       'timeout'=>30.0,
    ]);

    $headers=[
      'Accept'=>'application/json',
      'Authorization'=>'Bearer sk_test_XKokBfNWv6FIYuTMg5sLPjhJ'
    ];

    $response=$client->request('POST','charges',[
        'headers'=>$headers,
       'form_params'=>['amount'=>10,
           'currency'=>'KWD',
           'customer'=>[
               'first_name'=>'Ahmed',
               'email'=>'ahmed@gmail.com',
               'phone'=>[
                   'country_code'=>'965',
                   'number'=>'12345678'
               ]
           ],
           'source'=>['id'=>'src_kw.knet'],
           'redirect'=>['url'=>'http://your_website.com/redirect_url']

       ]
    ]);

    return json_decode($response->getBody(),true);


    }
}

?>
