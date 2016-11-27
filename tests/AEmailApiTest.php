<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AEmailApiTest extends TestCase
{
    use MakeAEmailTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateAEmail()
    {
        $aEmail = $this->fakeAEmailData();
        $this->json('POST', '/api/v1/aEmails', $aEmail);

        $this->assertApiResponse($aEmail);
    }

    /**
     * @test
     */
    public function testReadAEmail()
    {
        $aEmail = $this->makeAEmail();
        $this->json('GET', '/api/v1/aEmails/'.$aEmail->id);

        $this->assertApiResponse($aEmail->toArray());
    }

    /**
     * @test
     */
    public function testUpdateAEmail()
    {
        $aEmail = $this->makeAEmail();
        $editedAEmail = $this->fakeAEmailData();

        $this->json('PUT', '/api/v1/aEmails/'.$aEmail->id, $editedAEmail);

        $this->assertApiResponse($editedAEmail);
    }

    /**
     * @test
     */
    public function testDeleteAEmail()
    {
        $aEmail = $this->makeAEmail();
        $this->json('DELETE', '/api/v1/aEmails/'.$aEmail->iidd);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/aEmails/'.$aEmail->id);

        $this->assertResponseStatus(404);
    }
}
