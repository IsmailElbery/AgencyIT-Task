<?php

namespace App\Http\Repositories;

use App\Models\Reviews;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class UserRepo{


    public function list()
    {
        $users = User::with(['user','reviewer'])->get();
        return $users;
    }
    public function listUsers()
    {
        $users = User::with(['user','reviewer'])->get()->all();
        return $users;
    }

    public function create($inputs)
    {
        $user = new User();
        $user->name = $inputs['name'];
        $user->email = $inputs['email'];
        $user->status = $inputs['status'];
        $user->password =  Hash::make($inputs['password']);
        $user->save();
        return $user;
    }
    public function edit($inputs)
    {
        $user = User::where('id',$inputs['id'])->first();

        $user->name = $inputs['name'];
        $user->email = $inputs['email'];
        $user->status = $inputs['status'];
        if(is_null($inputs['password'])){
            $user->password = $user->password;
        }else{
            $user->password = Hash::make($inputs['password']);
        }
        $user->save();
        return $user;
    }

    //Reviewes
    public function createReview($inputs)
    {
        $reviewe = Reviews::where('id',$inputs['id'])->first();
        if($reviewe){
            $reviewe->review = $inputs['review'];
            $reviewe->save();
            return true;
        }
    }
    public function assginReviewer($inputs)
    {
        foreach($inputs['reviewr'] as $reviewer){
            $check = Reviews::where('user_id',$inputs['id'])->where('reviewer_id', $reviewer)->first();
            if (!$check) {
                Reviews::create([
                    'user_id' => $inputs['id'],
                    'reviewer_id' => $reviewer,
                    'review' => ''
                ]);
            }
        }
        return true;

    }
    public function listReviewers($user_id)
    {
        $users = Reviews::with(['user','reviewer'])->where('reviewer_id',$user_id)->get();
        return $users;
    }
    public function listAllReviewers()
    {
        $users = Reviews::with(['user','reviewer'])->get();
        return $users;
    }
    public function editReview($inputs)
    {
        $reveiw = Reviews::where('id',$inputs['id'])->first();
        $reveiw->review = $inputs['review'];
        $reveiw->save();
        return $reveiw;
    }

}
