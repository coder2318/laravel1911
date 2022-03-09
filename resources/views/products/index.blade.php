@extends('layout.layout')
@section('content')
<h1>products</h1>
<a href="{{route('product.create')}}" class="btn btn-primary">Create</a>
<form class="form-group" action="{{route('product.index')}}" method="GET">
    <input class="form-control" type="text" name="search">
    <select name="status" id="">
        <option value="1">Active</option>
        <option value="0">No Active</option>
    </select>

    <input type="submit" class="btn btn-success" value="Search">
</form>
<table class="table table-primary">
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Price</th>
        <th>Weight</th>
        <th>Status</th>
        <th>Category</th>
        <th>Image</th>
        <th>Created At</th>
        <th>Action</th>
    </tr>
    @foreach ($products as $item)
        <tr>
            <td>{{$item->id}}</td>
            <td><a href="{{route('product.show', ['product' => $item->id])}}">{{$item->name}}</a></td>
            <td>{{$item->price}}</td>
            <td>{{$item->weight}}</td>
            <td>{{$item->status}}</td>
            <td>{{$item->category->name}}</td>
            <td><img src="{{asset('storage/images/'.$item->image)}}" width="100"  alt="bu yerda rasm bor"/></td>
            <td>{{$item->created_at}}</td>
            <td><a href="{{route('product.edit', ['product' => $item->id])}}" class="btn btn-warning">Update</a>

                <form action="{{route('product.destroy', ['product' => $item->id])}}" method="post">
                    @csrf
                    @method('DELETE')
                    {{-- <input type="text" hidden> --}}
                    <input type="submit" class="btn btn-danger" value="Delete">
                </form>
            </td>
        </tr>
    @endforeach
</table>

@endsection
