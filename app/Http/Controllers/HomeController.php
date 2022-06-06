<?php

namespace App\Http\Controllers;

use App\Models\Price;
use App\Models\User;
use App\Models\UserAmount;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function dashboard() {
        $prices = Price::with('userAmount')->get();
        $users = User::all();
        return view('dashboard', ['prices' => $prices, 'users' => $users]);
    }

    public function save(Request $request) {

        $request->validate([
            'price' => 'required'
        ]);
        $user = Auth::user();
        $mainPrice = $request->price;
        $users = $request->users;
        $amounts = $request->amounts;

        $initialPrices = UserAmount::where('isInitial', 1)->with('price')->get();

        $price = new Price();
        $price->amount = (double) $mainPrice;
        $price->save();


        if (!count($initialPrices)) {
            for ($i = 0; $i < count($users); $i++) {
                $userAmount = new UserAmount();
                $userAmount->user_id = (int) $users[$i];
                $userAmount->price_id = $price->id;
                $userAmount->amount = (double) $amounts[$i];
                $userAmount->isInitial = 1;
                $userAmount->save();
            }
        }else{
            $userInitialAmounts = [];
            foreach ($initialPrices as $initialPrice) {
                $amount = $initialPrice->amount;
                $mainInitialPrice = $initialPrice->price->amount;

                $initialPercentage = ($amount / $mainInitialPrice) * 100;
                $newPercentage = ($initialPercentage / 100) * $mainPrice;

                $userInitialAmounts[] = $newPercentage;

                $userAmount = new UserAmount();
                $userAmount->user_id = $initialPrice->user_id;
                $userAmount->price_id = $price->id;
                $userAmount->amount = $newPercentage;
                $userAmount->save();
            }
        }

        return redirect()->route('dashboard');

    }

    public function delete() {

        Price::query()->delete();
        return redirect()->route('dashboard');
    }
}
