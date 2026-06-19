<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class NotificationController extends Controller
{
    public function index(): View
    {
        $notifications = $this->currentUser()
            ->notifications()
            ->latest()
            ->paginate(15);

        return view('pages.notifikasi', compact('notifications'));
    }

    public function read(string $notification): RedirectResponse
    {
        $notification = $this->currentUser()
            ->notifications()
            ->findOrFail($notification);

        if ($notification->unread()) {
            $notification->markAsRead();
        }

        $target = data_get($notification->data, 'url');

        if (! is_string($target) || ! str_starts_with($target, '/')) {
            $target = route('notifikasi.index', absolute: false);
        }

        return redirect($target);
    }

    public function readAll(): RedirectResponse
    {
        $this->currentUser()->unreadNotifications()->update([
            'read_at' => now(),
        ]);

        return back()->with('success', 'Semua notifikasi telah ditandai sudah dibaca.');
    }
}
