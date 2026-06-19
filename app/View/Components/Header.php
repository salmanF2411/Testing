<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Header extends Component
{
    /**
     * Create a new component instance.
     */
    public string $user;
    public int $notifCount;
    public Collection $notifications;

    public function __construct(?string $user = null)
    {
        $authenticatedUser = Auth::user();
        $this->user = $user ?? $authenticatedUser?->name ?? 'Guest';
        $this->notifCount = $authenticatedUser?->unreadNotifications()->count() ?? 0;
        $this->notifications = $authenticatedUser
            ? $authenticatedUser->notifications()->latest()->limit(5)->get()
            : collect();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.header');
    }
}
