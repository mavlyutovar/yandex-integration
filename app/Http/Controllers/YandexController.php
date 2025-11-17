<?php

namespace App\Http\Controllers;

use App\Actions\StoreYandexReviewAction;
use App\Services\YandexService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class YandexController extends Controller
{
    /**
     * Получить настройки текущего пользователя
     */

    public function __construct(
        protected YandexService $yandexService
    )
    {

    }
    public function index(Request $request): JsonResponse
    {
        return response()->json(
            $this->yandexService->getUrlInfoByUserId(Auth::id())
        );
    }

    /**
     * Создать или обновить настройки
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'yandex_url' => ['required', 'string', 'url'],
        ]);
        StoreYandexReviewAction::run(Auth::id(), $validated['yandex_url']);

        return response()->json(
            $this->yandexService->getUrlInfoByUserId(Auth::id())
        );
    }
}
