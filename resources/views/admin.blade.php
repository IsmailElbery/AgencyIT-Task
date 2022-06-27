@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    @include('common.alert')
                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <span id="card_title">
                            {{ __('Reviewes') }}
                        </span>

                        <!-- <div class="float-right">
                            <a href="{{ route('userCreate') }}" class="btn btn-primary btn-sm float-right" data-placement="left">
                                {{ __('Create New') }}
                            </a>
                        </div> -->
                    </div>
                </div>

                <div class="card-body">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col" class="text-center">#</th>
                                <th scope="col" class="text-center">Username</th>
                                <th scope="col" class="text-center">Email</th>
                                @if($auth->status == 1)
                                <th scope="col" class="text-center">Reviewer Name</th>
                                <th scope="col" class="text-center">Reviewer Email</th>
                                @endif
                                <th scope="col" class="text-center">Reviewe</th>
                                <th scope="col" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <th class="text-center" scope="row">{{ $loop->index + 1 }}</th>
                                <td class="text-center">{{ $user->user->name }}</td>
                                <td class="text-center">{{ $user->user->email }}</td>
                                @if($auth->status == 1)
                                <td class="text-center">{{ $user->reviewer->name }}</td>
                                <td class="text-center">{{ $user->reviewer->email }}</td>
                                @endif
                                @if($user->review)

                                <td class="text-center">
                                    <button type="button" disabled class="btn btn-warning">
                                        {{ $user->review }}
                                    </button>
                                </td>

                                @else
                                <td class="text-center">

                                    <button type="button" class="open-AddBookDialog btn btn-primary"  data-id="{{$user->id}}" data-toggle="modal" data-target="#exampleModal">
                                        add Reviewe
                                    </button>
                                </td>
                                @endif
                                <td class="text-center">
                                    <a class="btn btn-sm btn-secondary" href="users/update-reviewe/{{$user->id}}"><i class="fa fa-fw fa-edit"></i> </a>
                                    <a class="btn btn-sm btn-danger" href="users/delete-reviewe/{{$user->id}}"><i class="fa fa-fw fa-trash"></i> </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- Button trigger modal -->


                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form method="POST" action="{{ url('users/add-reviewe') }}" role="form" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group col-md-8">
                                            <label>Review</label>
                                            <input type="text" name="review"  class="form-control" placeholder="Add Reviewe">
                                            <input type="text" name="id" hidden  id="bookId" class="form-control" placeholder="Add Reviewe">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
