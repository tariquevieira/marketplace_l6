<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserOrder;
use App\User;

class CheckoutController extends Controller
{
    public function index()
    {
    	if(!auth()->check()){
    		return redirect()->route('login');
    	}
    	$this->makePagSeguroSession();
    	session()->get('pagseguro_session_code');
        
        $cartItems = array_map(function($line){
            return $line['amount']*$line['price'];
        }, session()->get('cart'));
        $cartItems = array_sum($cartItems);

    	return view('checkout', compact('cartItems'));
    }

    public function proccess(Request $request)
    {
        try{
        $dataPost = $request->all();
        $user = auth()->user();
        $cartItems = session()->get('cart');
        $stores = array_unique(array_column($cartItems, 'store_id'));
        $reference = 'XPTO';

        $creditCardPayment = new \App\Payment\PagSeguro\CreditCard($cartItems,$user,$dataPost,$reference);
        
        $result = $creditCardPayment->doPayment();
        
        $userOrder = [
            'reference' => $reference,
            'pagseguro_code' => $result->getCode(),
            'pagseguro_status' => $result->getStatus(),
            'items' => serialize($cartItems),
            'store_id' => 5
         ];



        $userOrder=$user->orders()->create($userOrder);
        $userOrder->stores()->sync($stores);

        //notificar loja de novo pedido
        $store = (new Store())->notifyStoreOwners($stores);

        session()->forget('cart');
        session()->forget('pagseguro_session_code');


         return response()->json([
            'data' => [
                'status'=> true,
                'message' => 'Pedido criado com sucesso!',
                'order' => $reference
            ]
         ]);
     }catch(\Exception $e){

        $message = env('APP_DEBUG')?$e->getMessage() : 'Erro ao processar pedido!';
        return response()->json([
            'data' => [
                'status'=> false,
                'message' => $message
            ]
         ],401);
     }

}   
    public function thanks()
    {
        return view('thanks');
    }

    private function makePagSeguroSession()
    {

    	if(!session()->has('pagseguro_session_code')){

    	 $sessionCode = \PagSeguro\Services\Session::create(
    	
        \PagSeguro\Configuration\Configure::getAccountCredentials());

    	  return session()->put('pagseguro_session_code',$sessionCode->getResult());

    	 }      
    }
}
