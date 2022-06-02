<?php


namespace Tests\Entity;

use App\Entity\Project;
use App\Entity\Subject;
use App\Entity\SubjectProject;
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
        $subject = new Subject();
        $this->assertSame(0, count($subject->getProjects()));
        
        $subjectProject = new SubjectProject();
        $subjectProject->setProjectId(1);
        
        $subject->addProject($subjectProject);
        $this->assertSame(1, count($subject->getProjects()));
    }
}