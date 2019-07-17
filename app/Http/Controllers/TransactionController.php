<?php

namespace App\Http\Controllers;


use App\Notifications\Invoice;
use App\Premium;
use App\Transaction;
use App\User;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Faker\Provider\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::with('user','premium')->paginate(10);
        return response()->json([
            'transactions' => $transactions
        ]);
    }

    public function getHistoryTransaction(Request $request){
        $user = $request->user;
        $transactions = Transaction::with('user','premium')->where('user_id',$user->id)->where('premium_status',0)->paginate(10);
        return response()->json([
            'transactions' => $transactions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::where('id',$request->user_id)->first();
        $transaction= Transaction::where('user_id',$request->user_id)->where('premium_status',1)->first();
        $premium = Premium::where('id',$request->premium_id)->first();
        if(is_null($transaction)||$this->checkPremiumValidDate($transaction)){
            $transaction = new Transaction();
            $transaction->id = Uuid::uuid();
            $transaction->user_id = $request->user_id;
            $transaction->premium_id = $request->premium_id;
            $transaction->start_date = Carbon::now();
            $transaction->end_date = Carbon::parse($transaction->start_date)->addDays($premium->duration);
            $transaction->premium_status = 1;
            $data =  array(
                'invoice_id'=>$transaction->id,
                'name' => $premium->name,
                'price'=> $premium->price,
                'duration'=>$premium->duration,
                'start_date'=>date("D,d F Y", strtotime($transaction->start_date)),
                'end_date' => date("D,d F Y", strtotime($transaction->end_date)),
                'user_name' =>$user->name,
            );
            $email_destination = $user->email;
            $user->notify(new Invoice($data));
            $transaction->save();
            return response()->json([
                'message' => 'Success, Check your Email',
                'status'=>'Success',
                'transaction' => $transaction
            ]);
        }
        return response()->json([
            'message'=>'You are already premiums owner'
        ]);
    }
    public function checkPremiumValidDate($transaction){
        if($transaction->end_date < Carbon::now()){
            $transaction->premium_status = 0;
            $transaction->save();
            return true;
        }
        return false;
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
