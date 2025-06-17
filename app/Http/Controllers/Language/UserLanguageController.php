<?php

namespace App\Http\Controllers\Language;

use App\Http\Controllers\Controller;
use App\Http\Requests\Language\UpdateLanguageRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserLanguageController extends Controller
{
    /**
     * Obtener el idioma actual del usuario autenticado
     */
    public function getLanguage()
    {
        $language = JWTAuth::parseToken()->authenticate()->language;

        return response()->json([
            'language' => $language
        ]);
    }

    /**
     * Actualizar el idioma del usuario autenticado
     */
    public function updateLanguage(UpdateLanguageRequest $request)
    {
        $user = JWTAuth::parseToken()->authenticate();

        $user->language = $request->input('language');
        $user->save();

        return response()->json([
            'message' => __('messages.language_updated'),
            'language' => $user->language,
        ]);
    }
}
