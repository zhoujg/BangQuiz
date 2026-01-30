<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Question;
use App\Models\LearningOutcome;
use App\Models\Exam;

class AdditionalQuestionsSeeder extends Seeder
{
    public function run(): void
    {
        // 获取第一个考试（用于关联题目）
        $exam = Exam::first();
        
        if (!$exam) {
            $this->command->error('没有找到考试记录，请先运行 TOGAFCompleteSeeder');
            return;
        }

        // 为 Unit 2 (ADM Overview) 添加题目
        $unit2Outcomes = LearningOutcome::whereHas('learningUnit', function($query) {
            $query->where('id', 2);
        })->get();
        
        if ($unit2Outcomes->isNotEmpty()) {
            $unit2Questions = [
                [
                    'content' => 'ADM 的核心是什么？',
                    'options' => [
                        'A' => '需求管理',
                        'B' => '架构开发方法',
                        'C' => '企业连续体',
                        'D' => '架构能力框架'
                    ],
                    'correct_answer' => 'A',
                    'explanation' => 'ADM 的核心是需求管理，它贯穿整个架构开发生命周期。',
                    'knowledge_point' => 'Unit 2 - ADM Overview',
                    'difficulty' => 'medium'
                ],
                [
                    'content' => 'ADM 包含多少个阶段？',
                    'options' => [
                        'A' => '8个',
                        'B' => '9个',
                        'C' => '10个',
                        'D' => '11个'
                    ],
                    'correct_answer' => 'C',
                    'explanation' => 'ADM 包含预备阶段、A-H 8个阶段，加上需求管理，共10个阶段。',
                    'knowledge_point' => 'Unit 2 - ADM Overview',
                    'difficulty' => 'easy'
                ],
                [
                    'content' => 'ADM 的预备阶段主要做什么？',
                    'options' => [
                        'A' => '开发业务架构',
                        'B' => '准备和启动架构活动',
                        'C' => '实施架构变更',
                        'D' => '管理需求'
                    ],
                    'correct_answer' => 'B',
                    'explanation' => '预备阶段主要是准备和启动架构活动，建立架构能力。',
                    'knowledge_point' => 'Unit 2 - ADM Overview',
                    'difficulty' => 'easy'
                ],
            ];

            foreach ($unit2Questions as $index => $questionData) {
                Question::create([
                    'exam_id' => $exam->id,
                    'learning_outcome_id' => $unit2Outcomes->first()->id,
                    'content' => $questionData['content'],
                    'options' => $questionData['options'],
                    'correct_answer' => $questionData['correct_answer'],
                    'explanation' => $questionData['explanation'],
                    'knowledge_point' => $questionData['knowledge_point'],
                    'difficulty' => $questionData['difficulty'],
                    'sort_order' => 100 + $index
                ]);
            }
            
            $this->command->info('已为 Unit 2 添加 ' . count($unit2Questions) . ' 道题目');
        }

        // 为 Unit 3 (Architecture Vision) 添加题目
        $unit3Outcomes = LearningOutcome::whereHas('learningUnit', function($query) {
            $query->where('id', 3);
        })->get();
        
        if ($unit3Outcomes->isNotEmpty()) {
            $unit3Questions = [
                [
                    'content' => '架构愿景阶段的主要输出是什么？',
                    'options' => [
                        'A' => '架构定义文档',
                        'B' => '架构愿景文档',
                        'C' => '架构需求规格说明',
                        'D' => '架构路线图'
                    ],
                    'correct_answer' => 'B',
                    'explanation' => '架构愿景阶段的主要输出是架构愿景文档，它描述了目标架构的高层视图。',
                    'knowledge_point' => 'Unit 3 - Architecture Vision',
                    'difficulty' => 'easy'
                ],
                [
                    'content' => '利益相关者管理在哪个阶段最为重要？',
                    'options' => [
                        'A' => '预备阶段',
                        'B' => '架构愿景阶段',
                        'C' => '业务架构阶段',
                        'D' => '技术架构阶段'
                    ],
                    'correct_answer' => 'B',
                    'explanation' => '虽然利益相关者管理贯穿整个ADM，但在架构愿景阶段尤为重要，需要识别和获得关键利益相关者的支持。',
                    'knowledge_point' => 'Unit 3 - Architecture Vision',
                    'difficulty' => 'medium'
                ],
                [
                    'content' => '架构工作说明书（SOW）在哪个阶段创建？',
                    'options' => [
                        'A' => '预备阶段',
                        'B' => '架构愿景阶段',
                        'C' => '业务架构阶段',
                        'D' => '需求管理阶段'
                    ],
                    'correct_answer' => 'B',
                    'explanation' => '架构工作说明书在架构愿景阶段创建，定义了架构项目的范围和方法。',
                    'knowledge_point' => 'Unit 3 - Architecture Vision',
                    'difficulty' => 'medium'
                ],
            ];

            foreach ($unit3Questions as $index => $questionData) {
                Question::create([
                    'exam_id' => $exam->id,
                    'learning_outcome_id' => $unit3Outcomes->first()->id,
                    'content' => $questionData['content'],
                    'options' => $questionData['options'],
                    'correct_answer' => $questionData['correct_answer'],
                    'explanation' => $questionData['explanation'],
                    'knowledge_point' => $questionData['knowledge_point'],
                    'difficulty' => $questionData['difficulty'],
                    'sort_order' => 200 + $index
                ]);
            }
            
            $this->command->info('已为 Unit 3 添加 ' . count($unit3Questions) . ' 道题目');
        }

        // 为 Unit 4 (Business Architecture) 添加题目
        $unit4Outcomes = LearningOutcome::whereHas('learningUnit', function($query) {
            $query->where('id', 4);
        })->get();
        
        if ($unit4Outcomes->isNotEmpty()) {
            $unit4Questions = [
                [
                    'content' => '业务架构阶段的主要关注点是什么？',
                    'options' => [
                        'A' => '技术基础设施',
                        'B' => '业务战略、治理、组织和关键业务流程',
                        'C' => '应用系统',
                        'D' => '数据管理'
                    ],
                    'correct_answer' => 'B',
                    'explanation' => '业务架构阶段关注业务战略、治理、组织和关键业务流程。',
                    'knowledge_point' => 'Unit 4 - Business Architecture',
                    'difficulty' => 'easy'
                ],
                [
                    'content' => '业务能力映射的主要目的是什么？',
                    'options' => [
                        'A' => '定义技术需求',
                        'B' => '识别业务功能和能力',
                        'C' => '设计数据库结构',
                        'D' => '规划网络架构'
                    ],
                    'correct_answer' => 'B',
                    'explanation' => '业务能力映射用于识别和定义组织的业务功能和能力。',
                    'knowledge_point' => 'Unit 4 - Business Architecture',
                    'difficulty' => 'medium'
                ],
                [
                    'content' => '价值流图在业务架构中的作用是什么？',
                    'options' => [
                        'A' => '展示技术组件',
                        'B' => '描述业务如何创造价值',
                        'C' => '定义数据流',
                        'D' => '规划基础设施'
                    ],
                    'correct_answer' => 'B',
                    'explanation' => '价值流图用于描述业务如何为客户创造价值的端到端流程。',
                    'knowledge_point' => 'Unit 4 - Business Architecture',
                    'difficulty' => 'medium'
                ],
            ];

            foreach ($unit4Questions as $index => $questionData) {
                Question::create([
                    'exam_id' => $exam->id,
                    'learning_outcome_id' => $unit4Outcomes->first()->id,
                    'content' => $questionData['content'],
                    'options' => $questionData['options'],
                    'correct_answer' => $questionData['correct_answer'],
                    'explanation' => $questionData['explanation'],
                    'knowledge_point' => $questionData['knowledge_point'],
                    'difficulty' => $questionData['difficulty'],
                    'sort_order' => 300 + $index
                ]);
            }
            
            $this->command->info('已为 Unit 4 添加 ' . count($unit4Questions) . ' 道题目');
        }

        $this->command->info('所有额外题目添加完成！');
    }
}
