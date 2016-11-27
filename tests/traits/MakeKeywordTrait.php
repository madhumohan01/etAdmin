<?php

use Faker\Factory as Faker;
use App\Models\Keyword;
use App\Repositories\KeywordRepository;

trait MakeKeywordTrait
{
    /**
     * Create fake instance of Keyword and save it in database
     *
     * @param array $keywordFields
     * @return Keyword
     */
    public function makeKeyword($keywordFields = [])
    {
        /** @var KeywordRepository $keywordRepo */
        $keywordRepo = App::make(KeywordRepository::class);
        $theme = $this->fakeKeywordData($keywordFields);
        return $keywordRepo->create($theme);
    }

    /**
     * Get fake instance of Keyword
     *
     * @param array $keywordFields
     * @return Keyword
     */
    public function fakeKeyword($keywordFields = [])
    {
        return new Keyword($this->fakeKeywordData($keywordFields));
    }

    /**
     * Get fake data of Keyword
     *
     * @param array $postFields
     * @return array
     */
    public function fakeKeywordData($keywordFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'tech_name' => $fake->word,
            'tech_type' => $fake->word,
            'tech_text_1' => $fake->word,
            'tech_text_2' => $fake->word,
            'tech_text_3' => $fake->word,
            'tech_text_4' => $fake->word,
            'tech_text_5' => $fake->word,
            'seq_no' => $fake->randomDigitNotNull,
            'status' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'deleted_at' => $fake->date('Y-m-d H:i:s')
        ], $keywordFields);
    }
}
