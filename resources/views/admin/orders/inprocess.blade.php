@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            Orders
        </div>

        <div class="card-body">
    <div class="col-12">
        <div class="card card-primary card-tabs">
            <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">

                    <li class="nav-item">
                        <a class="nav-link active" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">In Delivery Process</a>
                    </li>

                </ul>
            </div>
            <div class="card-body">
                <table border="0" cellspacing="5" cellpadding="5">
                    <tbody>
                    <tr>
                        <td>Created Minimum Date:</td>
                        <td><input name="min" id="min" type="text"></td>
                        <td>Created Maximum Date:</td>
                        <td><input name="max" id="max" type="text"></td>
                    </tr>
                    <tr>
                        <td>Minimum Amount:</td>
                        <td><input name="minAmount" id="minAmount" type="number"></td>
                        <td>Maximum Amount:</td>
                        <td><input name="maxAmount" id="maxAmount" type="number"></td>
                    </tr>
                    </tbody>
                </table>
                <div class="tab-content" id="custom-tabs-one-tabContent">


                        <div class="table-responsive">
                            <table class=" table table-bordered table-striped table-hover datatable">
                                <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        Invoice No
                                    </th>
                                    <th>
                                        SubTotal
                                    </th>
                                    <th>
                                        Discount
                                    </th>
                                    <th>
                                        Delivery Charge
                                    </th>
                                    <th>
                                        Grinding Charge
                                    </th>
                                    <td>
                                        Tax
                                    </td>
                                    <th>
                                        Total Amount
                                    </th>
                                    <th>
                                        Customer Name
                                    </th>
                                    <th>
                                        Coupon Applied
                                    </th>
                                    <th>
                                        Created At
                                    </th>
                                    <th>
                                        Action
                                    </th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $key => $order)
                                    @if($order->payment_status=='paid' && $order->order_status_id==3)
                                        <tr>
                                            <td></td>
                                            <td>{{$order->Invoice_No}}</td>
                                            <td>{{$order->sub_total}}</td>
                                            <td>{{$order->discount}}</td>
                                            <td>{{$order->delivery_charge}}</td>
                                            <td>{{$order->grinding_charge}}</td>
                                            <td>{{$order->tax}}</td>
                                            <td>{{$order->total_amount}}</td>
                                            <th>{{$order->customer->name}}</th>
                                            <th ><span class="badge badge-success">{{$order->couponDetails!==null?$order->couponDetails->code:''}}</span></th>
                                            <td>{{$order->created_at}}</td>
                                            <td>
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.orders.show', $order->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            </td>
                                        </tr>
                                    @endif

                                @endforeach
                                </tbody>
                            </table>
                        </div>


                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
    </div>

@endsection

        @section('scripts')
            @parent
            <script>

                $(function () {
                    {{--let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'--}}
                    {{--let deleteButton = {--}}
                    {{--    text: deleteButtonTrans,--}}
                    {{--    url: "{{ route('admin.permissions.massDestroy') }}",--}}
                    {{--    className: 'btn-danger',--}}
                    {{--    action: function (e, dt, node, config) {--}}
                    {{--        var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {--}}
                    {{--            return $(entry).data('entry-id')--}}
                    {{--        });--}}

                    {{--        if (ids.length === 0) {--}}
                    {{--            alert('{{ trans('global.datatables.zero_selected') }}')--}}

                    {{--            return--}}
                    {{--        }--}}

                    {{--        if (confirm('{{ trans('global.areYouSure') }}')) {--}}
                    {{--            $.ajax({--}}
                    {{--                headers: {'x-csrf-token': _token},--}}
                    {{--                method: 'POST',--}}
                    {{--                url: config.url,--}}
                    {{--                data: { ids: ids, _method: 'DELETE' }})--}}
                    {{--                .done(function () { location.reload() })--}}
                    {{--        }--}}
                    {{--    }--}}
                    {{--}--}}
                    let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
                    {{--@can('permission_delete')--}}
                    {{--dtButtons.push(deleteButton)--}}
                    {{--@endcan--}}

                    $('.datatable:not(.ajaxTable)').DataTable({ buttons: dtButtons })
                })

            </script>
@endsection
