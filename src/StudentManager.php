<?php

namespace Wizacha\DevTest;

class StudentManager
{
    /**
     * Decode JSON Data to an array
     *
     * @return array
     */
    public function getJsonData():array
    {
        return json_decode(file_get_contents(__DIR__ . '/../data.json'), true);
    }

    /**
     * @param int $studentId
     * @return string
     */
    public function getStudentName(int $studentId):string
    {
        $data = $this->getJsonData();
        return $data['students'][$studentId]['name'];
    }

    /**
     * Get Student Id
     * @param string $studentName
     * @return int
     */
    public function getStudentId(string $studentName):int
    {
        $data = $this->getJsonData();
        return array_search($studentName, array_column($data['students'], 'name')) + 1;
    }

    /**
     * Teste si un étudiant était présent à un examen.
     *
     * @param int $studentId
     * @param string $examDate
     * @return bool
     */
    public function studentAttendedExam(int $studentId, string $examDate):bool
    {
        $data = $this->getJsonData();
        foreach ($data['exam'] as $exam) {
            if (intval($exam['student']) === $studentId && strtotime($exam['date']) == strtotime($examDate) && isset($exam['grade'])) {
                return true;
            }
        }
        return false;
    }

    /**
     * Retourne la moyenne d'un étudiant sur tous les examens jusqu'à une date donnée.
     *
     * @param string $studentName Nom de l'étudiant.
     * @param string $untilDate Date.
     * @return int
     */
    public function getStudentAverageGrade(string $studentName, string $untilDate):int
    {
        $studentId = $this->getStudentId($studentName);
        $data = $this->getJsonData();
        $grade = [];

        foreach ($data['exam'] as $exam) {
            if (intval($exam['student']) === $studentId && strtotime($exam['date']) <= strtotime($untilDate) && isset($exam['grade'])) {
                $grade[] = $exam['grade'];
            }
        }

        $average = array_sum($grade) / count($grade);

        return $average;
    }
}
