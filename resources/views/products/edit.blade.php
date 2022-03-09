@extends('layout.layout')
@section('content')
<h1>products</h1>
<a href="{{route('product.index')}}" class="btn btn-primary">index</a>

<form class="form-group" action="{{route('product.update', ['product'=> $product->id])}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <label for="">name</label>
    <input class="form-control" type="text" name="name" value="{{$product->name}}">
    <span style="color:red">{{$errors->first('name')}}</span>
    <label for="">Price</label>
    <input class="form-control" type="number" name="price" value="{{$product->price}}">
    <span style="color:red">{{$errors->first('price')}}</span>
    <label for="">Weight</label>
    <input class="form-control" type="text" name="weight" value="{{$product->weight}}">
    <span style="color:red">{{$errors->first('weight')}}</span>
    <label for="">Status</label>
    <select class="form-control" name="status" id="" value="{{$product->status}}">
        @if ($product->status)
            <option value="0">No active</option>
            <option selected value="1">Active</option>
        @else
            <option selected value="0">No active</option>
            <option value="1">Active</option>
        @endif
    </select>
    <label for="">Category</label>

    <select class="form-control" name="category_id" id="">
        @foreach ($categories as $item)
        @if ($item->id == $product->category_id)
            <option selected value="{{$item->id}}">{{$item->name}}</option>
        @else
            <option value="{{$item->id}}">{{$item->name}}</option>
        @endif
        @endforeach
    </select>
    <label for="">Image</label>
    <input type="file" class="form-control" name="image">
    <span style="color:red">{{$errors->first('image')}}</span>
    @if ($product->image)
        <img src="{{asset('storage/images/'.$product->image)}}" width="100" alt="">
    @endif
    <br>
    <label for="">Images</label>
    <input type="file" class="form-control" multiple name="images[]">
    <span style="color:red">{{$errors->first('images')}}</span>
    @if ($product->images)
                @php
                    $images = explode(',', $product->images);
                @endphp
                    @foreach ($images as $value)
                        <img src="{{asset('storage/images/'.$value)}}" width="100"  alt="bu yerda rasm bor"/>
                    @endforeach
                @endif
                <br>
    <input type="submit" class="btn btn-success" value="Saqlash">
</form>

@endsection
