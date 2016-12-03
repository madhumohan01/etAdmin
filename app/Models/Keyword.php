<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Keyword",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="tech_name",
 *          description="tech_name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="tech_type",
 *          description="tech_type",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="tech_text_1",
 *          description="tech_text_1",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="tech_text_2",
 *          description="tech_text_2",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="tech_text_3",
 *          description="tech_text_3",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="tech_text_4",
 *          description="tech_text_4",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="tech_text_5",
 *          description="tech_text_5",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="seq_no",
 *          description="seq_no",
 *          type="number",
 *          format="float"
 *      ),
 *      @SWG\Property(
 *          property="status",
 *          description="status",
 *          type="string"
 *      )
 * )
 */
class Keyword extends Model
{
    use SoftDeletes;

    public $table = 'keywords';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'tech_name',
        'tech_type',
        'tech_text_1',
        'tech_text_2',
        'tech_text_3',
        'tech_text_4',
        'tech_text_5',
        'seq_no',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'tech_name' => 'string',
        'tech_type' => 'string',
        'tech_text_1' => 'string',
        'tech_text_2' => 'string',
        'tech_text_3' => 'string',
        'tech_text_4' => 'string',
        'tech_text_5' => 'string',
        'seq_no' => 'float',
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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function posts()
    {
        return $this->hasMany(\App\Models\APosts::class);
    }
}
