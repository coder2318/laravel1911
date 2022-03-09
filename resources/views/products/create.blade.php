@extends('layout.layout')
@section('content')
<h1>products Create</h1>

    <form class="form-group" action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <label for="">name</label>
        <input class="form-control" type="text" name="name" value="{{old('name')}}">
        <span style="color:red">{{$errors->first('name')}}</span>
        <label for="">Price</label>
        <input class="form-control" type="number" name="price" value="{{old('price')}}">
        <span style="color:red">{{$errors->first('price')}}</span>

        <label for="">Weight</label>
        <input class="form-control" type="text" name="weight" value="{{old('weight')}}">
        <span style="color:red">{{$errors->first('weight')}}</span>

        <label for="">Status</label>
        <select class="form-control" name="status" id="">
            <option value="0">No active</option>
            <option value="1">Active</option>
        </select>
        <label for="">Category</label>

        <select class="form-control" name="category_id" id="">
            @foreach ($categories as $item)
                <option value="{{$item->id}}">{{$item->name}}</option>
            @endforeach
        </select>

    <br>
        <label for="">Image</label>
    <input type="file" class="form-control" name="image">
    <label for="">Images</label>
    <input type="file" class="form-control" multiple name="images[]">
    <span style="color:red">{{$errors->first('images')}}</span>
        <input type="submit" class="btn btn-success" value="Saqlash">
    </form>
@endsection
