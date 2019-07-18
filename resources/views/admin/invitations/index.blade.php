@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h2 class="h2">Invitation Requests</h2>
        <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <button class="btn btn-sm btn-outline-success"><span data-feather="plus"></span> Add New</button>
            <button class="btn btn-sm btn-outline-secondary"><span data-feather="trash"></span> Trashed List</button>
            
        </div>
        </div>
    </div>


    <div class="table-responsive">
        <div class="panel panel-default" style="margin-top: 20px">
            <div class="panel-heading">Pending Requests <span class="badge">{{ count($invitations) }}</span></div>
            <div class="panel-body" style="padding: 0;">
                @if (!empty($invitations))
                    <table class="table table-responsive table-striped" style="margin-bottom: 0">
                        <thead>
                            <tr>
                                <th>Email</th>
                                <th>Created At</th>
                                <th>Invitation Link</th>
                            </tr>
                        </thead>
                        <tbody> 
                            @foreach ($invitations as $invitation)
                                <tr>
                                    <td>
                                        <form action="{{ route('send.invite', ['id' => $invitation->id]) }}" method="post" style="display: inline"> @csrf
                                            <button title="Invite user" type="submit" class="btn btn-outline-danger">{{ $invitation->email }}</button>
                                        </form> 
                                    </td>
                                    <td>{{ $invitation->created_at }}</td>
                                    <td>
                                        <kbd>{{ $invitation->getLink() }}</kbd>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>No invitation requests!</p>
                @endif
            </div>
        </div>
    </div>
@endsection
