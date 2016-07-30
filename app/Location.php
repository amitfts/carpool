<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
/**
 * Description of Location
 *
 * @author Amit Garg
 */
class Location extends Model {
   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'locations';
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['locality', 'district','state'];
    
    public function getFinalLocality(){
        return $this->locality;
    }
    
}
