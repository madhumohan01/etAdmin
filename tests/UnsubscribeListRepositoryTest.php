<?php

use App\Models\UnsubscribeList;
use App\Repositories\UnsubscribeListRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UnsubscribeListRepositoryTest extends TestCase
{
    use MakeUnsubscribeListTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var UnsubscribeListRepository
     */
    protected $unsubscribeListRepo;

    public function setUp()
    {
        parent::setUp();
        $this->unsubscribeListRepo = App::make(UnsubscribeListRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateUnsubscribeList()
    {
        $unsubscribeList = $this->fakeUnsubscribeListData();
        $createdUnsubscribeList = $this->unsubscribeListRepo->create($unsubscribeList);
        $createdUnsubscribeList = $createdUnsubscribeList->toArray();
        $this->assertArrayHasKey('id', $createdUnsubscribeList);
        $this->assertNotNull($createdUnsubscribeList['id'], 'Created UnsubscribeList must have id specified');
        $this->assertNotNull(UnsubscribeList::find($createdUnsubscribeList['id']), 'UnsubscribeList with given id must be in DB');
        $this->assertModelData($unsubscribeList, $createdUnsubscribeList);
    }

    /**
     * @test read
     */
    public function testReadUnsubscribeList()
    {
        $unsubscribeList = $this->makeUnsubscribeList();
        $dbUnsubscribeList = $this->unsubscribeListRepo->find($unsubscribeList->id);
        $dbUnsubscribeList = $dbUnsubscribeList->toArray();
        $this->assertModelData($unsubscribeList->toArray(), $dbUnsubscribeList);
    }

    /**
     * @test update
     */
    public function testUpdateUnsubscribeList()
    {
        $unsubscribeList = $this->makeUnsubscribeList();
        $fakeUnsubscribeList = $this->fakeUnsubscribeListData();
        $updatedUnsubscribeList = $this->unsubscribeListRepo->update($fakeUnsubscribeList, $unsubscribeList->id);
        $this->assertModelData($fakeUnsubscribeList, $updatedUnsubscribeList->toArray());
        $dbUnsubscribeList = $this->unsubscribeListRepo->find($unsubscribeList->id);
        $this->assertModelData($fakeUnsubscribeList, $dbUnsubscribeList->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteUnsubscribeList()
    {
        $unsubscribeList = $this->makeUnsubscribeList();
        $resp = $this->unsubscribeListRepo->delete($unsubscribeList->id);
        $this->assertTrue($resp);
        $this->assertNull(UnsubscribeList::find($unsubscribeList->id), 'UnsubscribeList should not exist in DB');
    }
}
