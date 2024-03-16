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

        // Get the token_created_at time from your model
        $tokenCreatedAt = Carbon::parse($member->token_created_at);

        // Calculate the difference in days
        $secondsDifference = $tokenCreatedAt->diffInSeconds(Carbon::now());

        // Check if the token is at most 2 days old
        if ($secondsDifference <= 60) {
            $this->verified($member);
            return view('email-verified');
        }
        return view('email-verification-failed', ['id' => $id]);
    }

    public function verified($member)
    {
        $member->update([
            'email_verified_at' => Carbon::now(),
            'token' => null
        ]);
    }
}
