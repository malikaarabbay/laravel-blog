<?php

namespace App\Http\Controllers\User;

use App\Model\user\City;
use App\Model\user\Country;
use App\Model\user\Region;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Model\user\User;
class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function index(){
        $user = Auth::user();
        return view('user.profile.index', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        $countries = Country::all();
        $regions = Region::where('country_id', $user->city->region->country->id)->get();
        $cities = City::where('region_id', $user->city->region->id)->get();
        return view('user.profile.edit', compact('user', 'countries', 'regions', 'cities'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $user = Auth::user();
        $user->update([
            'name' => $request->name,
            'city_id' => $request->city_id,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'birth' => strtotime($request->birth)
        ]);
        if($request->hasFile('photo')){
            $photo = $request->photo->store('public/images/profile');
            $user->update(['photo' => $photo]);
        }
        return redirect(route('profile'));
    }

    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = Auth::user();
        $user->update([
            'password' => bcrypt($request->password),
        ]);
        return redirect(route('profile'));
    }
}
