@extends('layouts.layout')

@section('title', "Manage Users")

@section('content')
<!-- user index for admins -->
<h1 name="h1centre">Users</h1>
<button class="btn btn-primary" style="float:right;" onclick="window.location.href='/admin/users/create'">Add User</button></br></br>
<div style="overflow-x:auto;">
    <table class="table" text-align="center">
        <thead align="center">
            <th style="text-align:left">Name</th>
            <th style="text-align:left">Email</th>
            <th>Edit</th>
            <th>Delete</th>
        </thead>
        <tbody align="center">
            @foreach ($user as $user)
            @if(!$user->isSuperAdmin())
                <tr>
                    <td style="text-align:left">{{ $user->name }}</td>
                    <td style="text-align:left">{{ $user->email }}</td>
                    <td><a href="javascript:void(0)" class="edituser" data-name="{{$user->name}}" data-email="{{ $user->email }}" data-url="{{ route('users.update',$user->userID) }}"
                        data-toggle="modal" data-target="#user"><i class="fas fa-edit"></i></a></td>
                    <td><a href="javascript:;" data-toggle="modal" data-url="{{ route('users.destroy', $user->userID) }}"
                        data-target="#DeleteModal" class="remove-record"><i style="color:#FF0000;" class="fa fa-trash-alt"></a></td>
                </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>

@endsection
