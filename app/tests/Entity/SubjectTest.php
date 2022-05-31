<?php


namespace Tests\Entity;

use App\Entity\Project;
use App\Entity\Subject;
use PHPUnit\Framework\TestCase;

final class SubjectTest extends TestCase
{
    public function testEntity()
    {
        $subject = new Subject();

        $this->assertInstanceOf(Subject::class, $subject);
    }

    public function testCreateSubject()
    {
        $subject = new Subject();
        $subject->setName('Subject 1');

        $this->assertSame('Subject 1', $subject->getName());
    }

    public function testSubjectProjects()
    {
        $project = new Project();
        $project->setName('Project Test');
        $this->assertSame('Project Test', $project->getName());
        
        $subject = new Subject();
        $subject->addProject($project);
        $this->assertSame(1, count($subject->getProjects()));
    }
}