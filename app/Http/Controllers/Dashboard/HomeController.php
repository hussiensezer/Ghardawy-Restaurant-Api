<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Customer;
use App\Models\Menu;
use App\Models\Order;
use App\Models\Owner;
use App\Models\Place;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home() {
        $todayMenus =  Menu::where("created_at",">=", Carbon::today())->count();
        $customers = Customer::count();
        $ordersToday =  Order::where("created_at",">=", Carbon::today())->count();
        $places = Place::count();
        $owners = Owner::count();
        $totalOrdersToday = Order::where("created_at",">=", Carbon::today())->sum('total_price');
        $allOrders = Order::count();
        $totalOrders = Order::sum('total_price');

            $data = [
                'todayMenus' => $todayMenus,
                'customers' =>$customers,
                'ordersToday'  => $ordersToday,
                'places'    => $places,
                'owners'    => $owners,
                'totalOrdersToday' => $totalOrdersToday,
                'allOrders' => $allOrders,
                'totalOrders'   => $totalOrders,
            ];
        return view("dashboard.home", $data);
    }

//    public function send(Request $request) {
//        $user = Admin::where('id', auth()->user()->id)->get();
//
//        $SERVER_API_KEY = env('FCM_SERVER_KEY');
//
//        $data = [
//            "registration_ids" => auth()->user()->id,
//            "notification" => [
//                "title" => $request->title,
//                "body" => $request->body,
//            ]
//        ];
//        $dataString = json_encode($data);
//
//        $headers = [
//            'Authorization: key=' . $SERVER_API_KEY,
//            'Content-Type: application/json',
//        ];
//
//
//        $ch = curl_init();
//
//        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
//        curl_setopt($ch, CURLOPT_POST, true);
//        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
//
//        $response = curl_exec($ch);
//
//        return back()->with('success', 'Notification send successfully.');
//    }
}
