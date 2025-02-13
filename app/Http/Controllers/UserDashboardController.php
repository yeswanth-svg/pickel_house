<?php

namespace App\Http\Controllers;

use App\Models\Referral;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    //

    public function referrals()
    {
        $referrals = Referral::where('referrer_id', auth()->id())->with('referredUser')->get();

        return view('user.referrals', compact('referrals'));
    }
}
