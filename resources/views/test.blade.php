@extends('layout.layout')
@section('content')
<h1>Welcome {{ $nom }} {{ $lastname }}</h1> talaba
<h3>{{$univercity}}</h3> da o'qiydi
    <form action="/test1" class="form-group" method="GET">
        Name
        <input type="text" class="form-control" name="name">
        Lastname
        <input type="text" class="form-control" name="lastname">
        Otm
        <input type="text" class="form-control" name="otm">
        <input type="submit" value="send" class="btn btn-success">
    </form>
@endsection


