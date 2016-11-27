<?php

use Faker\Factory as Faker;
use App\Models\APosts;
use App\Repositories\APostsRepository;

trait MakeAPostsTrait
{
    /**
     * Create fake instance of APosts and save it in database
     *
     * @param array $aPostsFields
     * @return APosts
     */
    public function makeAPosts($aPostsFields = [])
    {
        /** @var APostsRepository $aPostsRepo */
        $aPostsRepo = App::make(APostsRepository::class);
        $theme = $this->fakeAPostsData($aPostsFields);
        return $aPostsRepo->create($theme);
    }

    /**
     * Get fake instance of APosts
     *
     * @param array $aPostsFields
     * @return APosts
     */
    public function fakeAPosts($aPostsFields = [])
    {
        return new APosts($this->fakeAPostsData($aPostsFields));
    }

    /**
     * Get fake data of APosts
     *
     * @param array $postFields
     * @return array
     */
    public function fakeAPostsData($aPostsFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'place_id' => $fake->randomDigitNotNull,
            'section_id' => $fake->randomDigitNotNull,
            'post_id' => $fake->word,
            'post_date' => $fake->date('Y-m-d H:i:s'),
            'heading' => $fake->word,
            'description' => $fake->word,
            'job_link' => $fake->word,
            'ignore_flg' => $fake->word,
            'email_addr' => $fake->word,
            'email_id' => $fake->randomDigitNotNull,
            'resp_received' => $fake->word,
            'bad_action' => $fake->word,
            'status' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'deleted_at' => $fake->date('Y-m-d H:i:s')
        ], $aPostsFields);
    }
}
