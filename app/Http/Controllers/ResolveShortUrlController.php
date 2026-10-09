<?php

namespace App\Http\Controllers;

use App\Repositories\ShortUrlRepository;

class ResolveShortUrlController extends Controller
{
    // Public (no login): redirects a short code to the original url.
    public function show(string $code, ShortUrlRepository $shortUrls)
    {
        $shortUrl = $shortUrls->findByCodeOrFail($code);

        return redirect()->away($shortUrl->original_url);
    }
}
