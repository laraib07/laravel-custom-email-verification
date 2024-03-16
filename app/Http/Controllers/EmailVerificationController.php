<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use Carbon\Carbon;

class EmailVerificationController extends Controller
{
    public function __invoke(Request $request, $id, $hash)
    {
        $member = Member::findOrFail($id);

        if($member->token_created_at == null) {
            return view('email-verification-failed', ['id' => $id]);
        }

        // Get the token_created_at time from your model
        $tokenCreatedAt = Carbon::parse($member->token_created_at);

        // Calculate the difference in days
        $secondsDifference = $tokenCreatedAt->diffInSeconds(Carbon::now());

        // Check if the token is at least 120 seconds old and is same as hash
        if ($secondsDifference > 120 || $hash != $member->token) {
            return view('email-verification-failed', ['id' => $id]);
        }
        
        $this->verified($member);
        return view('email-verified');
    }

    public function verified($member)
    {
        $member->update([
            'email_verified_at' => Carbon::now(),
            'token' => null,
            'token_created_at' => null
        ]);
    }
}
