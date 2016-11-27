<?php

namespace App\Repositories;

use App\Models\AEmail;
use InfyOm\Generator\Common\BaseRepository;

class AEmailRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'view_name',
        'status'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return AEmail::class;
    }
}
