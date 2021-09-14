<?php
/**
 * Model object generated by: Skipper (http://www.skipper18.com)
 * Do not modify this file manually.
 */

namespace App\Models\AbstractModels;

use Illuminate\Database\Eloquent\Model;

abstract class AbstractApplication extends Model
{
    /**  
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'applications';
    
    /**  
     * Primary key type.
     * 
     * @var string
     */
    protected $keyType = 'bigInteger';
    
    /**  
     * The attributes that should be cast to native types.
     * 
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'description' => 'string',
        'startDate' => 'string',
        'document' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
}