<?php

namespace Wizacha\DevTest\Test;

use Wizacha\DevTest\StudentManager;

class StudentManagerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provideStudentNames
     */
    public function testStudentNames($studentId, $expectedName)
    {
        $studentGrades = new StudentManager();
        $name = $studentGrades->getStudentName($studentId);
        $this->assertEquals($expectedName, $name);
    }

    public function provideStudentNames()
    {
        return [
            'alice' => [1, 'Alice'],
            'bob' => [2, 'Bob'],
            'claire' => [3, 'Claire'],
        ];
    }

    public function testAliceAttendedLastExam()
    {
        $studentGrades = new StudentManager();
        $this->assertTrue($studentGrades->studentAttendedExam(1, '2016-02-23'));
    }

    public function testBobAttendedLastExam()
    {
        $studentGrades = new StudentManager();
        $this->assertTrue($studentGrades->studentAttendedExam(2, '2016-02-23'));
    }

    public function testClaireMissedLastExam()
    {
        $studentGrades = new StudentManager();
        $this->assertFalse($studentGrades->studentAttendedExam(3, '2016-02-23'));
    }

    public function testAliceAverageGrade()
    {
        $studentGrades = new StudentManager();
        $this->assertEquals(11, $studentGrades->getStudentAverageGrade('Alice', '2016-03-01'));
    }

    public function testBobAverageGrade()
    {
        $studentGrades = new StudentManager();
        $this->assertEquals(4, $studentGrades->getStudentAverageGrade('Bob', '2016-03-01'));
    }

    public function testClaireAverageGrade()
    {
        $studentGrades = new StudentManager();
        $this->assertEquals(16, $studentGrades->getStudentAverageGrade('Claire', '2016-03-01'));
    }
}
