<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;
use App\Carpool;
use Illuminate\Support\Facades\Auth;

class CarpoolController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Carpool Controller
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
        $this->middleware('auth');
    }

    public function create() {
        return view('carpool.create');
    }

    public function postcreate(Request $request) {
        try {

            $frmLocArr = ['locality' => $request->get('fromcity'),
                'district' => $request->get('fromdist'),
                'state' => $request->get('fromstate')];
            if(Location::where('locality',$request->get('fromcity'))->count()==0){
                $fromLocation = Location::firstOrCreate($frmLocArr);
            }else{
                $fromLocation = Location::where('locality',$request->get('fromcity'))->first();
            }
            
            
            $toLocArr = ['locality' => $request->get('tocity'),
                'district' => $request->get('todist'), 'state' => $request->get('tostate')];
            if(Location::where('locality',$request->get('tocity'))->count()==0){
                $toLocation = Location::firstOrCreate($toLocArr);
            }else{
                $toLocation = Location::where('locality',$request->get('tocity'))->first();
            }
            
            $poolType = $request->get('pool_type');

            $carArr = [
                'user_id' => Auth::id(),
                'from_location_id' => $fromLocation->id,
                'from_location' => $this->refineLocation($request->get('fromtxt')),
                'to_location_id' => $toLocation->id,
                'to_location' => $this->refineLocation($request->get('totxt')),
                'details' => $request->get('details'),
                'user_type' => $request->get('user_type')
            ];
            /*
             * O=> One Time
             * R=> Regular
             */
            if ($poolType == 'O') {
                $carArr['pool_type'] = 'O';
                $journyTime = strtotime($request->get('journey_date'));
                $carArr['journey_date'] = date('Y-m-d', $journyTime);
                $carArr['start_time'] = date('H:i', $journyTime);
                $carArr['price'] = $request->get('price');
            } else {
                $carArr['start_time'] = date('H:i', strtotime($request->get('from_time')));
                $carArr['return_time'] = date('H:i', strtotime($request->get('return_time')));
                $carArr['pool_type'] = 'R';
                $regNum = $request->get('reg_num');
                if ($regNum) {
                    $part2 = (int) substr($regNum, -4);
                    $part1 = strtoupper(substr($regNum, 0, -4));
                    if ($part2 > 0) {
                        $carArr['regpart1'] = $part1;
                        $carArr['regpart2'] = $part2;
                    }
                }
            }

            //print_r($carArr);die;
            $carpool = Carpool::firstOrCreate($carArr);
            return response()->json(['status' => true, 'message' => 'Carpool has been added successfully']);
        } catch (Exception $e) {
            //echo $e->getMessage();
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
    }

    public function mypools() {
        $userId = Auth::id();
        $carpoolCount = Carpool::where('user_id', $userId)->count();
        if ($carpoolCount == 0) {
            return redirect('new-carpool');
        }
        $carpools = Carpool::where('user_id', $userId)->orderBy('id', 'desc')->get();
        $view = [
            'title' => 'My Carpool',
            'metaKey' => 'My Carpools',
            'metaDesc' => '',
            'carpools' => $carpools,
            'me' => 1
        ];
        return view('carpool.list', $view);
    }

    public function refineLocation($location) {
        $locationArr = explode(', ', $location);
        array_pop($locationArr); //Removing country
        array_pop($locationArr); //Removing State
        $updatedLocation = implode(', ', $locationArr);
        return $updatedLocation;
    }

}
