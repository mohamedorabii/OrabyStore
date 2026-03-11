<?php

namespace App\Providers;

use App\Models\Cart;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::listen(Login::class, function (Login $event): void {
            if (! app()->bound('session')) {
                return;
            }

            $sessionCookieName = config('session.cookie');
            $sessionId = request()->cookie($sessionCookieName) ?? request()->session()->getId();

            if (! $sessionId) {
                return;
            }

            $userId = $event->user->id;

            $guestItems = Cart::whereNull('user_id')
                ->where('session_id', $sessionId)
                ->get()
                ->groupBy('product_id');

            foreach ($guestItems as $productId => $items) {
                $guestQuantity = $items->sum('quantity');

                $userItem = Cart::where('user_id', $userId)
                    ->where('product_id', $productId)
                    ->first();

                if ($userItem) {
                    $userItem->update([
                        'quantity' => min($userItem->quantity + $guestQuantity, 20),
                    ]);
                    Cart::whereIn('id', $items->pluck('id'))->delete();
                    continue;
                }

                $firstItem = $items->first();
                $firstItem->update([
                    'user_id' => $userId,
                    'session_id' => null,
                    'quantity' => min($guestQuantity, 20),
                ]);

                if ($items->count() > 1) {
                    Cart::whereIn('id', $items->skip(1)->pluck('id'))->delete();
                }
            }
        });
    }
}
