@extends('admin.layouts.master')

@section('title','Category List Page')

@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1 me-3">Order List</h2>
                                <span class=" btn btn-outline-dark"><i class="fa-solid fa-database"></i>  - {{count($order)}}  </span>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="input-group mb-3 col">
                            <form action="{{ route('admin#changeStatus') }}" method="GET" class="d-flex col-3">
                                @csrf
                                <select class="form-select" id="inputGroupSelect02" name="orderStatus">
                                    <option value="">All</option>
                                    <option value="0" @if (request('orderStatus') == '0')
                                        selected
                                    @endif>Pending</option>
                                    <option value="1" @if (request('orderStatus') == '1')
                                        selected
                                    @endif>Accept</option>
                                    <option value="2" @if (request('orderStatus') == '2')
                                        selected
                                    @endif>Reject</option>
                                </select>
                                <label class="input-group-text bg-dark" for="inputGroupSelect02"><button class="btn btn-sm  text-white" type="submit">Search</button></label>
                            </form>
                        </div>
                    </div>

                    <div class="row">
                        <div class=" col-3">
                            <h5 class=" text-secondary">Search Key : <span class="text-danger">{{ request('key') }}</span></h5>
                        </div>
                        <div class="col-3 offset-6">
                            <form action="{{ route('admin#orderList') }}" method="GET">
                                <div class="d-flex">
                                    <input type="text" class=" form-control" placeholder="search" name="key" value="{{ request('key') }}">
                                    <button class=" btn btn-dark text-white" type="submit">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="table-responsive table-responsive-data2 mt-3">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>User ID</th>
                                    <th>User Name</th>
                                    <th>Order Date</th>
                                    <th>Order Code</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="dataList">
                                <tr class="tr-shadow">
                                    @foreach ($order as $o)
                                    <tr class="tr-shadow">
                                        <input type="hidden" class="orderId" value="{{ $o->id }}">
                                        <td >{{ $o->user_id }}</td>
                                        <td >{{ $o->user_name }}</td>
                                        <td >{{ $o->created_at->format('F-j-Y') }}</td>
                                        <td ><a href="{{ route('admin#listInfo',$o->order_code) }}">{{ $o->order_code }}</a></td>
                                        <td class="amount">{{ $o->total_price }}Kyats</td>
                                        <td >
                                            <select name="status" class=" form-control statusChange">
                                                <option value="0" @if ($o->status == 0)  selected @endif>Pending</option>
                                                <option value="1" @if ($o->status == 1)  selected @endif>Accept</option>
                                                <option value="2" @if ($o->status == 2)  selected @endif>Reject</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr class="spacer"></tr>
                                    @endforeach
                                </tr>
                                <tr class="spacer"></tr>


                            </tbody>
                        </table>
                        {{-- <div class="mt-3"> --}}
                            {{-- {{$order->links()}} --}}
                        {{-- </div> --}}
                    </div>
                    {{-- @else
                    <h3 class=" text-secondary text-center mt-5">There is no Pizza list here</h3>
                    @endif
                    <!-- END DATA TABLE --> --}}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scriptSection')

<script>
    $(document).ready(function(){
    //     $('#orderStatus').change(function(){
    //         $status = $('#orderStatus').val();

    //         $.ajax({
    //             type : 'get',
    //             url : 'http://localhost:8000/order/ajax/status',
    //             data : {'status' : $status},
    //             dataType : 'json',
    //             success : function(response){
    //                 $list = '';
    //                 for($i=0;$i<response.length;$i++){

    //                     //for date
    //                     $month = ['January','February','March','April','May','June','July','August','September','October','November','December'];
    //                     $dbDate = new Date(response[$i].created_at);
    //                     $finalDate = $month[$dbDate.getMonth()] + '-' + $dbDate.getDate() + '-' + $dbDate.getFullYear();

    //                     //for status
    //                     if(response[$i].status == 0){
    //                         $statusMessage = `
    //                         <select name="status" id="" class=" form-control statusChange">
    //                             <option value="0" selected>Pending</option>
    //                             <option value="1" >Accept</option>
    //                             <option value="2" >Reject</option>
    //                         </select>
    //                         `;
    //                     }else if(response[$i].status == 1){
    //                         $statusMessage = `
    //                         <select name="status" id="" class=" form-control statusChange">
    //                             <option value="0" >Pending</option>
    //                             <option value="1" selected>Accept</option>
    //                             <option value="2" >Reject</option>
    //                         </select>
    //                         `;
    //                     }else if(response[$i].status == 2){
    //                         $statusMessage = `
    //                         <select name="status" id="" class=" form-control statusChange">
    //                             <option value="0" >Pending</option>
    //                             <option value="1" >Accept</option>
    //                             <option value="2" selected>Reject</option>
    //                         </select>
    //                         `;
    //                     }

    //                     $list += `
    //                     <tr class="tr-shadow">
    //                         <input type="hidden" class="orderId" value="${response[$i].id}">
    //                         <td > ${response[$i].user_id} </td>
    //                         <td > ${response[$i].user_name} </td>
    //                         <td > ${$finalDate} </td>
    //                         <td > ${response[$i].order_code} </td>
    //                         <td > ${response[$i].total_price} Kyats</td>
    //                         <td >
    //                             ${$statusMessage}
    //                         </td>
    //                     </tr>
    //                     <tr class="spacer"></tr>
    //                     `;
    //                 }
    //                 $('#dataList').html($list);
    //             }
    //         })
    //     })
    //     //change Status
        $('.statusChange').change(function(){
            $currentStatus = $(this).val();
            $parentNode = $(this).parents("tr");
            $orderId = $parentNode.find('.orderId').val();
            $data = {
                'status' : $currentStatus,
                'orderId' : $orderId
            }

            $.ajax({
                type : 'get',
                url : 'http://localhost:8000/order/ajax/change/status',
                data : $data,
                dataType : 'json',
            })
            location.reload();
        })
    })
</script>

@endsection
