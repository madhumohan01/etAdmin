<?php

namespace App\Repositories;

use App\Models\Keyword;
use InfyOm\Generator\Common\BaseRepository;

class KeywordRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
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
     * Configure the Model
     **/
    public function model()
    {
        return Keyword::class;
    }
}
