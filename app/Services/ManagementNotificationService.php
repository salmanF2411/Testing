<?php

namespace App\Services;

use App\Models\Store;
use App\Models\User;
use App\Notifications\StoreActivityNotification;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Throwable;

class ManagementNotificationService
{
    /**
     * @param  array<int, int>  $storeIds
     */
    public function send(
        array $storeIds,
        string $activityType,
        string $title,
        string $message,
        string $url,
        ?User $actor = null,
    ): void {
        $storeIds = collect($storeIds)
            ->map(fn ($storeId) => (int) $storeId)
            ->filter()
            ->unique()
            ->values()
            ->all();

        $recipients = $this->recipients($storeIds);

        if ($recipients->isEmpty()) {
            return;
        }

        $storeLabel = Store::query()
            ->whereIn('id', $storeIds)
            ->orderBy('name')
            ->pluck('name')
            ->join(', ');
        $actorName = $actor?->name ?? 'Sistem';

        Notification::send($recipients, new StoreActivityNotification(
            $activityType,
            $title,
            $message,
            $storeIds,
            $storeLabel,
            $url,
            $actorName,
            ['database'],
        ));

        $mailRecipient = $recipients->first(fn (User $user) => $user->hasRole('owner'))
            ?? $recipients->first();
        $ccEmails = $recipients
            ->where('id', '!=', $mailRecipient->id)
            ->pluck('email')
            ->filter()
            ->values()
            ->all();

        defer(function () use (
            $mailRecipient,
            $ccEmails,
            $activityType,
            $title,
            $message,
            $storeIds,
            $storeLabel,
            $url,
            $actorName,
        ) {
            try {
                $mailRecipient->notify(new StoreActivityNotification(
                    $activityType,
                    $title,
                    $message,
                    $storeIds,
                    $storeLabel,
                    $url,
                    $actorName,
                    ['mail'],
                    $ccEmails,
                ));
            } catch (Throwable $exception) {
                Log::warning('Email notifikasi gagal dikirim.', [
                    'recipient_id' => $mailRecipient->id,
                    'recipient_email' => $mailRecipient->email,
                    'cc_emails' => $ccEmails,
                    'activity_type' => $activityType,
                    'error' => $exception->getMessage(),
                ]);
            }
        });
    }

    /**
     * @param  array<int, int>  $storeIds
     * @return Collection<int, User>
     */
    private function recipients(array $storeIds): Collection
    {
        $owners = User::role('owner')
            ->where('status', 'active')
            ->get();

        $managers = empty($storeIds)
            ? collect()
            : User::role('store_manager')
                ->where('status', 'active')
                ->whereIn('store_id', $storeIds)
                ->get();

        return $owners
            ->merge($managers)
            ->unique('id')
            ->values();
    }
}
