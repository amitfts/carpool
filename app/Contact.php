<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
/**
 * Description of Carpool
 *
 * @author User
 */
class Contact extends Model {
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'contacts';
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email','mobile','subject','message'];
    
    
}