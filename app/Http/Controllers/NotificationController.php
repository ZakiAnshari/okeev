<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class NotificationController extends Controller
{
    public function poll(Request $request)
    {
        $userId = Auth::id();
        if (!$userId) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        $orders = Order::where('user_id', $userId)
            ->where(function ($q) {
                $q->whereIn('status', ['PENDING', 'Failed', 'Completed'])
                  ->orWhereIn('status_transaksi', ['PENDING', 'Failed', 'Completed']);
            })
            ->whereRaw("LOWER(COALESCE(status,'')) != 'cancelled'")
            ->whereRaw("LOWER(COALESCE(status_transaksi,'')) != 'cancelled'")
            ->with('product')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        $data = $orders->map(function ($o) {
            return [
                'id' => $o->id,
                'model_name' => $o->model_name,
                'qty' => $o->qty,
                'grand_total' => $o->grand_total,
                'status' => $o->status,
                'status_transaksi' => $o->status_transaksi ?? null,
                'external_id' => $o->external_id,
                'created_at_human' => optional($o->created_at)->diffForHumans(),
            ];
        });

        $notifCount = $orders->count();

        return response()->json([
            'notifCount' => $notifCount,
            'orders' => $data,
        ]);
    }
}
