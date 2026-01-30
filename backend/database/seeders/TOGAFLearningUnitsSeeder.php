<?php

namespace Database\Seeders;

use App\Models\ExamPackage;
use App\Models\LearningUnit;
use App\Models\LearningOutcome;
use App\Models\Exam;
use App\Models\Question;
use Illuminate\Database\Seeder;

class TOGAFLearningUnitsSeeder extends Seeder
{
    public function run(): void
    {
        // 获取或创建TOGAF测验包
        $togafPackage = ExamPackage::firstOrCreate(
            ['code' => 'togaf'],
            [
                'name' => 'TOGAF 10 企业架构认证',
                'description' => 'The Open Group Architecture Framework 完整学习包',
                'is_active' => true
            ]
        );

        // Level 1 - Unit 1: Concepts
        $unit1 = LearningUnit::create([
            'exam_package_id' => $togafPackage->id,
            'unit_number' => 'Unit 1',
            'title' => 'Concepts (概念)',
            'purpose' => '介绍企业架构和TOGAF标准的概念',
            'certification_level' => 'level1',
            'sort_order' => 1
        ]);

        // Learning Outcomes for Unit 1
        $outcome1_1 = LearningOutcome::create([
            'learning_unit_id' => $unit1->id,
            'outcome_code' => '1.1',
            'description' => 'Describe what an enterprise is (描述什么是企业)',
            'bloom_level' => 'remembering',
            'klp_references' => [['doc' => 'S0', 'section' => '§1.1']],
            'sort_order' => 1
        ]);

        $outcome1_2 = LearningOutcome::create([
            'learning_unit_id' => $unit1->id,
            'outcome_code' => '1.2',
            'description' => 'Explain the purpose of Enterprise Architecture (解释企业架构的目的)',
            'bloom_level' => 'understanding',
            'klp_references' => [
                ['doc' => 'S0', 'section' => '§1.1'],
                ['doc' => 'G186', 'section' => '§3.1'],
                ['doc' => 'G20F', 'section' => '§1.2']
            ],
            'sort_order' => 2
        ]);

        $outcome1_3 = LearningOutcome::create([
            'learning_unit_id' => $unit1->id,
            'outcome_code' => '1.3',
            'description' => 'List the key benefits of having an Enterprise Architecture (列出拥有企业架构的关键好处)',
            'bloom_level' => 'remembering',
            'klp_references' => [
                ['doc' => 'S0', 'section' => '§1.1'],
                ['doc' => 'G184', 'section' => '§3.6']
            ],
            'sort_order' => 3
        ]);

        // Level 1 - Unit 3: Introduction to the ADM
        $unit3 = LearningUnit::create([
            'exam_package_id' => $togafPackage->id,
            'unit_number' => 'Unit 3',
            'title' => 'Introduction to the ADM (ADM介绍)',
            'purpose' => '帮助考生理解架构开发方法(ADM)及其各阶段',
            'certification_level' => 'level1',
            'sort_order' => 3
        ]);

        $outcome3_1 = LearningOutcome::create([
            'learning_unit_id' => $unit3->id,
            'outcome_code' => '3.1',
            'description' => 'Briefly describe the ADM and its phases (简要描述ADM及其阶段)',
            'bloom_level' => 'remembering',
            'klp_references' => [
                ['doc' => 'S0', 'section' => '§3.4'],
                ['doc' => 'S1', 'section' => '§1.2.2']
            ],
            'sort_order' => 1
        ]);

        $outcome3_3 = LearningOutcome::create([
            'learning_unit_id' => $unit3->id,
            'outcome_code' => '3.3',
            'description' => 'Explain the iterative approach of the ADM (解释ADM的迭代方法)',
            'bloom_level' => 'understanding',
            'klp_references' => [
                ['doc' => 'S1', 'section' => '§1.2.1'],
                ['doc' => 'G186', 'section' => '§5.2, 5.2.3']
            ],
            'sort_order' => 3
        ]);

        // Level 2 - Unit 2: Stakeholder Management
        $unit2_l2 = LearningUnit::create([
            'exam_package_id' => $togafPackage->id,
            'unit_number' => 'Unit 2',
            'title' => 'Stakeholder Management (利益相关者管理)',
            'purpose' => '帮助考生理解如何应用利益相关者管理',
            'certification_level' => 'level2',
            'sort_order' => 10
        ]);

        $outcome2_1_l2 = LearningOutcome::create([
            'learning_unit_id' => $unit2_l2->id,
            'outcome_code' => '2.1',
            'description' => 'Explain how to identify stakeholders, their concerns, views, and the communication involved (解释如何识别利益相关者、他们的关注点、视图和相关沟通)',
            'bloom_level' => 'applying',
            'klp_references' => [
                ['doc' => 'G186', 'section' => '§3.3.1, B']
            ],
            'sort_order' => 1
        ]);

        // 创建对应的测验
        $examUnit1 = Exam::create([
            'exam_package_id' => $togafPackage->id,
            'title' => 'Unit 1: Concepts - 概念测验',
            'chapter' => '1',
            'description' => '测试对企业架构和TOGAF基本概念的理解',
            'question_count' => 12,
            'time_limit' => 20,
            'pass_score' => 60,
            'sort_order' => 1,
            'is_active' => true
        ]);

        // 创建示例题目
        Question::create([
            'exam_id' => $examUnit1->id,
            'learning_outcome_id' => $outcome1_1->id,
            'content' => '在TOGAF中，"企业"(Enterprise)的定义是什么？',
            'options' => [
                'A' => '仅指大型跨国公司',
                'B' => '任何有共同目标和功能集合的组织',
                'C' => '只包括IT部门的组织',
                'D' => '必须是盈利性的商业机构'
            ],
            'correct_answer' => 'B',
            'explanation' => '在TOGAF中，企业是指任何有共同目标和功能集合的组织。它可以是整个公司、部门、政府机构或非盈利组织。关键是有共同的目标和治理结构。',
            'knowledge_point' => '企业定义',
            'difficulty' => 'easy',
            'bloom_level' => 'remembering',
            'klp_references' => [['doc' => 'S0', 'section' => '§1.1']],
            'sort_order' => 1
        ]);

        Question::create([
            'exam_id' => $examUnit1->id,
            'learning_outcome_id' => $outcome1_2->id,
            'content' => '企业架构的主要目的是什么？',
            'options' => [
                'A' => '记录现有IT系统',
                'B' => '指导有效的变革',
                'C' => '减少IT成本',
                'D' => '替代项目管理'
            ],
            'correct_answer' => 'B',
            'explanation' => '企业架构的核心目的是指导有效的变革。它通过提供业务和IT之间的桥梁，确保技术投资与业务目标保持一致，从而支持组织的战略目标实现。',
            'knowledge_point' => '企业架构目的',
            'difficulty' => 'medium',
            'bloom_level' => 'understanding',
            'klp_references' => [
                ['doc' => 'S0', 'section' => '§1.1'],
                ['doc' => 'G186', 'section' => '§3.1']
            ],
            'scenario' => '某大型零售企业正在进行数字化转型，需要确保所有IT项目都支持业务战略。',
            'sort_order' => 2
        ]);

        Question::create([
            'exam_id' => $examUnit1->id,
            'learning_outcome_id' => $outcome1_3->id,
            'content' => '以下哪项不是拥有企业架构的关键好处？',
            'options' => [
                'A' => '降低IT复杂性和成本',
                'B' => '提高业务和IT的一致性',
                'C' => '消除所有业务风险',
                'D' => '提高决策效率'
            ],
            'correct_answer' => 'C',
            'explanation' => '企业架构可以帮助识别和管理风险，但不能消除所有业务风险。其他选项都是企业架构的关键好处：降低复杂性、提高一致性和改善决策。',
            'knowledge_point' => '企业架构好处',
            'difficulty' => 'easy',
            'bloom_level' => 'remembering',
            'klp_references' => [
                ['doc' => 'S0', 'section' => '§1.1'],
                ['doc' => 'G184', 'section' => '§3.6']
            ],
            'sort_order' => 3
        ]);
    }
}
