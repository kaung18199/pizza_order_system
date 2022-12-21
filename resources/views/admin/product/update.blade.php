@extends('admin.layouts.master')

@section('title','Category List Page')

@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="container-fluid">
                    <div class="row">
                    </div>
                    <div class="col-lg-10 offset-1">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">
                                    <div class=" ms-5">
                                        <i class="fa-solid fa-arrow-left text-dark" onclick="history.back()"></i>
                                    </div>
                                    <h3 class="text-center title-2">Update Pizza</h3>
                                </div>
                                <hr>

                                <form action="{{ route('product#update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class=" col-4 offset-1 text-center">

                                            <input type="hidden" name="pizzaId" value="{{ $pizza->id }}">

                                                <img src="{{ asset('storage/'.$pizza->image) }}" alt="John Doe" class=" img-thumbnail shadow-sm " />

                                            <div class="mt-3">
                                                <input type="file" name="pizzaImage" id="" class="@error('pizzaImage') is-invalid @enderror form-control shadow-sm">
                                                @error('pizzaImage')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mt-3">
                                                <button type="submit" class=" btn btn-dark col-12 shadow-sm"><i class="fa-solid fa-wrench me-2"></i>  Update</button>
                                            </div>
                                        </div>

                                        <div class="row col-6 ">
                                            <div class="form-group">
                                                <label  class="control-label mb-1 ">Name</label>
                                                <input id="cc-pament" name="pizzaName" type="text" value="{{ old('pizzaName',$pizza->name) }}" class="form-control shadow-sm @error('pizzaName')
                                                    is-invalid
                                                @enderror" aria-required="true" aria-invalid="false" placeholder="Ender Admin pizzaName" >
                                                @error('pizzaName')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label  class="control-label mb-1">description</label>
                                                <textarea name="pizzaDescription" id="" cols="20" rows="5"  class=" form-control shadow-sm @error('pizzaDescription')
                                                    is-invalid
                                                @enderror" placeholder="Ender Admin pizzaDescription">{{ old('pizzaDescription',$pizza->description) }}</textarea>
                                                @error('pizzaDescription')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label  class="control-label mb-1">Category</label>
                                                <select name="pizzaCategory" class="form-control shadow-sm @error('pizzaCategory')
                                                    is-invalid
                                                @enderror">
                                                    <option value="">Choose Pizza category....</option>
                                                    @foreach ($category as $c)
                                                        <option value="{{ $c->id }}" @if ($pizza->category_id == $c->id)
                                                            selected
                                                        @endif>{{ $c->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('pizzaCategory')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label  class="control-label mb-1 ">Price(kyats)</label>
                                                <input id="cc-pament" name="pizzaPrice" type="number" value="{{ old('pizzaPrice',$pizza->price) }}" class="form-control shadow-sm @error('pizzaPrice')
                                                    is-invalid
                                                @enderror" aria-required="true" aria-invalid="false" placeholder="Ender Admin pizzaPrice" >
                                                @error('pizzaPrice')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label  class="control-label mb-1 ">Waiting Time(min)</label>
                                                <input id="cc-pament" name="pizzaWaitingTime" type="text" value="{{ old('pizzaWaitingTime',$pizza->waiting_time) }}" class="form-control shadow-sm @error('pizzaWaitingTime')
                                                    is-invalid
                                                @enderror" aria-required="true" aria-invalid="false" placeholder="Ender Admin pizzaWaitingTime" >
                                                @error('pizzaWaitingTime')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label  class="control-label mb-1 ">View Count</label>
                                                <input id="cc-pament" name="viewCount" type="text" value="{{ old('viewCount',$pizza->view_count) }}" class="form-control shadow-sm " aria-required="true" aria-invalid="false" placeholder="Ender Admin viewCount" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label  class="control-label mb-1">Created Date</label>
                                                <input id="cc-pament" name="created_at" type="text" class="form-control shadow-sm " aria-required="true" value="{{$pizza->created_at->format('j-F-Y')}}" aria-invalid="false" placeholder="Admin" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
