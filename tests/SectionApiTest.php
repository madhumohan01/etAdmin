<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SectionApiTest extends TestCase
{
    use MakeSectionTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateSection()
    {
        $section = $this->fakeSectionData();
        $this->json('POST', '/api/v1/sections', $section);

        $this->assertApiResponse($section);
    }

    /**
     * @test
     */
    public function testReadSection()
    {
        $section = $this->makeSection();
        $this->json('GET', '/api/v1/sections/'.$section->id);

        $this->assertApiResponse($section->toArray());
    }

    /**
     * @test
     */
    public function testUpdateSection()
    {
        $section = $this->makeSection();
        $editedSection = $this->fakeSectionData();

        $this->json('PUT', '/api/v1/sections/'.$section->id, $editedSection);

        $this->assertApiResponse($editedSection);
    }

    /**
     * @test
     */
    public function testDeleteSection()
    {
        $section = $this->makeSection();
        $this->json('DELETE', '/api/v1/sections/'.$section->iidd);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/sections/'.$section->id);

        $this->assertResponseStatus(404);
    }
}
