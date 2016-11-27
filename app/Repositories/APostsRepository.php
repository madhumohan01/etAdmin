<?php

namespace App\Repositories;

use App\Models\APosts;
use InfyOm\Generator\Common\BaseRepository;

class APostsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
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
     * Configure the Model
     **/
    public function model()
    {
        return APosts::class;
    }
}
