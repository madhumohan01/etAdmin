<?php

namespace App\Repositories;

use App\Models\UnsubscribeList;
use InfyOm\Generator\Common\BaseRepository;

class UnsubscribeListRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'company_name',
        'email'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UnsubscribeList::class;
    }
}
