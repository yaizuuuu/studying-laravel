<?php

namespace App\Http\Controllers;

use App\Eloquent\User;
use Illuminate\Http\Request;
use Validator;

class UserController extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        $users = $this->user->all();

        return view('welcome', ['users' => $users]);
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, ['title' => 'required']);

        if ($validator->fails()) {
            return redirect()
                ->route('user.create')
                ->withInput()
                ->withErrors($validator->messages());
        }

        $this->user->create($input);

        return redirect()
            ->route('user.index')
            ->with(['flash' => '作成に成功しました']);
    }
}
