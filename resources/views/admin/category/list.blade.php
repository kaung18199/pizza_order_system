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
                                <h2 class="title-1">Category List
                                    <span class=" btn btn-outline-dark ms-2"><i class="fa-solid fa-database"></i>  - {{ $categories->total() }} </span>
                                </h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ route('category#createPage') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>add Category
                                </button>
                            </a>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button>
                        </div>
                    </div>

                    <div class="row">
                        <div class=" col-3">
                            <h5 class=" text-secondary">Search Key : <span class="text-danger">{{ request('key') }}</span></h5>
                        </div>
                        <div class="col-3 offset-6">
                            <form action="{{ route('category#list') }}" method="GET">
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
                            <h3><i class="fa-solid fa-database"></i>  - {{ $categories->total() }} </h3>
                        </div>
                    </div> --}}

                    @if (session('createSuccess'))
                        <div class="col-4 offset-8 mt-2">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-circle-check"></i> {{session('createSuccess')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                    @if (session('deleteSuccess'))
                        <div class="col-4 offset-8 mt-2">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-circle-xmark"></i> {{session('deleteSuccess')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                    @if (session('changeSuccess'))
                        <div class="col-4 offset-8 mt-2">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-circle-check"></i> {{session('changeSuccess')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                    @if ( count($categories) != 0 )
                        <div class="table-responsive table-responsive-data2 mt-3">
                            <table class="table table-data2 text-center">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category Name</th>
                                        <th>Created Date</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                    <tr class="tr-shadow">
                                        <td>{{ $category->id }}</td>
                                        <td class="col-6">
                                            <span class="block-email ">{{ $category->name }}</span>
                                        </td>
                                        <td>{{ $category->created_at->format('j-F-Y')}}</td>
                                        <td>
                                            <div class="table-data-feature">
                                                <a href="{{ route('category#edit',$category->id) }}">
                                                    <button class="item me-2" data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </button>
                                                </a>
                                                <a href="{{ route('category#delete',$category->id) }}">
                                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                        <i class="fa-solid fa-trash-can"></i>
                                                    </button>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="spacer"></tr>
                                    @endforeach

                                </tbody>
                            </table>
                            <div class=" mt-3">
                                {{$categories->appends(request()->query())->links()}}
                            </div>
                        </div>
                    @else
                        <h3 class=" text-secondary text-center mt-5">There is no Categories here</h3>
                    @endif
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
@endsection
