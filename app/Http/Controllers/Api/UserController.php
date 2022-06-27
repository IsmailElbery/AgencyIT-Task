<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Repositories\UserRepo;
use App\Models\Reviews;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    //
    public function __construct(UserRepo $userRepo)
    {
        $this->middleware('auth:api', ['except' => ['login']]);
        $this->repo = $userRepo;
    }
    public function test()
    {
        dd('dsasa');
        # code...
    }


    public function users()
    {
        $users = User::with(['user','reviewer'])->get();
        if ($users) {
            return response()->json([
                'success'   =>  true,
                'data'      =>  $users
            ], 200);
        }else{
            return response()->json([
                'success'   => false,
                'message'   => 'Sorry, you are not allwoed',
                'code'      => 401
            ], 401);
        }
    }
    public function getUser($id)
    {
        $user = User::where('id',$id)->first();
        if ($user) {
            return response()->json([
                'success'   =>  true,
                'data'      =>  $user
            ], 200);
        }
    }
    public function editUser(Request $request,$id)
    {
        $inputs = $request->all();
        $user = User::where('id',$id)->first();
        if($user){

            $user->name = $inputs['name'];
            $user->email = $inputs['email'];
            $user->status = $inputs['status'];
            if (is_null($inputs['password'])) {
                $user->password = $user->password;
            } else {
                $user->password = Hash::make($inputs['password']);
            }
            $user->save();

            return response()->json([
                'success'   =>  true,
                'message'      =>  'User updated successfully'
            ], 200);

        }
        return response()->json([
            'success'   =>  true,
            'message'      =>  'User not found '
        ], 200);
    }
    public function deleteUser($id)
    {

        $user = User::where('id',$id)->delete();
        if ($user) {
            return response()->json([
                'success'   =>  true,
                'message'      =>  'User deleted successfully'
            ], 200);
        }else{
            return response()->json([
                'success'   =>  false,
                'message'      =>  'User not found'
            ], 404);
        }
    }

    public function getReviewes()
    {
        $user = JWTAuth::user();
        if($user->status == 1){
            $users = Reviews::with(['user','reviewer'])->get();
            if ($users) {
                return response()->json([
                    'success'   =>  true,
                    'data'      =>  $users
                ], 200);
            }
        }else{

            $users = Reviews::with(['user', 'reviewer'])->where('reviewer_id', $user->id)->get();
            if ($users) {
                return response()->json([
                    'success'   =>  true,
                    'data'      =>  $users
                ], 200);
            }
        }
    }
    public function addReviewe(Request $request)
    {
        $inputs = $request->all();
        $reviewe = Reviews::where('user_id',$inputs['user_id'])->where('reviewer_id',$inputs['reviewer_id'])->first();

        if($reviewe->review != ""){
            return response()->json([
                'success'   =>  false,
                'message'      =>  'you can submit only one review '
            ], 201);
        }
        $reviewe->review = $inputs['review'];
        $reviewe->save();
        if ($reviewe) {
            return response()->json([
                'success'   =>  true,
                'message'      =>  'Reviewe added successfully'
            ], 200);
        }
    }
    public function assignReviewer(Request $request)
    {
        $inputs = $request->all();
        $reviewe = Reviews::create([
            'user_id' => $inputs['user_id'],
            'reviewer_id' => $inputs['reviewer_id'],
            'review' => '',
        ]);
        if ($reviewe) {
            return response()->json([
                'success'   =>  true,
                'message'      =>  'Reviewer added successfully'
            ], 200);
        }
        else{
            return response()->json([
                'success'   =>  false,
                'message'      =>  'Erorr'
            ], 201);
        }
    }
    public function getReview($id)
    {
        $reviewe = Reviews::where('id',$id)->first();
        if ($reviewe) {
            return response()->json([
                'success'   =>  true,
                'data'      =>  $reviewe
            ], 200);
        }else{
            return response()->json([
                'success'   =>  false,
                'message'      =>  'Reviewe not found'
            ], 404);
        }
    }
    public function editReview($id ,Request $request)
    {
        $inputs = $request->all();
        $reviewe = Reviews::where('id',$id)->first();
        if ($reviewe) {
            $reviewe->review = $inputs['review'];
            $reviewe->save();
            return response()->json([
                'success'   =>  true,
                'message'      =>  'Reviewe updated successfully'
            ], 200);
        }
        else{
            return response()->json([
                'success'   =>  false,
                'message'      =>  'Reviewe not found'
            ], 404);
        }
    }
    public function deleteReview($id)
    {
        $reviewe = Reviews::where('id',$id)->delete();
        if ($reviewe) {
            return response()->json([
                'success'   =>  true,
                'message'      =>  'Reviewe deleted successfully'
            ], 200);
        }else{
            return response()->json([
                'success'   =>  false,
                'message'      =>  'Reviewe not found'
            ], 404);
        }
    }
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'User successfully logged out.']);
    }
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60
        ]);
    }
}
