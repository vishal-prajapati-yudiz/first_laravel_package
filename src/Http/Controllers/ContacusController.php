<?php

namespace Spatie\Skeleton\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Spatie\Skeleton\Models\MyModel;

/**
 *
 */
class ContactusController
{
    public function index()
    {
        return view('skeleton::subDirectory.index');
    }

    public function checkEmail(Request $request)
    {
        $id = $request->id ?? 0;
        if ($request->type == 'user') {
            $user = MyModel::withTrashed();
        }

        $user = $user->where([
                ['id', '<>', $id],
                'email' => $request->email,
            ])->count();

        if ($user == 0) {
            return "true";
        } else {
            return "false";
        }
    }

    public function checkContact(Request $request)
    {
        $id = $request->id ?? 0;
        if ($request->type == 'user') {
            $user = MyModel::withTrashed();
            
            $user = $user->where([
                ['id', '<>', $id],
                'contact' => $request->contact,
            ])->count();

            if ($user == 0) {
                return "true";
            } else {
                return "false";
            }
        }
    }
    public function store(Request $request)
    {
        $contactus = MyModel::create($request->all());
        if ($contactus->save()) {
            $userName = strtolower($request->name);
            Session::flash('message', $userName.' your details added successfully');

            return redirect()->route('contactus');
        } else {
            return "Some Problem is there!!!";
        }
    }
}
