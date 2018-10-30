<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Models\Delegate;
use ArkEcosystem\Crypto\Utils\Message;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Ramsey\Uuid\Uuid;

class LostAndFoundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $delegates = Delegate::lost()->simplePaginate();

        return view('dashboard.lost-and-found', compact('delegates'));
    }

    /**
     * Display a listing of the resource filtered by the specified criteria.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\View\View
     */
    public function search(SearchRequest $request): View
    {
        $delegates = Delegate::lost()->where(function ($search) use ($request) {
            $search
                ->where('address', 'like', '%'.$request->search.'%')
                ->orWhere('username', 'like', '%'.$request->search.'%');
        })->simplePaginate();

        return view('dashboard.lost-and-found', compact('delegates'));
    }

    /**
     * Handle a claim of the specified resource.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Delegate     $delegate
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function claim(Request $request, Delegate $delegate): RedirectResponse
    {
        if ($delegate->claimed_at) {
            return back();
        }

        $delegate->forceFill([
            'user_id'            => $request->user()->id,
            'claimed_at'         => Carbon::now(),
            'verification_token' => Uuid::uuid4(),
        ])->save();

        return redirect()->route('dashboard.delegate', $delegate);
    }

    /**
     * Verify the claim of the specified resource.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Delegate     $delegate
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verifyClaim(Request $request, Delegate $delegate): RedirectResponse
    {
        $data = $request->validate([
            'message' => ['required', 'json'],
        ]);

        try {
            $message = Message::new($data['message']);

            if (!$message->verify()) {
                return $this->resetDelegate($delegate);
            }

            if ($message->publicKey !== $delegate->public_key) {
                return $this->resetDelegate($delegate);
            }

            if ($message->message !== $delegate->verification_token) {
                return $this->resetDelegate($delegate);
            }
        } catch (\Exception $e) {
            alert()->error('An unknown error occurred. Please make sure your message contains a publickey, signature and message and is valid JSON.');

            return back();
        }

        $delegate->activate();

        alert()->info('The delegate has been verified.');

        return redirect()->route('dashboard.delegate', $delegate);
    }

    /**
     * Reset the specified resource.
     *
     * @param \App\Models\Delegate $delegate
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    private function resetDelegate(Delegate $delegate): RedirectResponse
    {
        $delegate->reset();

        alert()->error('The signed message could not be verified! The delegate has been reset.');

        return redirect()->route('dashboard.lost-and-found');
    }
}
