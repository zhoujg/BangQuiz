<?php

namespace Database\Seeders;

use App\Models\ExamPackage;
use App\Models\Exam;
use App\Models\Question;
use Illuminate\Database\Seeder;

class SampleDataSeeder extends Seeder
{
    public function run(): void
    {
        // 创建测验包
        $togafPackage = ExamPackage::create([
            'name' => 'TOGAF 10 企业架构',
            'code' => 'togaf',
            'description' => 'The Open Group Architecture Framework 完整学习包',
            'is_active' => true
        ]);

        $bizbokPackage = ExamPackage::create([
            'name' => 'BIZBOK 业务架构',
            'code' => 'bizbok',
            'description' => 'Business Architecture Body of Knowledge 学习包',
            'is_active' => true
        ]);

        // TOGAF 测验包下的测验（按章节）
        $togafChapter1 = Exam::create([
            'exam_package_id' => $togafPackage->id,
            'title' => '第1章：ADM概述',
            'chapter' => '1',
            'description' => '架构开发方法(ADM)核心概念',
            'question_count' => 20,
            'time_limit' => 30,
            'pass_score' => 60,
            'sort_order' => 1,
            'is_active' => true
        ]);

        $togafChapter2 = Exam::create([
            'exam_package_id' => $togafPackage->id,
            'title' => '第2章：架构愿景',
            'chapter' => '2',
            'description' => 'ADM阶段A - 架构愿景详解',
            'question_count' => 15,
            'time_limit' => 25,
            'pass_score' => 60,
            'sort_order' => 2,
            'is_active' => true
        ]);

        $togafChapter3 = Exam::create([
            'exam_package_id' => $togafPackage->id,
            'title' => '第3章：业务架构',
            'chapter' => '3',
            'description' => 'ADM阶段B - 业务架构设计',
            'question_count' => 25,
            'time_limit' => 40,
            'pass_score' => 60,
            'sort_order' => 3,
            'is_active' => true
        ]);

        // BIZBOK 测验包下的测验
        $bizbokBasics = Exam::create([
            'exam_package_id' => $bizbokPackage->id,
            'title' => '业务架构基础',
            'chapter' => '1',
            'description' => '业务架构核心概念和原则',
            'question_count' => 20,
            'time_limit' => 30,
            'pass_score' => 60,
            'sort_order' => 1,
            'is_active' => true
        ]);

        // 创建示例题目
        Question::create([
            'exam_id' => $togafChapter1->id,
            'content' => 'TOGAF架构开发方法(ADM)的核心特征是什么？',
            'options' => [
                'A' => '一个迭代的过程',
                'B' => '一个线性的过程',
                'C' => '一个瀑布模型',
                'D' => '一个敏捷框架'
            ],
            'correct_answer' => 'A',
            'explanation' => 'ADM是一个迭代的过程，允许在各个阶段之间循环，以确保架构的持续改进和适应性。这种迭代性使得TOGAF能够适应不断变化的业务需求。',
            'knowledge_point' => 'ADM核心概念',
            'difficulty' => 'medium',
            'scenario' => '某大型企业正在进行数字化转型，需要建立企业架构框架来指导IT系统的演进。',
            'sort_order' => 1
        ]);

        Question::create([
            'exam_id' => $togafChapter2->id,
            'content' => '在TOGAF中，架构愿景阶段的主要目标是什么？',
            'options' => [
                'A' => '详细设计技术架构',
                'B' => '获得利益相关者的支持和批准',
                'C' => '实施架构变更',
                'D' => '进行差距分析'
            ],
            'correct_answer' => 'B',
            'explanation' => '架构愿景阶段的主要目标是创建高层次的架构愿景，并获得利益相关者的支持和批准，为后续的架构开发工作奠定基础。',
            'knowledge_point' => 'ADM阶段A-架构愿景',
            'difficulty' => 'easy',
            'scenario' => null,
            'sort_order' => 1
        ]);

        Question::create([
            'exam_id' => $bizbokBasics->id,
            'content' => '业务架构的核心关注点是什么？',
            'options' => [
                'A' => '技术实现细节',
                'B' => '业务能力和价值流',
                'C' => '数据库设计',
                'D' => '网络拓扑'
            ],
            'correct_answer' => 'B',
            'explanation' => '业务架构主要关注业务能力、价值流、组织结构和信息流等业务层面的要素，而不是技术实现细节。',
            'knowledge_point' => '业务架构基础',
            'difficulty' => 'easy',
            'scenario' => '一家零售企业希望通过业务架构来识别核心能力和优化业务流程。',
            'sort_order' => 1
        ]);
    }
}
