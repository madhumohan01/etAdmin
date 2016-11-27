<?php

use App\Models\Section;
use App\Repositories\SectionRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SectionRepositoryTest extends TestCase
{
    use MakeSectionTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var SectionRepository
     */
    protected $sectionRepo;

    public function setUp()
    {
        parent::setUp();
        $this->sectionRepo = App::make(SectionRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateSection()
    {
        $section = $this->fakeSectionData();
        $createdSection = $this->sectionRepo->create($section);
        $createdSection = $createdSection->toArray();
        $this->assertArrayHasKey('id', $createdSection);
        $this->assertNotNull($createdSection['id'], 'Created Section must have id specified');
        $this->assertNotNull(Section::find($createdSection['id']), 'Section with given id must be in DB');
        $this->assertModelData($section, $createdSection);
    }

    /**
     * @test read
     */
    public function testReadSection()
    {
        $section = $this->makeSection();
        $dbSection = $this->sectionRepo->find($section->id);
        $dbSection = $dbSection->toArray();
        $this->assertModelData($section->toArray(), $dbSection);
    }

    /**
     * @test update
     */
    public function testUpdateSection()
    {
        $section = $this->makeSection();
        $fakeSection = $this->fakeSectionData();
        $updatedSection = $this->sectionRepo->update($fakeSection, $section->id);
        $this->assertModelData($fakeSection, $updatedSection->toArray());
        $dbSection = $this->sectionRepo->find($section->id);
        $this->assertModelData($fakeSection, $dbSection->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteSection()
    {
        $section = $this->makeSection();
        $resp = $this->sectionRepo->delete($section->id);
        $this->assertTrue($resp);
        $this->assertNull(Section::find($section->id), 'Section should not exist in DB');
    }
}
