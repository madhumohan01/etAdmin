<?php

use App\Models\Place;
use App\Repositories\PlaceRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PlaceRepositoryTest extends TestCase
{
    use MakePlaceTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var PlaceRepository
     */
    protected $placeRepo;

    public function setUp()
    {
        parent::setUp();
        $this->placeRepo = App::make(PlaceRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatePlace()
    {
        $place = $this->fakePlaceData();
        $createdPlace = $this->placeRepo->create($place);
        $createdPlace = $createdPlace->toArray();
        $this->assertArrayHasKey('id', $createdPlace);
        $this->assertNotNull($createdPlace['id'], 'Created Place must have id specified');
        $this->assertNotNull(Place::find($createdPlace['id']), 'Place with given id must be in DB');
        $this->assertModelData($place, $createdPlace);
    }

    /**
     * @test read
     */
    public function testReadPlace()
    {
        $place = $this->makePlace();
        $dbPlace = $this->placeRepo->find($place->id);
        $dbPlace = $dbPlace->toArray();
        $this->assertModelData($place->toArray(), $dbPlace);
    }

    /**
     * @test update
     */
    public function testUpdatePlace()
    {
        $place = $this->makePlace();
        $fakePlace = $this->fakePlaceData();
        $updatedPlace = $this->placeRepo->update($fakePlace, $place->id);
        $this->assertModelData($fakePlace, $updatedPlace->toArray());
        $dbPlace = $this->placeRepo->find($place->id);
        $this->assertModelData($fakePlace, $dbPlace->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletePlace()
    {
        $place = $this->makePlace();
        $resp = $this->placeRepo->delete($place->id);
        $this->assertTrue($resp);
        $this->assertNull(Place::find($place->id), 'Place should not exist in DB');
    }
}
