<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Support\Str;
use App\Models\Member;
use App\Mail\VerificationMail;
use Carbon\Carbon;

class MemberController extends Controller
{
    //
    public function create()
    {
        return view('form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email'
        ]);

        // Generate hash
        $hash = Str::random(60);

        $member = Member::create([
            'name' => $request->name,
            'email' => $request->email,
            'token' => $hash,
            'token_created_at' => Carbon::now()
        ]);

        $this->sendVerificationMail($request->email, $member->id, $hash);

        return redirect()->route('mail-sent');
    }

    /**
     * Resend verification mail if expired
     */
    public function resendVerificationMail(Request $request, $id)
    {
        $member = Member::findOrFail($id);

        // Generate hash
        $hash = Str::random(60);

        $member->update([
            'token' => $hash,
            'token_created_at' => Carbon::now()
        ]);

        $this->sendVerificationMail($member->email, $member->id, $hash);

        return redirect()->route('mail-sent');
    }

    /**
     * Generate verification link and mail it to the client
     */
    public function sendVerificationMail($email, $id, $hash)
    {
        $verification_link = route('verify', [$id, $hash]);

        Mail::to(new Address($email, 'Verify Member'))
            ->send(new VerificationMail($verification_link));
    }
}
