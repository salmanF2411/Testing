@extends('layouts.layoutAdminPanel')

@section('content')
<div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
        <h1 class="text-3xl font-bold text-slate-900">
            <i class="fa-solid fa-bell text-blue-600 mr-2"></i>Notifikasi
        </h1>
        <p class="text-slate-500 text-sm mt-1">Aktivitas transaksi, produk, dan stok yang perlu Anda ketahui.</p>
    </div>

    @if(auth()->user()->unreadNotifications()->exists())
        <form method="POST" action="{{ route('notifikasi.read-all') }}">
            @csrf
            <button type="submit" class="px-4 py-2 rounded-lg inline-flex items-center justify-center gap-2 text-sm font-medium bg-blue-600 text-white hover:bg-blue-700 transition">
                <i class="fa-solid fa-check-double"></i>
                Tandai Semua Dibaca
            </button>
        </form>
    @endif
</div>

<div class="bg-white border border-slate-200 rounded-lg overflow-hidden">
    @forelse($notifications as $notification)
        @php
            $activityType = data_get($notification->data, 'activity_type', 'default');
            [$icon, $iconClass] = match($activityType) {
                'transaction' => ['fa-receipt', 'bg-blue-100 text-blue-700'],
                'low_stock' => ['fa-triangle-exclamation', 'bg-red-100 text-red-700'],
                'product_created' => ['fa-box-open', 'bg-emerald-100 text-emerald-700'],
                'product_disabled' => ['fa-box-archive', 'bg-slate-100 text-slate-700'],
                'stock_updated' => ['fa-boxes-stacked', 'bg-amber-100 text-amber-700'],
                'stock_transfer_created' => ['fa-truck-fast', 'bg-cyan-100 text-cyan-700'],
                'stock_transfer_confirmed' => ['fa-circle-check', 'bg-green-100 text-green-700'],
                default => ['fa-bell', 'bg-blue-100 text-blue-700'],
            };
        @endphp
        <form method="POST" action="{{ route('notifikasi.read', $notification->id) }}" class="border-b border-slate-100 last:border-b-0">
            @csrf
            <button type="submit" class="w-full px-5 py-4 text-left hover:bg-slate-50 transition {{ $notification->unread() ? 'bg-blue-50/40' : 'bg-white' }}">
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-lg flex items-center justify-center flex-shrink-0 {{ $iconClass }}">
                        <i class="fa-solid {{ $icon }}"></i>
                    </div>
                    <div class="min-w-0 flex-1">
                        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-1 sm:gap-4">
                            <p class="text-sm {{ $notification->unread() ? 'font-bold' : 'font-semibold' }} text-slate-900">
                                {{ data_get($notification->data, 'title', 'Notifikasi') }}
                            </p>
                            <span class="text-xs text-slate-400 whitespace-nowrap">
                                {{ $notification->created_at->locale('id')->diffForHumans() }}
                            </span>
                        </div>
                        <p class="text-sm text-slate-600 mt-1 break-words">
                            {{ data_get($notification->data, 'message', '-') }}
                        </p>
                        <div class="mt-2 flex flex-wrap items-center gap-x-4 gap-y-1 text-xs text-slate-500">
                            @if(data_get($notification->data, 'store_label'))
                                <span><i class="fa-solid fa-store mr-1"></i>{{ data_get($notification->data, 'store_label') }}</span>
                            @endif
                            <span><i class="fa-solid fa-user mr-1"></i>{{ data_get($notification->data, 'actor_name', 'Sistem') }}</span>
                            @if($notification->unread())
                                <span class="font-semibold text-blue-600">Belum dibaca</span>
                            @endif
                        </div>
                    </div>
                    <i class="fa-solid fa-chevron-right text-slate-300 mt-3"></i>
                </div>
            </button>
        </form>
    @empty
        <div class="px-6 py-16 text-center">
            <div class="w-14 h-14 rounded-lg bg-slate-100 text-slate-400 flex items-center justify-center mx-auto">
                <i class="fa-regular fa-bell-slash text-xl"></i>
            </div>
            <p class="font-semibold text-slate-700 mt-4">Belum ada notifikasi</p>
            <p class="text-sm text-slate-500 mt-1">Aktivitas terbaru akan muncul secara otomatis.</p>
        </div>
    @endforelse
</div>

@if($notifications->hasPages())
    <div class="mt-6">
        {{ $notifications->links() }}
    </div>
@endif
@endsection
