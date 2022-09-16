@extends('layouts.app')

@section('template_title')
Update User
@endsection

@section('content')
<section class="content container-fluid">
    <div class="">
        <div class="col-md-12">

            @includeif('partials.errors')

            <div class="card card-default">
                <div class="card-header">
                    <span class="card-title" style="margin-left:1300px ;" >تعديل متدرب</span>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('edit') }}" role="form" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group col-md-8">
                            <label style="margin-left:870px ;">الإسم </label>
                            <input type="text" value="{{ $user->name}}" name="name" class="form-control" placeholder="Enter username">
                            <input type="text" value="{{ $user->id}}" name="id" hidden >
                        </div>
                        <div class="form-group col-md-8">
                            <label for="exampleInputEmail1" style="margin-left:799px ;">البريد الإلكتروني</label>
                            <input type="email" name="email" value="{{ $user->email}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputPassword1" style="margin-left:600px;">الرقم السري</label>
                            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                        </div>
                        <div class="input-group" style="margin-top: 10px;">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">الوظيفة</label>
                            </div>
                            {!! Form::select('status',["Empeloyee","Admin "], $user->status, ['class'=>'custom-select']) !!}

                        </div>
                        <button type="submit" class="btn btn-primary" style="margin-top:10px ;">حفظ</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
