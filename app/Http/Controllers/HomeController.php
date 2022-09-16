<?php

namespace App\Http\Controllers;

use App\Http\Repositories\UserRepo;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserRequestEdit;
use App\Models\Reviews;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    private $userRepo;
    public function __construct(UserRepo $userRepo)
    {
        $this->middleware('auth');
        $this->repo = $userRepo;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {

        $auth = Auth::user();
        $reviwers = User::where('status','0')->get();
        if($auth->status == 1){
            $users = $this->repo->list();
            return view('home',[
                'users' => $users,
                'reviwers' => $reviwers
            ]);
        }else{
            $users = $this->repo->listReviewers($auth->id);
            return view('admin', [
                'users' => $users,
                'auth' => $auth
            ]);
        }
    }
    public function create()
    {
        return view('user.create');
    }
    public function store(UserRequest $request)
    {
        $inputs = $request->all();
        $check = $this->repo->create($inputs);
        if ($check) {
            return redirect('users')->with('success', 'تم إضافة مستخدم بنجاح');
        } else {
            return redirect()->back()->withInput()->with('error', 'خطأ في إضافة مستخدم');
        }
    }

    public function update($id)
    {
        $user = User::where('id',$id)->first();
        return view('user.edit',['user' => $user]);
    }

    public function edit(UserRequestEdit $request)
    {
        $inputs = $request->all();
        $check = $this->repo->edit($inputs);
        if ($check) {
            return redirect('users')->with('success', 'تم تعديل المستخدم بنجاح');
        } else {
            return redirect()->back()->withInput()->with('error', 'خطأ في تعديل المستخدم');
        }
    }

    public function delete($id)
    {
        $user = User::where('id',$id)->delete();
        if($user){
            return redirect('users');
        }
    }


    //Reviewes CRUD

    public function reviewers(Request $request)
    {
        $id = $request->id;
        $reviwers = User::where('status','0')->where('id','!=',$id)->get();
        return $reviwers;
    }
    public function addReviewe(Request $request)
    {
        $inputs = $request->all();
        $check = $this->repo->createReview($inputs);
        if ($check) {
            return redirect('users')->with('success', 'تم إضافة مستخدم بنجاح');
        } else {
            return redirect()->back()->withInput()->with('error', 'خطأ في إضافة مستخدم');
        }
    }
    public function assginReviewer(Request $request)
    {
        $inputs = $request->all();
        $check = $this->repo->assginReviewer($inputs);
        if ($check) {
            return redirect('reviewes')->with('success', 'تم تعيين مراجع بنجاح');
        } else {
            return redirect()->back()->withInput()->with('error', 'خطأ في تعيين مراجع');
        }
    }
    public function updateReviewe($id)
    {
        $user = Reviews::where('id',$id)->first();
        $users = $this->repo->listUsers();
        return view('user.editReviewes',[
            'user' => $user,
            'users' => $users,
        ]);
    }
    public function reviewes()
    {
        $auth = Auth::user();
        $users = $this->repo->listAllReviewers();
        return view('admin', [
            'users' => $users,
            'auth' => $auth
        ]);
    }
    public function editReview(Request $request)
    {
        $inputs = $request->all();
        $check = $this->repo->editReview($inputs);
        if ($check) {
            return redirect('users')->with('success', 'تم تعديل التعليق بنجاح');
        } else {
            return redirect()->back()->withInput()->with('error', 'خطأ في تعديل التعليق');
        }
    }
    public function deleteReviewe($id)
    {
        $user = Reviews::where('id',$id)->delete();
        if($user){
            return redirect('users');
        }
    }
}
