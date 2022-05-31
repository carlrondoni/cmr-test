<?php


namespace Tests\Entity;

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
}