<?php

namespace App\Http\Controllers;

use App\Models\HoldingAccountWitdraw;
use App\Models\Transaction;
use App\Models\WithdrawRequest;
use App\Notifications\ApprovedWithdrawRequest;
use App\Notifications\RejectWithdrawRequest;
use DataTables;
use DB;
use Illuminate\Http\Request;

class HoldingAccountWitdrawController extends Controller
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
        return view('backend.holding_account_witdraws.list');
    }

    public function get_table_data(Request $request) {

        $holding_account_witdraws = HoldingAccountWitdraw::select('holding_account_witdraws.*')
            ->with('user')
            ->with('method')
            ->with('method.currency')
            ->orderBy("holding_account_witdraws.id", "desc");

        return Datatables::eloquent($holding_account_witdraws)
            ->filter(function ($query) use ($request) {
                $status = $request->has('status') ? $request->status : 1;
                $query->where('status', $status);
            }, true)
            ->editColumn('user.name', function ($holding_account_witdraw) {
                return '<b>' . $holding_account_witdraw->user->name . ' </b><br>' . $holding_account_witdraw->user->email;
            })
            ->editColumn('amount', function ($holding_account_witdraw) {
                return decimalPlace($holding_account_witdraw->amount, currency($holding_account_witdraw->method->currency->name));
            })
            ->editColumn('status', function ($holding_account_witdraw) {
                return transaction_status($holding_account_witdraw->status);
            })
            ->addColumn('action', function ($holding_account_witdraw) {
                $actions = '<form action="' . action('WithdrawRequestController@destroy', $holding_account_witdraw['id']) . '" class="text-center" method="post">';
                $actions .= '<a href="' . action('WithdrawRequestController@show', $holding_account_witdraw['id']) . '" data-title="' . _lang('Withdraw Request') . '" class="btn btn-outline-primary btn-sm ajax-modal"><i class="icofont-eye-alt"></i> ' . _lang('Details') . '</a>&nbsp;';
                $actions .= $holding_account_witdraw->status != 2 ? '<a href="' . action('WithdrawRequestController@approve', $holding_account_witdraw['id']) . '" class="btn btn-outline-success btn-sm"><i class="icofont-check-circled"></i> ' . _lang('Approve') . '</a>&nbsp;' : '';
                $actions .= $holding_account_witdraw->status != 0 ? '<a href="' . action('WithdrawRequestController@reject', $holding_account_witdraw['id']) . '" class="btn btn-outline-warning btn-sm"><i class="icofont-close-circled"></i> ' . _lang('Reject') . '</a>&nbsp;' : '';
                $actions .= csrf_field();
                $actions .= '<input name="_method" type="hidden" value="DELETE">';
                $actions .= '<button class="btn btn-outline-danger btn-sm btn-remove" type="submit"><i class="icofont-trash"></i> ' . _lang('Delete') . '</button>';
                $actions .= '</form>';

                return $actions;

            })
            ->setRowId(function ($holding_account_witdraw) {
                return "row_" . $holding_account_witdraw->id;
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
        $holdingAccountWitdraw = HoldingAccountWitdraw::find($id);
        if (!$request->ajax()) {
            return back();
        } else {
            return view('backend.withdraw_request.modal.view', compact('holdingAccountWitdraw', 'id'));
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

        $holdingAccountWitdraw         = HoldingAccountWitdraw::find($id);
        $holdingAccountWitdraw->status = 2;
        $holdingAccountWitdraw->save();

        $transaction         = Transaction::find($holdingAccountWitdraw->transaction_id);
        $transaction->status = 2;
        $transaction->save();

        try {
            $transaction->user->notify(new ApprovedWithdrawRequest($transaction));
        } catch (\Exception$e) {}

        DB::commit();
        return redirect()->route('withdraw_requests.index')->with('success', _lang('Request Approved'));
    }

    /**
     * Reject Wire Transfer
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function reject($id) {
        DB::beginTransaction();
        $holdingAccountWitdraw = HoldingAccountWitdraw::find($id);

        $transaction         = Transaction::find($holdingAccountWitdraw->transaction_id);
        $transaction->status = 0;
        $transaction->save();

        $holdingAccountWitdraw->status = 0;
        $holdingAccountWitdraw->save();

        try {
            $transaction->user->notify(new RejectWithdrawRequest($transaction));
        } catch (\Exception$e) {}

        DB::commit();
        return redirect()->route('withdraw_requests.index')->with('success', _lang('Request Rejected'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $holdingAccountWitdraw = HoldingAccountWitdraw::find($id);
        if ($holdingAccountWitdraw->transaction_id != null) {
            $transaction = Transaction::find($holdingAccountWitdraw->transaction_id);
            $transaction->delete();
        }
        $holdingAccountWitdraw->delete();
        return redirect()->route('deposit_requests.index')->with('success', _lang('Deleted Successfully'));
    }
}
