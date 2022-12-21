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
                                <h2 class="title-1">User List
                                    <span class=" btn btn-outline-dark"><i class="fa-solid fa-database"></i>  - {{ $users->total() }}</span>
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

                    <div class="row mb-3">
                        <div class=" col-3">
                            <h5 class=" text-secondary">Search Key : <span class="text-danger">{{ request('key') }}</span></h5>
                        </div>
                        <div class="col-3 offset-6">
                            <form action="{{ route('admin#userList') }}" method="GET">
                                <div class="d-flex">
                                    <input type="text" class=" form-control" placeholder="search" name="key" value="{{ request('key') }}">
                                    <button class=" btn btn-dark text-white" type="submit">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    @if (session('deleteSuccess'))
                        <div class="col-4 offset-8">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-circle-check"></i> {{session('deleteSuccess')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    {{-- <div class="row my-2">
                        <div class="col-1 offset-10 mt-3 btn btn-outline-primary text-center">
                            <h3><i class="fa-solid fa-database"></i>  - {{ $admin->total() }}</h3>
                        </div>
                    </div> --}}
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
                                        <th>Role</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $u)
                                    <tr>
                                        <td class=" col-2">
                                            @if ($u->image == null)
                                                @if ($u->gender == 'male')
                                                <img src="{{ asset('image/dafault_user.jpg') }}" alt="" class=" img-thumbnail shadow-sm w-75">
                                                @else
                                                <img src="{{ asset('image/dafault_female_user.jpg') }}" alt="" class=" img-thumbnail shadow-sm w-75">
                                                @endif
                                            @else
                                            <img src="{{ asset('storage/'.$u->image) }}" alt="" class=" img-thumbnail shadow-sm w-75">
                                            @endif
                                        </td>
                                        <input type="hidden" name="" class="userId" value="{{ $u->id }}">
                                        <td>{{ $u->name }}</td>
                                        <td>{{ $u->email }}</td>
                                        <td>{{ $u->gender }}</td>
                                        <td>{{ $u->phone }}</td>
                                        <td>{{ $u->address }}</td>
                                        <td>
                                            <select name="" id="" class="changeStatus">
                                                <option value="user" @if ($u->role == 'user') selected @endif>User</option>
                                                <option value="admin" @if ($u->role == 'admin') selected @endif>Admin</option>
                                            </select>
                                        </td>
                                        <td><a href="{{ route('admin#userDelete',$u->id) }}" class=" text-decoration-none"><button class=" btn-sm bg-dark text-white">Block</button></a></td>
                                    </tr>
                                    <tr class="spacer"></tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class=" mt-3">
                                {{$users->appends(request()->query())->links()}}
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
            $('.changeStatus').change(function(){
                $currentStatus = $(this).val();
                console.log($currentStatus);

                $parentNode = $(this).parents('tr');
                $userId = $parentNode.find('.userId').val();

                $data = {
                    'status' : $currentStatus,
                    'userId' : $userId,
                };

                $.ajax({
                    type : 'get',
                    url : 'http://localhost:8000/user/change/role',
                    data : $data,
                    dataType : 'json',
                })
                location.reload();
            })
        })
    </script>
@endsection


