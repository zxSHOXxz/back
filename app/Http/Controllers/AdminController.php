<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\City;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $admins = Admin::orderBy('id', 'desc')->paginate(5);
        return response()->view('dashboard.admin.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $cities = City::all();
        return response()->view('dashboard.admin.create', compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = validator($request->all(), [
            // 'first_name' => 'required',
            // 'last_name' => 'required',
            // 'mobile' => 'required',
            'email' => 'required|email',
            // 'image'=>"required|image|max:2048|mimes:png,jpg,jpeg,pdf",
        ]);
        if (!$validator->fails()) {
            $admins = new Admin();
            $admins->email = $request->get('email');
            $admins->password = Hash::make($request->get('password'));
            $isSaved = $admins->save();
            if ($isSaved) {
                $users = new User();

                if (request()->hasFile('image')) {

                    $image = $request->file('image');

                    $imageName = time() . 'image.' . $image->getClientOriginalExtension();

                    $image->move('storage/images/admin', $imageName);

                    $users->image = $imageName;
                }

                $users->name = $request->get('first_name') . " " . $request->get('last_name');
                $users->mobile = $request->get('mobile');
                $users->gender = $request->get('gender');
                $users->address = $request->get('address');

                $users->actor()->associate($admins);
                $isSaved = $users->save();

                return response()->json(['icon' => 'success', 'title' => '?????? ?????????????? ??????????'], 200);

            } else {
                return response()->json(['icon' => 'error', 'title' => '???????? ?????????? ?????????????? '], 400);
            }

        } else {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $admins = Admin::findOrFail($id);
        return response()->view('dashboard.admin.edit', compact('admins'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = validator($request->all(), [
            // 'first_name' => 'required',
            // 'last_name' => 'required',
            // 'mobile' => 'required',
            'email' => 'required|email',
            // 'image'=>"required|image|max:2048|mimes:png,jpg,jpeg,pdf",
        ]);
        if (!$validator->fails()) {
            $admins = Admin::findOrFail($id);
            $admins->email = $request->get('email');
            $isSaved = $admins->save();
            if ($isSaved) {
                $users = $admins->user;
                $users->name = $request->get('name');
                $users->mobile = $request->get('mobile');
                $users->gender = $request->get('gender');
                $users->address = $request->get('address');
                $users->actor()->associate($admins);
                $isUpdated = $users->save();
                if ($isUpdated) {
                    return ['redirect' => route('admins.index')];
                }
                return response()->json(['icon' => 'success', 'title' => '?????? ?????????????? ??????????'], 200);

            } else {
                return response()->json(['icon' => 'error', 'title' => '???????? ?????????? ?????????????? '], 400);
            }

        } else {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { //
        $admins = Admin::findOrFail($id);
        $users = $admins->user;
        $deleteUser = User::destroy($users->id);
        $deleteAdmin = Admin::destroy($id);
        return response()->json(['icon' => 'success', 'title' => 'Deleted is Successfully'], $admins ? 200 : 400);
    }
}