<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="APosts",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="place_id",
 *          description="place_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="section_id",
 *          description="section_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="post_id",
 *          description="post_id",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="heading",
 *          description="heading",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="description",
 *          description="description",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="job_link",
 *          description="job_link",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="email_addr",
 *          description="email_addr",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="email_id",
 *          description="email_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="bad_action",
 *          description="bad_action",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="status",
 *          description="status",
 *          type="string"
 *      )
 * )
 */
class APosts extends Model
{
    use SoftDeletes;

    public $table = 'posts';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'place_id',
        'section_id',
        'post_id',
        'post_date',
        'heading',
        'description',
        'job_link',
        'ignore_flg',
        'email_addr',
        'email_id',
        'resp_received',
        'bad_action',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'place_id' => 'integer',
        'section_id' => 'integer',
        'post_id' => 'string',
        'heading' => 'string',
        'description' => 'string',
        'job_link' => 'string',
        'email_addr' => 'string',
        'email_id' => 'integer',
        'bad_action' => 'string',
        'status' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function email()
    {
        return $this->belongsTo(\App\Models\Email::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function place()
    {
        return $this->belongsTo(\App\Models\Place::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function keyword()
    {
        return $this->belongsTo(\App\Models\Keyword::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function section()
    {
        return $this->belongsTo(\App\Models\Section::class);
    }
}
