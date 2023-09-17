<?php

namespace App\Repositories\Test;

use App\Database;

class MysqlTestRepository implements TestRepository
{
    public function index()
    {
       return Database::connection()
            ->createQueryBuilder()
            ->select('*')
            ->from('tests')
            ->executeQuery()
            ->fetchAllAssociative();
    }

    public function show(int $testId)
    {
        return Database::connection()
            ->createQueryBuilder()
            ->select(
                't.id as test_id',
                't.name as test_name',
                'q.id as question_id',
                'q.test_id',
                'q.question_text',
                'qao.id as question_answer_option_id',
                'qao.question_id as question_id_for_option',
                'qao.option_text',
                'qao.is_correct'
            )
            ->from('tests', 't')
            ->join('t', 'questions', 'q', 't.id = q.test_id')
            ->leftJoin('q', 'question_answer_options', 'qao', 'q.id = qao.question_id')
            ->where('t.id = ?')
            ->setParameter(0, $testId)
            ->executeQuery()
            ->fetchAllAssociative();
    }

    public function submitAnswer(array $vars)
    {
        $existingAnswer = Database::connection()
            ->createQueryBuilder()
            ->select('*')
            ->from('user_test_answers')
            ->where('user_uuid = ?')
            ->andWhere('question_id = ?')
            ->setParameter(0, $_SESSION['user_uuid'])
            ->setParameter(1, (int)$vars['question_id'])
            ->executeQuery()
            ->fetchAssociative();

        if ($existingAnswer) {
            Database::connection()
                ->update('user_test_answers', [
                    'user_uuid' => $_SESSION['user_uuid'],
                    'test_id' => $_SESSION['test_id'],
                    'question_id' => (int)$vars['question_id'],
                    'answer_option_id' => (int)$vars['option_id'],
                ], ['id' => $existingAnswer['id']]);
        } else {
            Database::connection()
                ->insert('user_test_answers', [
                    'user_uuid' => $_SESSION['user_uuid'],
                    'test_id' => $_SESSION['test_id'],
                    'question_id' => (int)$vars['question_id'],
                    'answer_option_id' => (int)$vars['option_id'],
                ]);
        }
    }
}
