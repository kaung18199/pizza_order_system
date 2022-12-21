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
                                <h2 class="title-1">Admin List
                                    <span class=" btn btn-outline-dark"><i class="fa-solid fa-database"></i>  - {{ $admin->total() }}</span>
                                </h2>
                            </div>
                        </div>
                        {{-- <div class="table-data__tool-right">
                            <a href="{{ route('category#createPage') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>add Category
                                </button>
                            </a>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button>
                        </div> --}}
                    </div>

                    <div class="row">
                        <div class=" col-3">
                            <h5 class=" text-secondary">Search Key : <span class="text-danger">{{ request('key') }}</span></h5>
                        </div>
                        <div class="col-3 offset-6">
                            <form action="{{ route('admin#list') }}" method="GET">
                                <div class="d-flex">
                                    <input type="text" class=" form-control" placeholder="search" name="key" value="{{ request('key') }}">
                                    <button class=" btn btn-dark text-white" type="submit">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- <div class="row my-2">
                        <div class="col-1 offset-10 mt-3 btn btn-outline-primary text-center">
                            <h3><i class="fa-solid fa-database"></i>  - {{ $admin->total() }}</h3>
                        </div>
                    </div> --}}

                    @if (session('createSuccess'))
                        <div class="col-4 offset-8">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-circle-check"></i> {{session('createSuccess')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                    @if (session('deleteSuccess'))
                        <div class="col-4 offset-8">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-circle-xmark"></i> {{session('deleteSuccess')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                    @if (session('changeSuccess'))
                        <div class="col-4 offset-8">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-circle-check"></i> {{session('changeSuccess')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                    {{-- @if ( count($categories) != 0 ) --}}
                        <div class="table-responsive table-responsive-data2 mt-3">
                            <table class="table table-data2 text-center">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Gender</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($admin as $a)
                                    <tr class="tr-shadow">
                                        <td class=" col-2">
                                            @if ($a->image == null)
                                                @if ($a->gender == 'male')
                                                <img src="{{ asset('image/dafault_user.jpg') }}" alt="" class=" img-thumbnail shadow-sm w-75">
                                                @else
                                                <img src="{{ asset('image/dafault_female_user.jpg') }}" alt="" class=" img-thumbnail shadow-sm w-75">
                                                @endif
                                            @else
                                            <img src="{{ asset('storage/'.$a->image) }}" alt="" class=" img-thumbnail shadow-sm w-75">
                                            @endif
                                        </td>
                                        <input type="hidden" name="" class="userId" value="{{ $a->id }}">
                                        <td>{{ $a->name }}</td>
                                        <td>{{ $a->email }}</td>
                                        <td>{{ $a->gender }}</td>
                                        <td>{{ $a->phone }}</td>
                                        <td>{{ $a->address }}</td>
                                        <td>
                                            <div class="table-data-feature">

                                                    @if (Auth::user()->id == $a->id)

                                                    @else
                                                        {{-- <a href="{{ route('admin#changeRole',$a->id) }}">
                                                            <button class="item me-2" data-toggle="tooltip" data-placement="top" title="Change Admin Role">
                                                                <i class="fa-solid fa-arrow-right-arrow-left"></i>
                                                            </button>
                                                        </a> --}}
                                                        <select name="" id="" class="  me-4 changeUser">
                                                            <option value="admin" selected>Admin</option>
                                                            <option value="user">user</option>
                                                        </select>

                                                        <a href="{{ route('admin#delete',$a->id) }}">
                                                            <button class="item me-2" data-toggle="tooltip" data-placement="top" title="Delete">
                                                                <i class="fa-solid fa-trash-can"></i>
                                                            </button>
                                                        </a>
                                                    @endif

                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="spacer"></tr>
                                    @endforeach

                                </tbody>
                            </table>
                            <div class=" mt-3">
                                {{$admin->appends(request()->query())->links()}}
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scriptSection')
    <script>
        $(document).ready(function(){
            $('.changeUser').change(function(){
                $currentStatus = $(this).val();

                $parentNode = $(this).parents('tr');
                $userId = $parentNode.find('.userId').val();

                $data = {
                    'status' : $currentStatus,
                    'userId' : $userId,
                };

                $.ajax({
                    type : 'get',
                    url : 'http://localhost:8000/admin/ajax/change/user',
                    data : $data,
                    dataType : 'json',
                })
                location.reload();
            })
        })
    </script>
@endsection
