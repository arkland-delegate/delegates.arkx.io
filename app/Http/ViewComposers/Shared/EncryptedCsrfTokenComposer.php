<?php

namespace App\Http\ViewComposers\Shared;

use Illuminate\Contracts\View\View;

class EncryptedCsrfTokenComposer
{
    public function compose(View $view)
    {
        $encryptedCsrfToken = encrypt(csrf_token());

        $view->with(compact('encryptedCsrfToken'));
    }
}
