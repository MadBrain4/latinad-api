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
     * Obtener idioma del usuario
     *
     * Retorna el idioma actual configurado por el usuario autenticado.
     * @header Authorization Bearer {token}
     *
     * @group Idioma
     * @authenticated
     *
     * @response 200 {
     *   "language": "es"
     * }
    */
    public function getLanguage()
    {
        $language = JWTAuth::parseToken()->authenticate()->language;

        return response()->json([
            'language' => $language
        ]);
    }

        /**
     * Actualizar idioma del usuario
     *
     * Cambia el idioma preferido del usuario autenticado.
     *
     * @group Idioma
     * @authenticated
     * @header Authorization Bearer {token}
     *
     * @bodyParam language string required Código del idioma (ej: es, en, pt). Example: en
     *
     * @response 200 {
     *   "message": "Idioma actualizado correctamente",
     *   "language": "en"
     * }
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
