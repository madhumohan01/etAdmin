<?php

use Faker\Factory as Faker;
use App\Models\Place;
use App\Repositories\PlaceRepository;

trait MakePlaceTrait
{
    /**
     * Create fake instance of Place and save it in database
     *
     * @param array $placeFields
     * @return Place
     */
    public function makePlace($placeFields = [])
    {
        /** @var PlaceRepository $placeRepo */
        $placeRepo = App::make(PlaceRepository::class);
        $theme = $this->fakePlaceData($placeFields);
        return $placeRepo->create($theme);
    }

    /**
     * Get fake instance of Place
     *
     * @param array $placeFields
     * @return Place
     */
    public function fakePlace($placeFields = [])
    {
        return new Place($this->fakePlaceData($placeFields));
    }

    /**
     * Get fake data of Place
     *
     * @param array $postFields
     * @return array
     */
    public function fakePlaceData($placeFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'url' => $fake->word,
            'status' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'deleted_at' => $fake->date('Y-m-d H:i:s')
        ], $placeFields);
    }
}
