<?php

namespace App\Http\Controllers;
use App\Models\BankTransaction;
use App\Models\User;
use DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class BankTransactionController extends Controller
{
    //
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        date_default_timezone_set(get_option('timezone', 'Asia/Dhaka'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $bank_transactions = BankTransaction::all()->sortByDesc("id");
        return view('backend.bank_transaction.list', compact('bank_transactions'));
        return view('');
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {
        if (!$request->ajax()) {
            return view('backend.bank_transaction.create');
        } else {
            return view('backend.bank_transaction.modal.create');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        @ini_set('max_execution_time', 0);
        @set_time_limit(0);

        $validator = Validator::make($request->all(), [
            // 'account_number'    => 'required',
            'currency_id'       => 'required',
            'amount'            => 'required|numeric|min:1.00',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
            } else {
                return back()->withErrors($validator)->withInput();
            }
        }

        // $deposit_method = DepositMethod::find(1);

        $BankTransaction                  = new BankTransaction();
        $BankTransaction->currency_id     = $request->input('currency_id');
        $BankTransaction->amount          = $request->input('amount');
        $BankTransaction->note            = $request->input('note');
        $BankTransaction->branch_id       = $request->branch_id;
        $BankTransaction->created_user_id = auth()->id();

        $BankTransaction->save();

        // dd($transaction);

        // try {
        // $transaction->user->notify(new DepositMoney($transaction));
        // } catch (\Exception $e) {}

        if (!$request->ajax()) {
            return back()->with('success', _lang('Money sent successfully'));
        } else {
            return response()->json(['result' => 'success', 'action' => 'store', 'message' => _lang('Money sent successfully'), 'data' => $BankTransaction, 'table' => '#BankTransactions_table']);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $BankTransaction = BankTransaction::find($id);
        $BankTransaction->delete();
        return redirect()->route('bankTransaction.index')->with('success', _lang('Deleted Successfully'));
    }

}
