<?php

namespace Wizacha\DevTest;

class StudentManager
{
    /**
     * @param int $studentId
     * @return string
     */
    public function getStudentName($studentId)
    {
        $json = file_get_contents(__DIR__ . '/../data.json');
        $data = json_decode($json, true);
        return $data['students'][$studentId]['name'];
    }

    /**
     * Teste si un étudiant était présent à un examen.
     *
     * @param int $studentId
     * @param string $examDate
     * @return bool
     */
    public function studentAttendedExam($studentId, $examDate)
    {
        $json = file_get_contents(__DIR__ . '/../data.json');
        $data = json_decode($json, true);
        foreach ($data['exam'] as $exam) {
            if ($exam['student'] === $studentId && $exam['date'] == $examDate && $exam['grade'] != null) {
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
    public function getStudentAverageGrade($studentName, $untilDate)
    {
        // TODO
        return 10;
    }
}
