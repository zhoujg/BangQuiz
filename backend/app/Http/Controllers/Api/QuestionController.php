<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Exam;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * 获取下一题（随机）
     */
    public function getNextQuestion(Request $request)
    {
        $packageId = $request->input('package_id');
        
        if (!$packageId) {
            return response()->json(['error' => '请提供 package_id 参数'], 400);
        }
        
        // 从该测验包中随机获取一道题
        $question = Question::whereHas('exam', function($query) use ($packageId) {
            $query->where('exam_package_id', $packageId);
        })->inRandomOrder()->first();
        
        if (!$question) {
            return response()->json(['error' => '没有找到题目'], 404);
        }
        
        return response()->json([
            'id' => $question->id,
            'content' => $question->content,
            'options' => $question->options,
            'difficulty' => $question->difficulty,
            'bloom_level' => $question->bloom_level,
            'knowledge_point' => $question->knowledge_point
        ]);
    }

    /**
     * 获取指定题目
     */
    public function getQuestion($id)
    {
        $question = Question::findOrFail($id);
        
        return response()->json([
            'id' => $question->id,
            'content' => $question->content,
            'options' => $question->options,
            'difficulty' => $question->difficulty,
            'bloom_level' => $question->bloom_level,
            'knowledge_point' => $question->knowledge_point
        ]);
    }

    /**
     * 提交答案并获取解析
     */
    public function submitAnswer(Request $request)
    {
        $validated = $request->validate([
            'question_id' => 'required|exists:questions,id',
            'selected_option' => 'required|string',
            'time_spent' => 'nullable|integer'
        ]);

        $question = Question::findOrFail($validated['question_id']);
        $isCorrect = $validated['selected_option'] === $question->correct_answer;

        return response()->json([
            'is_correct' => $isCorrect,
            'correct_answer' => $question->correct_answer,
            'explanation' => $question->explanation,
            'selected_option' => $validated['selected_option']
        ]);
    }
}
