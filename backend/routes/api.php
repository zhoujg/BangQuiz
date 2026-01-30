<?php

use App\Http\Controllers\Api\QuestionController;
use App\Http\Controllers\Api\AnalysisController;
use App\Http\Controllers\Api\ExamController;
use Illuminate\Support\Facades\Route;

// ============================================
// 所有路由都是公开的，不需要登录认证
// 用户可以免费使用所有功能
// ============================================

// 测验包和测验
Route::get('/exam-packages', [ExamController::class, 'getPackages']);
Route::get('/exam-packages/{id}/exams', [ExamController::class, 'getExams']);

// 学习路径
Route::get('/learning-units', [ExamController::class, 'getLearningUnits']);
Route::get('/learning-units/{id}/questions', [ExamController::class, 'getUnitQuestions']);
Route::get('/learning-progress/{packageId}', [AnalysisController::class, 'getLearningProgress']);

// 题目
Route::get('/questions/next', [QuestionController::class, 'getNextQuestion']);
Route::post('/questions/answer', [QuestionController::class, 'submitAnswer']);
Route::get('/questions/{id}', [QuestionController::class, 'getQuestion']);

// 分析
Route::get('/analysis/weakness', [AnalysisController::class, 'getWeaknessReport']);
Route::get('/analysis/prediction', [AnalysisController::class, 'getPassPrediction']);
Route::get('/analysis/stats', [AnalysisController::class, 'getUserStats']);
Route::get('/review/due', [AnalysisController::class, 'getDueReviews']);
