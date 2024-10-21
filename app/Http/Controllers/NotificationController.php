<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function fetchNotification()
    {
        $notifications = Notification::where('status', '0')->orderBy('created_at', 'desc')->get();
        $data = [
            'notification' => $notifications,
            'count' => $notifications->count(),
        ];
        

        return response()->json([
            'error' => false,
            'body' => $data,
            'status' => '200',
        ]);
    }

    public function readNotification(Request $request)
    {
        $id = $request->id;
        $notification = Notification::findOrFail($id);
        $notification->status = '1';
        $notification->save();

        return response()->json([
            'error' => false,
            'body' => 'Notification has been read',
            'status' => '200',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $notification = Notification::findOrFail($id);
        $notification->delete();

        return response()->json([
            'error' => false,
            'body' => 'Notification has been deleted',
            'status' => '200',
        ]);
    }
}