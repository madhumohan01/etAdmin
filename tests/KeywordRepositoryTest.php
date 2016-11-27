<?php

use App\Models\Keyword;
use App\Repositories\KeywordRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class KeywordRepositoryTest extends TestCase
{
    use MakeKeywordTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var KeywordRepository
     */
    protected $keywordRepo;

    public function setUp()
    {
        parent::setUp();
        $this->keywordRepo = App::make(KeywordRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateKeyword()
    {
        $keyword = $this->fakeKeywordData();
        $createdKeyword = $this->keywordRepo->create($keyword);
        $createdKeyword = $createdKeyword->toArray();
        $this->assertArrayHasKey('id', $createdKeyword);
        $this->assertNotNull($createdKeyword['id'], 'Created Keyword must have id specified');
        $this->assertNotNull(Keyword::find($createdKeyword['id']), 'Keyword with given id must be in DB');
        $this->assertModelData($keyword, $createdKeyword);
    }

    /**
     * @test read
     */
    public function testReadKeyword()
    {
        $keyword = $this->makeKeyword();
        $dbKeyword = $this->keywordRepo->find($keyword->id);
        $dbKeyword = $dbKeyword->toArray();
        $this->assertModelData($keyword->toArray(), $dbKeyword);
    }

    /**
     * @test update
     */
    public function testUpdateKeyword()
    {
        $keyword = $this->makeKeyword();
        $fakeKeyword = $this->fakeKeywordData();
        $updatedKeyword = $this->keywordRepo->update($fakeKeyword, $keyword->id);
        $this->assertModelData($fakeKeyword, $updatedKeyword->toArray());
        $dbKeyword = $this->keywordRepo->find($keyword->id);
        $this->assertModelData($fakeKeyword, $dbKeyword->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteKeyword()
    {
        $keyword = $this->makeKeyword();
        $resp = $this->keywordRepo->delete($keyword->id);
        $this->assertTrue($resp);
        $this->assertNull(Keyword::find($keyword->id), 'Keyword should not exist in DB');
    }
}
