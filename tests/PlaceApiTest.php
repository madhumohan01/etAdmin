<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PlaceApiTest extends TestCase
{
    use MakePlaceTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatePlace()
    {
        $place = $this->fakePlaceData();
        $this->json('POST', '/api/v1/places', $place);

        $this->assertApiResponse($place);
    }

    /**
     * @test
     */
    public function testReadPlace()
    {
        $place = $this->makePlace();
        $this->json('GET', '/api/v1/places/'.$place->id);

        $this->assertApiResponse($place->toArray());
    }

    /**
     * @test
     */
    public function testUpdatePlace()
    {
        $place = $this->makePlace();
        $editedPlace = $this->fakePlaceData();

        $this->json('PUT', '/api/v1/places/'.$place->id, $editedPlace);

        $this->assertApiResponse($editedPlace);
    }

    /**
     * @test
     */
    public function testDeletePlace()
    {
        $place = $this->makePlace();
        $this->json('DELETE', '/api/v1/places/'.$place->iidd);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/places/'.$place->id);

        $this->assertResponseStatus(404);
    }
}
