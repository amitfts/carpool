<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;
use App\Carpool;
use App\Contact;
use DB;

class HomeController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Home Controller
      |--------------------------------------------------------------------------
      |
      | This controller renders your application's "dashboard" for users that
      | are authenticated. Of course, you are free to change or remove the
      | controller as you wish. It is just here to get your app started!
      |
     */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        
    }

    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function index() {
        $locations = Location::get();
        $carpools = Carpool::orderBy('id', 'desc')->limit(20)->get();
        $view = [
            'title' => 'Carpooling rideshare ',
            'metaKey' => "",
            'metaDesc' => 'Save petrol and money by carpooling in sameroute.in',
            'locations' => $locations,
            'carpools' => $carpools
        ];
        return view('home', $view);
    }

    public function fromLocation($locality) {
        $locCount = $location = Location::where('locality', $locality)->count();
        if ($locCount ==1) {
            $location = Location::where('locality', $locality)->first();
        } else {
            $location = Location::where('district', $locality)->first();
        }

        if (is_object($location) && is_int($location->id)) {
            $fromLoc = DB::table('carpools')
                    ->join('locations', 'carpools.to_location_id', '=', 'locations.id')
                    ->where('carpools.from_location_id', $location->id)
                    ->select('locations.locality', 'locations.district')
                    ->groupBy('carpools.to_location_id')
                    ->get();

            $view = [
                'title' => 'Carpool from ' . $location->getFinalLocality(),
                'metaKey' => 'carpool from ' . $location->locality . ', rideshare in ' . $location->locality . ', ',
                'metaDesc' => 'carpool from ' . $location->locality . '. ',
                'location' => $location, 'fromLoc' => $fromLoc
            ];
            return view('carpool.from', $view);
        } else {
            abort(404, 'Page not found');
        }
    }

    public function inLocation($locality) {
        $locCount = $location = Location::where('locality', $locality)->count();
        if ($locCount == 1) {
            $location = Location::where('locality', $locality)->first();
        } else {
            $location = Location::where('district', $locality)->first();
        }

        if (is_object($location) && is_int($location->id)) {
            $fromLoc = DB::table('carpools')
                    ->join('locations', 'carpools.to_location_id', '=', 'locations.id')
                    ->where('carpools.from_location_id', $location->id)
                    ->select('locations.locality', 'locations.district')
                    ->groupBy('carpools.to_location_id')
                    ->get();
            $toLoc = DB::table('carpools')
                    ->join('locations', 'carpools.from_location_id', '=', 'locations.id')
                    ->where('carpools.to_location_id', $location->id)
                    ->select('locations.locality', 'locations.district')
                    ->groupBy('carpools.from_location_id')
                    ->get();

            $view = [
                'title' => 'Carpool from and to  ' . $location->locality,
                'metaKey' => 'carpool from and to  ' . $location->locality . ', rideshare in ' . $location->locality . ', ',
                'metaDesc' => 'carpool from and to  ' . $location->locality . '. ',
                'location' => $location, 'fromLoc' => $fromLoc, 'toLoc' => $toLoc
            ];
            return view('carpool.fromto', $view);
        }
    }

    public function fromToLocation($from, $to) {
        $fromLocCnt = Location::where('locality', $from)->count();
        if ($fromLocCnt == 1) {
            $fromLoc = Location::where('locality', $from)->first();
        } else {
            $fromLoc = Location::where('district', $from)->first();
        }
        $toLocCnt = Location::where('locality', $to)->count();
        if ($toLocCnt == 1) {
            $toLoc = Location::where('locality', $to)->first();
        } else {
            $toLoc = Location::where('district', $to)->first();
        }

        if (is_object($toLoc) && is_int($toLoc->id) && is_object($fromLoc) && is_int($fromLoc->id)) {
            $carpools = Carpool::where('from_location_id', $fromLoc->id)
                    ->where('to_location_id', $toLoc->id)
                    ->orderBy('id', 'desc')
                    ->get();
            $strFrmTo = 'from ' . $fromLoc->getFinalLocality() . ' to ' . $toLoc->getFinalLocality();
            $view = [
                'title' => 'Carpool ' . $strFrmTo,
                'metaKey' => 'carpool ' . $strFrmTo . ', rideshare ' . $strFrmTo . ', ',
                'metaDesc' => 'carpool ' . $strFrmTo . '. ',
                'carpools' => $carpools,
                'fromLoc' => $fromLoc->getFinalLocality()
            ];
            return view('carpool.list', $view);
        } else {
            abort(404, 'Page not found');
        }
    }

    public function details($carpoolId, $from, $to) {
        $carpool = Carpool::find($carpoolId);
        if ($carpool && strtolower($carpool->from_location) == urldecode(str_replace('_','-',$from))) {
            $strFrmTo = str_replace(',', '-', 'from ' . $carpool->from_location . ' to ' . $carpool->to_location);
            $name = $carpool->user->name;
            $key = '';
            if ($carpool->regpart2 == null || $carpool->regpart2 == 0) {
                $key = 'Regular';
            } elseif ($carpool->regpart2 % 2 === 1) {
                $key = 'Odd';
            } else {
                $key = 'Even';
            }

            $view = [
                'title' => $key . ' carpool ' . $strFrmTo . ' ' . $carpool->id,
                'metaKey' => 'carpool ' . $strFrmTo . 'by ' . $name . ', rideshare ' . $strFrmTo . ', ',
                'metaDesc' => $carpool->details,
                'carpool' => $carpool
            ];
            return view('carpool.details', $view);
        } else {
            abort(404, 'Page not found');
        }
    }

    public function search(Request $request) {
        $from = trim($request->get('from'));
        $to = trim($request->get('to'));
        $view = [
            'title' => 'Carpool Search',
            'metaKey' => 'Search Carpool and people on same route, ',
            'metaDesc' => 'Search carpool and people who are traveling in same route. ',
        ];
        if ($from && $to && strlen($from) > 2 && strlen($to) > 2) {
            $view = [
                'title' => 'Carpool Search from ' . $from . ' to ' . $to,
                'metaKey' => 'Search Carpool and people in sameroute ' . $from . ' to ' . $to . ', ',
                'metaDesc' => 'Search carpool and people who are traveling in same route ' . $from . ' to ' . $to . '. ',
            ];
            $carpools = Carpool::where('from_location', 'like', '%' . $from . '%')
                    ->where('to_location', 'like', '%' . $to . '%')
                    ->orderBy('id', 'desc')
                    ->get();
            $view['carpools'] = $carpools;
            $view['from'] = $from;
            $view['to'] = $to;
        }

        return view('carpool.search', $view);
    }

    public function contact() {
        $view = [
            'title' => 'Contact Us',
            'metaKey' => 'Contact Us in sameroute.in, ',
            'metaDesc' => 'Your feedback is helpful to us to improve sameroute.in.Please give us your suggetion. ',
        ];
        return view('carpool.contact', $view);
    }

    public function postContact(Request $request) {
        $name = $request->get('name');
        $email = $request->get('email');
        $mobile = $request->get('mobile');
        $subject = $request->get('subject');
        $message = $request->get('message');
        $arr=['name'=>$name, 'email'=>$email, 'mobile'=>$mobile, 'subject'=>$subject, 'message'=>$message];
        Contact::firstOrCreate($arr);
        return response()->json(['status' => true, 'message' => 'Thanks for contact us']);
    }

    public function test() {
       $fromLocation = Location::where('locality','New Delhi')->first();
       echo $fromLocation->id;
        die;
    }

    public function upload() {
        die();
        $row = 1;
        $arr = [];
        if (($handle = fopen("locations-delhi.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $arr[] = $data;
            }
            fclose($handle);
        }
        $i = 1;
        $allowedArr = [4, 5, 6, 9, 13];
        $startTime = time();
        foreach ($arr as $k => $val) {
            foreach ($arr as $a => $v) {
                if (trim($val[0]) && trim($val[1]) && $v[0] && $v[1]) {
                    if (($val[1] != $v[1]) && in_array($val[1], $allowedArr)) {
                        $details = 'Post your own carpool to find people who travels from ' . $val[0] . ' to ' . $v[0] . '.';
                        $carArr = [
                            'user_id' => 1,
                            'from_location_id' => $val[1],
                            'from_location' => $val[0],
                            'to_location_id' => $v[1],
                            'to_location' => $v[0],
                            'start_time' => '08:00',
                            'return_time' => '18:00',
                            'details' => $details,
                            'user_type' => 'P',
                            'regpart1' => 'DL ' . ($i % 10) . 'CR',
                            'regpart2' => $i
                        ];
                        $i++;
                        $carpool = Carpool::create($carArr);
                        $carArr = [
                            'user_id' => 1,
                            'from_location_id' => $v[1],
                            'from_location' => $v[0],
                            'to_location_id' => $val[1],
                            'to_location' => $val[0],
                            'start_time' => '09:00',
                            'return_time' => '19:00',
                            'details' => $details,
                            'user_type' => 'P',
                            'regpart1' => 'DL ' . ($i % 10) . 'CR',
                            'regpart2' => $i
                        ];
                        $carpool = Carpool::create($carArr);
                        echo $details . "\n<br>";
                    }
                }
            }
        }
        $endTime = time();
        echo "Total time spend is :" . ($endTime - $startTime);
    }

}
