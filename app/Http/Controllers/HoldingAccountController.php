<?php

namespace App\Http\Controllers;

use App\Models\HoldingAccount;
use Illuminate\Http\Request;
use App\Models\DepositRequest;
use App\Models\Transaction;
use App\Notifications\ApprovedHoldingAccount;
use App\Notifications\RejectHoldingAccount;
use DataTables;
use DB;

class HoldingAccountController extends Controller
{
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
        return view('backend.holding_account.list');
    }

    public function get_table_data(Request $request) {

        $holding_accounts = HoldingAccount::select('holding_accounts.*')
            ->with('user')
            ->with('method')
            ->with('currency')
            ->orderBy("holding_accounts.id", "desc");

        return Datatables::eloquent($holding_accounts)
            ->filter(function ($query) use ($request) {
                $status = $request->has('status') ? $request->status : 1;
                $query->where('status', $status);
            }, true)
            ->editColumn('user.name', function ($holding_account) {
                return '<b>' . $holding_account->user->name . ' </b><br>' . $holding_account->user->email;
            })
            ->editColumn('amount', function ($holding_account) {
                return decimalPlace($holding_account->amount, currency($holding_account->currency->name));
            })
            ->editColumn('status', function ($holding_account) {
                return transaction_status($holding_account->status);
            })
            ->addColumn('action', function ($holding_account) {
                $actions = '<form action="' . action('HoldingAccountController@destroy', $holding_account['id']) . '" class="text-center" method="post">';
                $actions .= '<a href="' . action('HoldingAccountController@show', $holding_account['id']) . '" data-title="' . _lang('Deposit Request') . '" class="btn btn-outline-primary btn-sm ajax-modal"><i class="icofont-eye-alt"></i> ' . _lang('Details') . '</a>&nbsp;';
                $actions .= $holding_account->status != 2 ? '<a href="' . action('HoldingAccountController@approve', $holding_account['id']) . '" class="btn btn-outline-success btn-sm"><i class="icofont-check-circled"></i> ' . _lang('Approve') . '</a>&nbsp;' : '';
                $actions .= $holding_account->status != 0 ? '<a href="' . action('HoldingAccountController@reject', $holding_account['id']) . '" class="btn btn-outline-warning btn-sm"><i class="icofont-close-circled"></i> ' . _lang('Reject') . '</a>&nbsp;' : '';
                $actions .= csrf_field();
                $actions .= '<input name="_method" type="hidden" value="DELETE">';
                $actions .= '<button class="btn btn-outline-danger btn-sm btn-remove" type="submit"><i class="icofont-trash"></i> ' . _lang('Delete') . '</button>';
                $actions .= '</form>';

                return $actions;

            })
            ->setRowId(function ($holding_account) {
                return "row_" . $holding_account->id;
            })
            ->rawColumns(['user.name', 'status', 'action'])
            ->make(true);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id) {
        $holdingAccount = HoldingAccount::find($id);
        if (!$request->ajax()) {
            return back();
        } else {
            return view('backend.holding_account.modal.view', compact('holdingAccount', 'id'));
        }

    }

    /**
     * Approve Wire Transfer
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function approve($id) {
        DB::beginTransaction();

        $holdingAccount = HoldingAccount::find($id);

        //Charge
        // $charge = $holdingAccount->method->fixed_charge;
        // $charge += ($holdingAccount->method->charge_in_percentage / 100) * $holdingAccount->amount;

        //Create Transaction
        $transaction                  = new Transaction();
        $transaction->user_id         = $holdingAccount->user_id;
        $transaction->currency_id     = $holdingAccount->currency_id;
        $transaction->amount          = $holdingAccount->amount;
        // $transaction->amount          = $holdingAccount->amount - $charge;
        // $transaction->fee             = $charge;
        $transaction->dr_cr           = 'cr';
        $transaction->type            = 'Deposit';
        $transaction->method          = $holdingAccount->method;
        $transaction->status          = 2;
        $transaction->note            = _lang('Deposit Via') . ' ' . $holdingAccount->method;
        $transaction->created_user_id = auth()->id();
        $transaction->branch_id       = auth()->user()->branch_id;

        $transaction->save();

        $holdingAccount->status         = 2;
        $holdingAccount->transaction_id = $transaction->id;
        $holdingAccount->save();

        try {
            $transaction->user->notify(new ApprovedHoldingAccount($transaction));
        } catch (\Exception$e) {}

        DB::commit();
        return redirect()->route('holding_accounts.index')->with('success', _lang('Request Approved'));
    }

    /**
     * Reject Wire Transfer
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function reject($id) {
        DB::beginTransaction();
        $holdingAccount = HoldingAccount::find($id);

        if ($holdingAccount->transaction_id != null) {
            $transaction = Transaction::find($holdingAccount->transaction_id);
            $transaction->delete();
        }

        $holdingAccount->status         = 0;
        $holdingAccount->transaction_id = null;
        $holdingAccount->save();

        DB::commit();

        try {
            $holdingAccount->user->notify(new RejectHoldingAccount($holdingAccount));
        } catch (\Exception$e) {}

        return redirect()->route('holding_accounts.index')->with('success', _lang('Request Rejected'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $holdingAccount = holdingAccount::find($id);
        if ($holdingAccount->transaction_id != null) {
            $transaction = Transaction::find($holdingAccount->transaction_id);
            $transaction->delete();
        }
        $holdingAccount->delete();
        return redirect()->route('holding_accounts.index')->with('success', _lang('Deleted Successfully'));
    }
}
