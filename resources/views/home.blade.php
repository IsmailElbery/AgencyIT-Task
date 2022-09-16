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
                            {{ __('المتدربين') }}
                        </span>

                        <div class="float-right">
                            <a href="{{ route('userCreate') }}" style="margin-left: 10px;" class="btn btn-primary btn-sm float-right" data-placement="left">
                                {{ __('إضافة متدرب') }}
                            </a>
                            <!-- <a href="{{ route('reviewes') }}" class="btn btn-primary btn-sm float-right" data-placement="left">
                                Reviewes
                            </a> -->
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col" class="text-center">#</th>
                                <th scope="col" class="text-center">الإسم</th>
                                <th scope="col" class="text-center">البريد الإلكتروني</th>
                                <th scope="col" class="text-center">الوظيفة</th>
                                <th scope="col" class="text-center">الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <th class="text-center" scope="row">{{ $loop->index + 1 }}</th>
                                <td class="text-center">{{ $user->name }}</td>
                                <td class="text-center">{{ $user->email }}</td>
                                @if($user->status == 0)
                                <td class="text-center">متدرب</td>
                                @elseif($user->status == 1)
                                <td class="text-center">مدير</td>
                                @endif

                                <td class="text-center">
                                    <a class="btn btn-sm btn-secondary" href="users/update/{{$user->id}}"><i class="fa fa-fw fa-edit"></i> </a>
                                    <a class="btn btn-sm btn-danger" href="users/delete/{{$user->id}}"><i class="fa fa-fw fa-trash"></i> </a>
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
                            <form method="POST" action="{{ url('users/assign-reviewer') }}" role="form" enctype="multipart/form-data">
                                    @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                <input type="text" name="id" hidden  id="bookId" class="form-control">
                                    <select class="js-example-basic-single" multiple="multiple" style="width:50% ;" id="program" name="reviewr[]">

                                    </select>
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
