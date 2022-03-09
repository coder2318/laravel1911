@extends('layout.layout')
@section('content')
<h1>products</h1>
<a href="{{route('product.index')}}" class="btn btn-primary">index</a>
<table class="table table-primary">
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Price</th>
        <th>Weight</th>
        <th>Status</th>
        <th>Created At</th>
        <th>Updated At</th>
        <td>Image</td>
        <td>Images</td>
    </tr>
        <tr>
            <td>{{$item->id}}</td>
            <td>{{$item->name}}</td>
            <td>{{$item->price}}</td>
            <td>{{$item->weight}}</td>
            <td>{{$item->status}}</td>
            <td>{{$item->created_at}}</td>
            <td>{{$item->updated_at}}</td>
            <td><img src="{{asset('storage/images/'.$item->image)}}" width="100"  alt="bu yerda rasm bor"/></td>
            <td>
                @if ($item->images)
                @php
                    $images = explode(',', $item->images);
                @endphp
                    @foreach ($images as $value)
                        <img src="{{asset('storage/images/'.$value)}}" width="100"  alt="bu yerda rasm bor"/>
                    @endforeach
                @endif
            </td>
        </tr>
</table>

@endsection
