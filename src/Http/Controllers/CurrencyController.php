<?php

namespace dnj\Currency\Http\Controllers;

use dnj\Currency\Contracts\ICurrencyManager;
use dnj\Currency\Contracts\RoundingBehaviour;
use dnj\Currency\Models\Currency;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Rules\Enum;

class CurrencyController extends Controller
{
    use ValidatesRequests;
    use AuthorizesRequests;

    public function __construct(private ICurrencyManager $currencyManager)
    {
    }

    public function index()
    {
        $this->authorize('currency_search');
        $items = Currency::query()->orderBy('id')->cursorPaginate(50);

        return [
            'items' => $items,
        ];
    }

    public function show(int $currency)
    {
        $currency = $this->currencyManager->getByID($currency);
        $this->authorize('currency_show', [
            'currency' => $currency,
        ]);

        return [
            'currency' => $currency,
        ];
    }

    public function store(Request $request)
    {
        $this->authorize('currency_add');
        $inputs = $request->validate([
            'code' => 'required|unique:'.Currency::class.'|max:10',
            'title' => 'required|max:255',
            'prefix' => 'present|max:255',
            'suffix' => 'present|max:255',
            'roundingBehaviour' => ['required', new Enum(RoundingBehaviour::class)],
            'roundingPrecision' => 'required|integer',
        ]);
        $currency = $this->currencyManager->create(
            $inputs['code'],
            $inputs['title'],
            $inputs['prefix'],
            $inputs['suffix'],
            $inputs['roundingBehaviour'],
            $inputs['roundingPrecision'],
        );

        return [
            'currency' => $currency,
        ];
    }
}
