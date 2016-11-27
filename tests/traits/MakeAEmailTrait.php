<?php

use Faker\Factory as Faker;
use App\Models\AEmail;
use App\Repositories\AEmailRepository;

trait MakeAEmailTrait
{
    /**
     * Create fake instance of AEmail and save it in database
     *
     * @param array $aEmailFields
     * @return AEmail
     */
    public function makeAEmail($aEmailFields = [])
    {
        /** @var AEmailRepository $aEmailRepo */
        $aEmailRepo = App::make(AEmailRepository::class);
        $theme = $this->fakeAEmailData($aEmailFields);
        return $aEmailRepo->create($theme);
    }

    /**
     * Get fake instance of AEmail
     *
     * @param array $aEmailFields
     * @return AEmail
     */
    public function fakeAEmail($aEmailFields = [])
    {
        return new AEmail($this->fakeAEmailData($aEmailFields));
    }

    /**
     * Get fake data of AEmail
     *
     * @param array $postFields
     * @return array
     */
    public function fakeAEmailData($aEmailFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'view_name' => $fake->word,
            'status' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'deleted_at' => $fake->date('Y-m-d H:i:s')
        ], $aEmailFields);
    }
}
