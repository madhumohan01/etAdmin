<?php

use App\Models\APosts;
use App\Repositories\APostsRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class APostsRepositoryTest extends TestCase
{
    use MakeAPostsTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var APostsRepository
     */
    protected $aPostsRepo;

    public function setUp()
    {
        parent::setUp();
        $this->aPostsRepo = App::make(APostsRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateAPosts()
    {
        $aPosts = $this->fakeAPostsData();
        $createdAPosts = $this->aPostsRepo->create($aPosts);
        $createdAPosts = $createdAPosts->toArray();
        $this->assertArrayHasKey('id', $createdAPosts);
        $this->assertNotNull($createdAPosts['id'], 'Created APosts must have id specified');
        $this->assertNotNull(APosts::find($createdAPosts['id']), 'APosts with given id must be in DB');
        $this->assertModelData($aPosts, $createdAPosts);
    }

    /**
     * @test read
     */
    public function testReadAPosts()
    {
        $aPosts = $this->makeAPosts();
        $dbAPosts = $this->aPostsRepo->find($aPosts->id);
        $dbAPosts = $dbAPosts->toArray();
        $this->assertModelData($aPosts->toArray(), $dbAPosts);
    }

    /**
     * @test update
     */
    public function testUpdateAPosts()
    {
        $aPosts = $this->makeAPosts();
        $fakeAPosts = $this->fakeAPostsData();
        $updatedAPosts = $this->aPostsRepo->update($fakeAPosts, $aPosts->id);
        $this->assertModelData($fakeAPosts, $updatedAPosts->toArray());
        $dbAPosts = $this->aPostsRepo->find($aPosts->id);
        $this->assertModelData($fakeAPosts, $dbAPosts->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteAPosts()
    {
        $aPosts = $this->makeAPosts();
        $resp = $this->aPostsRepo->delete($aPosts->id);
        $this->assertTrue($resp);
        $this->assertNull(APosts::find($aPosts->id), 'APosts should not exist in DB');
    }
}
