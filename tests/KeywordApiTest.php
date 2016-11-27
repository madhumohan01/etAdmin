<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class KeywordApiTest extends TestCase
{
    use MakeKeywordTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateKeyword()
    {
        $keyword = $this->fakeKeywordData();
        $this->json('POST', '/api/v1/keywords', $keyword);

        $this->assertApiResponse($keyword);
    }

    /**
     * @test
     */
    public function testReadKeyword()
    {
        $keyword = $this->makeKeyword();
        $this->json('GET', '/api/v1/keywords/'.$keyword->id);

        $this->assertApiResponse($keyword->toArray());
    }

    /**
     * @test
     */
    public function testUpdateKeyword()
    {
        $keyword = $this->makeKeyword();
        $editedKeyword = $this->fakeKeywordData();

        $this->json('PUT', '/api/v1/keywords/'.$keyword->id, $editedKeyword);

        $this->assertApiResponse($editedKeyword);
    }

    /**
     * @test
     */
    public function testDeleteKeyword()
    {
        $keyword = $this->makeKeyword();
        $this->json('DELETE', '/api/v1/keywords/'.$keyword->iidd);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/keywords/'.$keyword->id);

        $this->assertResponseStatus(404);
    }
}
