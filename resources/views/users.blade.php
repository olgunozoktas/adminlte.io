@extends('layouts.master')

@section('content')

<div class="box">
            <div class="box-header">
                <h3 class="box-title">All Categories</h3>
            </div>
            
            <div class="box-body">

                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>UserType</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                            @if($user->isOnline())
                                <li class="text-success">Online</li>
                            @else
                                <li class="text-muted">Offline</li>
                            @endif
                            </td>
                            <!--<td>-->
                            <td>{{$user->user_type}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            
            </div>
        </div>
@endsection