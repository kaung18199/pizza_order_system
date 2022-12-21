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
                                <h2 class="title-1">Contact List
                                    <span class=" btn btn-outline-dark"><i class="fa-solid fa-database"></i>  - {{ $contact->total() }}</span>
                                </h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @if (session('delete'))
                        <div class="col-4 offset-8">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-circle-check"></i> {{session('delete')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="row mb-3">
                        <div class=" col-3">
                            <h5 class=" text-secondary">Search Key : <span class="text-danger">{{ request('key') }}</span></h5>
                        </div>
                        <div class="col-3 offset-6">
                            <form action="{{ route('admin#contactList') }}" method="GET">
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
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Message</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($contact as $c)
                                    <tr>
                                        <td>{{ $c->name}}</td>
                                        <td>{{ $c->email }}</td>
                                        <td>{{ Str::words($c->message, 5, ' ... ...') }}</td>
                                        <td>
                                            <a href="{{ route('admin#contactDetail',$c->id) }}" class=" text-decoration-none me-4"> <i class="fa-solid fa-eye fs-4"></i></a>

                                            <a href="{{ route('admin#contactDelete',$c->id) }}" class=" text-decoration-none text-danger">
                                                <i class="fa-solid fa-trash-can fs-4"></i>
                                            </a>
                                        </td>
                                    <tr class="spacer"></tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class=" mt-3">
                                {{$contact->appends(request()->query())->links()}}
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection



