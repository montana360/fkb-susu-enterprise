@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card no-export">
            <div class="card-header">
                <span class="panel-title">{{ _lang('Bank Transaction') }}</span>
                <a class="btn btn-primary btn-sm float-right ajax-modal" data-title="{{ _lang('Add Transactions') }}" href="{{ route('bankTransaction.create') }}"><i class="icofont-plus-circle"></i> {{ _lang('Add Transaction') }}</a>
            </div>
            <div class="card-body">
                <table id="products_table" class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th>{{_lang('Branch')}}</th>
                            <th>{{_lang('Currency')}}</th>
                            <th>{{_lang('Amount')}}</th>
                            <th>{{_lang('Created By')}}</th>
                            <th>{{_lang('Created At')}}</th>
                            <th class="text-center">{{ _lang('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bank_transactions as $btr)
                        <tr data-id="row_{{ $btr->id }}">
                            <td class='name'>{{ $btr->name }}</td>

                            <td class="text-center">
                                <span class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{ _lang('Action') }}
                                    </button>
                                    <form action="{{ action('BankTransactionController@destroy', $btr['id']) }}" method="post">
                                        {{ csrf_field() }}
                                        <input name="_method" type="hidden" value="DELETE">

                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <button class="btn-remove dropdown-item" type="submit"><i class="icofont-trash"></i> {{ _lang('Delete') }}</button>
                                        </div>
                                    </form>
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection