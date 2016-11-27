<?php

use App\Models\AEmail;
use App\Repositories\AEmailRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AEmailRepositoryTest extends TestCase
{
    use MakeAEmailTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var AEmailRepository
     */
    protected $aEmailRepo;

    public function setUp()
    {
        parent::setUp();
        $this->aEmailRepo = App::make(AEmailRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateAEmail()
    {
        $aEmail = $this->fakeAEmailData();
        $createdAEmail = $this->aEmailRepo->create($aEmail);
        $createdAEmail = $createdAEmail->toArray();
        $this->assertArrayHasKey('id', $createdAEmail);
        $this->assertNotNull($createdAEmail['id'], 'Created AEmail must have id specified');
        $this->assertNotNull(AEmail::find($createdAEmail['id']), 'AEmail with given id must be in DB');
        $this->assertModelData($aEmail, $createdAEmail);
    }

    /**
     * @test read
     */
    public function testReadAEmail()
    {
        $aEmail = $this->makeAEmail();
        $dbAEmail = $this->aEmailRepo->find($aEmail->id);
        $dbAEmail = $dbAEmail->toArray();
        $this->assertModelData($aEmail->toArray(), $dbAEmail);
    }

    /**
     * @test update
     */
    public function testUpdateAEmail()
    {
        $aEmail = $this->makeAEmail();
        $fakeAEmail = $this->fakeAEmailData();
        $updatedAEmail = $this->aEmailRepo->update($fakeAEmail, $aEmail->id);
        $this->assertModelData($fakeAEmail, $updatedAEmail->toArray());
        $dbAEmail = $this->aEmailRepo->find($aEmail->id);
        $this->assertModelData($fakeAEmail, $dbAEmail->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteAEmail()
    {
        $aEmail = $this->makeAEmail();
        $resp = $this->aEmailRepo->delete($aEmail->id);
        $this->assertTrue($resp);
        $this->assertNull(AEmail::find($aEmail->id), 'AEmail should not exist in DB');
    }
}
