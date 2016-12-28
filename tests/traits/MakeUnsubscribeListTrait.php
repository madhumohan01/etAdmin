<?php

use Faker\Factory as Faker;
use App\Models\UnsubscribeList;
use App\Repositories\UnsubscribeListRepository;

trait MakeUnsubscribeListTrait
{
    /**
     * Create fake instance of UnsubscribeList and save it in database
     *
     * @param array $unsubscribeListFields
     * @return UnsubscribeList
     */
    public function makeUnsubscribeList($unsubscribeListFields = [])
    {
        /** @var UnsubscribeListRepository $unsubscribeListRepo */
        $unsubscribeListRepo = App::make(UnsubscribeListRepository::class);
        $theme = $this->fakeUnsubscribeListData($unsubscribeListFields);
        return $unsubscribeListRepo->create($theme);
    }

    /**
     * Get fake instance of UnsubscribeList
     *
     * @param array $unsubscribeListFields
     * @return UnsubscribeList
     */
    public function fakeUnsubscribeList($unsubscribeListFields = [])
    {
        return new UnsubscribeList($this->fakeUnsubscribeListData($unsubscribeListFields));
    }

    /**
     * Get fake data of UnsubscribeList
     *
     * @param array $postFields
     * @return array
     */
    public function fakeUnsubscribeListData($unsubscribeListFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'company_name' => $fake->word,
            'email' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $unsubscribeListFields);
    }
}
