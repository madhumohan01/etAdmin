<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class APostsApiTest extends TestCase
{
    use MakeAPostsTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateAPosts()
    {
        $aPosts = $this->fakeAPostsData();
        $this->json('POST', '/api/v1/aPosts', $aPosts);

        $this->assertApiResponse($aPosts);
    }

    /**
     * @test
     */
    public function testReadAPosts()
    {
        $aPosts = $this->makeAPosts();
        $this->json('GET', '/api/v1/aPosts/'.$aPosts->id);

        $this->assertApiResponse($aPosts->toArray());
    }

    /**
     * @test
     */
    public function testUpdateAPosts()
    {
        $aPosts = $this->makeAPosts();
        $editedAPosts = $this->fakeAPostsData();

        $this->json('PUT', '/api/v1/aPosts/'.$aPosts->id, $editedAPosts);

        $this->assertApiResponse($editedAPosts);
    }

    /**
     * @test
     */
    public function testDeleteAPosts()
    {
        $aPosts = $this->makeAPosts();
        $this->json('DELETE', '/api/v1/aPosts/'.$aPosts->iidd);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/aPosts/'.$aPosts->id);

        $this->assertResponseStatus(404);
    }
}
