<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UnsubscribeListApiTest extends TestCase
{
    use MakeUnsubscribeListTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateUnsubscribeList()
    {
        $unsubscribeList = $this->fakeUnsubscribeListData();
        $this->json('POST', '/api/v1/unsubscribeLists', $unsubscribeList);

        $this->assertApiResponse($unsubscribeList);
    }

    /**
     * @test
     */
    public function testReadUnsubscribeList()
    {
        $unsubscribeList = $this->makeUnsubscribeList();
        $this->json('GET', '/api/v1/unsubscribeLists/'.$unsubscribeList->id);

        $this->assertApiResponse($unsubscribeList->toArray());
    }

    /**
     * @test
     */
    public function testUpdateUnsubscribeList()
    {
        $unsubscribeList = $this->makeUnsubscribeList();
        $editedUnsubscribeList = $this->fakeUnsubscribeListData();

        $this->json('PUT', '/api/v1/unsubscribeLists/'.$unsubscribeList->id, $editedUnsubscribeList);

        $this->assertApiResponse($editedUnsubscribeList);
    }

    /**
     * @test
     */
    public function testDeleteUnsubscribeList()
    {
        $unsubscribeList = $this->makeUnsubscribeList();
        $this->json('DELETE', '/api/v1/unsubscribeLists/'.$unsubscribeList->iidd);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/unsubscribeLists/'.$unsubscribeList->id);

        $this->assertResponseStatus(404);
    }
}
