<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
/**
 * Description of Carpool
 *
 * @author User
 */
class Carpool extends Model {
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'carpools';
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['start_time', 'return_time','user_id','from_location',
        'from_location_id','to_location', 'to_location_id', 'details','regpart1',
        'regpart2','user_type','pool_type','journey_date','price'];
    public function user(){
         return $this->belongsTo('App\User', 'user_id');
    }
    
    public function fromLocation(){
         return $this->belongsTo('App\Location', 'from_location_id');
    }
    
    public function toLocation(){
         return $this->belongsTo('App\Location', 'to_location_id');
    }
    
    
}