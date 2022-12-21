@extends('admin.layouts.master')

@section('title','Category List Page')

@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col mb-3">
                    <a href="{{ route('admin#orderList') }}" class=" text-decoration-none text-dark" >
                        <i class="fa-solid fa-left-long me-2"></i>Back
                    </a>
                </div>
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1 me-3">Order's Product List</h2>
                                <span class=" btn btn-outline-dark"><i class="fa-solid fa-database"></i>  - {{count($orderList)}}  </span>
                            </div>

                        </div>
                    </div>

                    <div class=" row col-4">
                        <div class=" card shadow border border-dark rounded">
                            <div class="cart-body text-center mt-2">
                                <h3><i class="fa-solid fa-clipboard me-2"></i>Order Info</h3><hr>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col"><i class="fa-solid fa-user me-2"></i> Name</div>
                                    <div class="col">{{ strtoupper($orderList[0]->user_name) }}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col"><i class="fa-solid fa-barcode me-2"></i>Order Code</div>
                                    <div class="col">{{ $orderList[0]->order_code }}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col"><i class="fa-solid fa-clock me-2"></i>Order Date</div>
                                    <div class="col">{{ $orderList[0]->created_at->format('j-F-Y') }}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col"><i class="fa-solid fa-sack-dollar me-2"></i>Total Price</div>
                                    <div class="col">{{ $order->total_price }} Kyats</div>
                                </div><hr>
                                <span class=" text-danger text-center"><i class="fa-solid fa-triangle-exclamation me-2"></i>Inclute delivery charges</span>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="row">
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
                    </div> --}}

                    {{-- <div class="row">
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
                    </div> --}}

                    <div class="table-responsive table-responsive-data2 mt-3">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Order ID</th>
                                    <th>Product Image</th>
                                    <th>Product Name</th>
                                    <th>Order Date</th>
                                    <th>QTY</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody id="dataList">
                                    @foreach ($orderList as $o)
                                    <tr class="tr-shadow">
                                        <td></td>
                                        <td >{{ $o->id }}</td>
                                        <td class=" col-2"><img src="{{ asset('storage/'.$o->product_image) }}" class=" img-thumbnail"></td>
                                        <td>{{ $o->product_name }}</td>
                                        <td>{{ $o->created_at->format('j-F-Y') }}</td>
                                        <td>{{ $o->qty }}</td>
                                        <td >{{ $o->total }}</td>
                                    </tr>
                                    <tr class="spacer"></tr>
                                    @endforeach
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

