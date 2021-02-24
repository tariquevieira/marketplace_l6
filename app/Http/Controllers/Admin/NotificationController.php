<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function notifications()
    {
    	$unreadNotifcations = auth()->user()->unreadNotifications()->paginate(8);
    	return view('admin.notifications',compact('unreadNotifcations'));
    }
    public function readAll()
    {
    	$unreadNotifications = auth()->user()->unreadNotifications;
    	$unreadNotifications->each(function($notification){
    			$notification->markAsRead();
    	});

    	flash('Notificações lidas com sucesso')->success();
    	return redirect()->back();
    }
     public function read($notification)
    {
    	$notification = auth()->user()->notifications()->find($notification);
    	$notification->markAsRead();
    	flash('Notificação lida com sucesso')->success();
    	return redirect()->back();
    }
}
