<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;

// Model Usage
use App\Booking;

class APIController extends Controller
{

    // Get available days
    function GetAvailableDays($ad_id) {

        $bookings=Booking::where('ads_id',$ad_id)->whereBetween('book_date', [date('Y-m-d'), date('Y-m-d', strtotime(date('Y-m-d') . '+30 day'))])->lists('book_date');
        //dd($bookings);
        for($i=1;$i<=30;$i++){

           $d= date('Y-m-d', strtotime(date('Y-m-d') . '+'.$i.' day'));
            if (!in_array($d, $bookings->toArray())) {
                    
            
            $date[]=$d;//date('Y-m-d H:i:s', strtotime(date('Y-m-d') . '+'.$i.' day'));
        }
        }
        return response()->json($date);
    }
  
}

