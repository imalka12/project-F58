<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function showProfilePage()
    {
        $user = User::whereId(auth()->user()->id)->with('profile')->first();
        $cities = $this->getCitiesList();

        return view('pages.web.user.profile', compact('user', 'cities'));
    }

    public function getCitiesList()
    {
        $cities = City::orderBy('title')->get();

        $list = [];

        foreach ($cities as $city) {
            if(!array_key_exists($city->district->title, $list)) {
                $list[$city->district->title] = [];
            }
            
            $list[$city->district->title][] = $city;
        }

        return $list;
    }

    public function updateClientProfile(Request $request)
    {
        $data = $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'address_line_1' => 'required',
            'address_line_2' => 'nullable',
            'city_id' => 'required|exists:cities,id',
            'telephone' => 'required|numeric|regex:/^0[1-9]{1}[0-9]{1}[0-9]{7}$/',
        ]);

        $user = User::whereId(auth()->user()->id)->with('profile')->first();

        $user->update([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
        ]);

        $user->profile->update([
            'address_line_1' => $data['address_line_1'],
            'address_line_2' => $data['address_line_2'],
            'city_id' => $data['city_id'],
            'telephone' => $data['telephone'],
        ]);

        return redirect()->route('client.profile')->with('success', 'Profile updated successfully.');
    }
}
