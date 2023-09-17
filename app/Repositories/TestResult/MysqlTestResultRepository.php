<?php

namespace App\Repositories\TestResult;

use App\Database;

class MysqlTestResultRepository implements TestResultRepository
{
    public function show(string $userUuid, string $testId)
    {
        $data = [];

        $data['total_test_questions'] = Database::connection()
            ->createQueryBuilder()
            ->select('*')
            ->from('questions')
            ->where('test_id = ?')
            ->setParameter(0, $testId)
            ->executeQuery()
            ->rowCount();

        $data['total_correct_answers'] = Database::connection()
            ->createQueryBuilder()
            ->select('correct_answers')
            ->from('user_test_results')
            ->where('user_uuid = ?')
            ->setParameter(0, $userUuid)
            ->executeQuery()
            ->fetchOne();

        return $data;
    }

    public function store(string $userUuid, string $testId)
    {
        $totalCorrectAnswers = Database::connection()
            ->createQueryBuilder()
            ->select('*')
            ->from('user_test_answers', 'uta')
            ->join('uta', 'question_answer_options', 'qao', 'uta.answer_option_id = qao.id')
            ->where('uta.user_uuid = ?', 'qao.is_correct = ?')
            ->setParameter(0, $userUuid)
            ->setParameter(1, true)
            ->executeQuery()
            ->rowCount();

        Database::connection()
            ->insert('user_test_results', [
                'user_uuid' => $userUuid,
                'test_id' => $testId,
                'correct_answers' => $totalCorrectAnswers,
            ]);
    }
}