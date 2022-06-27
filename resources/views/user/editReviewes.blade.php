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
                    <span class="card-title">Update Reviewe</span>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('editReview') }}" role="form" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group col-md-8">
                            <label>Empeloyee Name</label>
                            <input type="text" disabled value="{{ $user->user->name}}" name="user_id" class="form-control" placeholder="Enter username">
                            <input type="text" value="{{ $user->id}}" name="id" hidden >
                        </div>
                        <div class="form-group col-md-8">
                            <label>Reviewer Name</label>
                            <input type="text" disabled value="{{ $user->reviewer->name}}" name="reviewer_id" class="form-control" placeholder="Enter username">

                        </div>
                        <div class="form-group col-md-8">
                            <label>Reviewe</label>
                            <input type="text" value="{{ $user->review}}" name="review" class="form-control" placeholder="Enter username">

                        </div>
                        <button type="submit" class="btn btn-primary" style="margin-top:10px ;">Submit</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
