<?php

namespace Database\Seeders;

use App\Models\ExamPackage;
use App\Models\LearningUnit;
use App\Models\LearningOutcome;
use App\Models\Exam;
use App\Models\Question;
use Illuminate\Database\Seeder;

class TOGAFCompleteSeeder extends Seeder
{
    public function run(): void
    {
        // ==================== TOGAF Level 1 Foundation ====================
        $level1 = ExamPackage::create([
            'name' => 'TOGAF Level 1 Foundation',
            'code' => 'togaf-level1',
            'description' => 'TOGAF 10 基础级认证 - 掌握企业架构和TOGAF标准的核心概念',
            'cover_image' => '/images/togaf-level1.png',
            'is_active' => true
        ]);

        // Level 1 - Unit 1: Concepts (概念)
        $unit1_1 = LearningUnit::create([
            'exam_package_id' => $level1->id,
            'unit_number' => 'Unit 1',
            'title' => 'Concepts (概念)',
            'purpose' => '介绍企业架构和TOGAF标准的概念',
            'certification_level' => 'level1',
            'sort_order' => 1
        ]);

        $this->createLearningOutcomes($unit1_1->id, [
            ['1.1', '描述什么是企业', 'remembering', [['doc' => 'S0', 'section' => '§1.1']]],
            ['1.2', '解释企业架构的目的', 'understanding', [['doc' => 'S0', 'section' => '§1.1'], ['doc' => 'G186', 'section' => '§3.1']]],
            ['1.3', '列出拥有企业架构的关键好处', 'remembering', [['doc' => 'S0', 'section' => '§1.1']]],
            ['1.4', '解释为什么TOGAF标准适合作为框架使用', 'understanding', [['doc' => 'S0', 'section' => '§1.1']]],
            ['1.5', '列出四个架构域', 'remembering', [['doc' => 'S0', 'section' => '§3.3']]],
        ]);

        // Level 1 - Unit 2: Definitions (定义)
        $unit1_2 = LearningUnit::create([
            'exam_package_id' => $level1->id,
            'unit_number' => 'Unit 2',
            'title' => 'Definitions (定义)',
            'purpose' => '帮助考生理解TOGAF相关术语',
            'certification_level' => 'level1',
            'sort_order' => 2
        ]);

        $this->createLearningOutcomes($unit1_2->id, [
            ['2.1', '定义架构', 'remembering', [['doc' => 'S0', 'section' => '§2.1']]],
            ['2.2', '定义架构框架', 'remembering', [['doc' => 'S0', 'section' => '§2.2']]],
            ['2.3', '定义架构开发方法(ADM)', 'remembering', [['doc' => 'S0', 'section' => '§2.3']]],
        ]);

        // Level 1 - Unit 3: Introduction to the ADM (ADM介绍)
        $unit1_3 = LearningUnit::create([
            'exam_package_id' => $level1->id,
            'unit_number' => 'Unit 3',
            'title' => 'Introduction to the ADM (ADM介绍)',
            'purpose' => '帮助考生理解架构开发方法(ADM)及其各阶段',
            'certification_level' => 'level1',
            'sort_order' => 3
        ]);

        $this->createLearningOutcomes($unit1_3->id, [
            ['3.1', '简要描述ADM及其各阶段', 'remembering', [['doc' => 'S0', 'section' => '§3.4']]],
            ['3.2', '描述草稿和批准交付物之间的区别', 'remembering', [['doc' => 'S1', 'section' => '§1.2.2']]],
            ['3.3', '解释ADM的迭代方法', 'understanding', [['doc' => 'S1', 'section' => '§1.2.1']]],
            ['3.4', '识别ADM各阶段的目标', 'remembering', [['doc' => 'S1', 'section' => '各阶段']]],
        ]);

        // 创建练习测验
        $exam1_1 = Exam::create([
            'exam_package_id' => $level1->id,
            'learning_unit_id' => $unit1_1->id,
            'title' => 'Unit 1: Concepts - 练习测验',
            'exam_type' => 'practice',
            'description' => '测试对企业架构和TOGAF基本概念的理解',
            'question_count' => 15,
            'time_limit' => 25,
            'pass_score' => 60,
            'sort_order' => 1,
            'is_active' => true
        ]);

        // 创建 Unit 1 的题目
        $this->createUnit1Questions($level1->id, $unit1_1->id, $exam1_1->id);

        // Level 1 模拟考试
        $mockExam1 = Exam::create([
            'exam_package_id' => $level1->id,
            'title' => 'TOGAF Level 1 模拟考试',
            'exam_type' => 'mock',
            'description' => '完整模拟真实考试环境 - 40题60分钟',
            'question_count' => 40,
            'time_limit' => 60,
            'pass_score' => 55,
            'sort_order' => 100,
            'is_active' => true
        ]);

        // ==================== TOGAF Level 2 Practitioner ====================
        $level2 = ExamPackage::create([
            'name' => 'TOGAF Level 2 Practitioner',
            'code' => 'togaf-level2',
            'description' => 'TOGAF 10 实践级认证 - 掌握如何应用TOGAF进行企业架构开发',
            'cover_image' => '/images/togaf-level2.png',
            'is_active' => true
        ]);

        // Level 2 - Unit 1: The Context for Enterprise Architecture
        $unit2_1 = LearningUnit::create([
            'exam_package_id' => $level2->id,
            'unit_number' => 'Unit 1',
            'title' => 'The Context for Enterprise Architecture (企业架构上下文)',
            'purpose' => '帮助企业架构实践者理解他们必须运作的上下文',
            'certification_level' => 'level2',
            'sort_order' => 1
        ]);

        $this->createLearningOutcomes($unit2_1->id, [
            ['1.1', '解释为什么指导有效变革是企业架构的目的', 'understanding', [['doc' => 'G186', 'section' => '§3.1']]],
            ['1.2', '解释企业架构看起来是什么样的', 'understanding', [['doc' => 'G186', 'section' => '§3.2.3']]],
            ['1.3', '解释什么是架构能力', 'understanding', [['doc' => 'S0', 'section' => '§3.13']]],
        ]);

        // Level 2 - Unit 2: Stakeholder Management
        $unit2_2 = LearningUnit::create([
            'exam_package_id' => $level2->id,
            'unit_number' => 'Unit 2',
            'title' => 'Stakeholder Management (利益相关者管理)',
            'purpose' => '帮助考生理解如何应用利益相关者管理',
            'certification_level' => 'level2',
            'sort_order' => 2
        ]);

        $this->createLearningOutcomes($unit2_2->id, [
            ['2.1', '解释如何识别利益相关者及其关注点', 'applying', [['doc' => 'G186', 'section' => '§3.3.1']]],
            ['2.2', '解释架构视图的使用', 'understanding', [['doc' => 'S4', 'section' => '§3.2']]],
            ['2.3', '解释如何管理利益相关者参与', 'applying', [['doc' => 'G186', 'section' => '§6.1.1']]],
        ]);

        // Level 2 模拟考试
        Exam::create([
            'exam_package_id' => $level2->id,
            'title' => 'TOGAF Level 2 模拟考试',
            'exam_type' => 'mock',
            'description' => '场景分析题 - 8题90分钟',
            'question_count' => 8,
            'time_limit' => 90,
            'pass_score' => 60,
            'sort_order' => 100,
            'is_active' => true
        ]);

        echo "✅ 测试数据创建成功！\n";
        echo "📦 测验包: 2个 (Level 1 + Level 2)\n";
        echo "📚 学习单元: 5个\n";
        echo "🎯 学习成果: " . LearningOutcome::count() . "个\n";
        echo "📝 测验: " . Exam::count() . "个\n";
        echo "❓ 题目: " . Question::count() . "道\n";
    }

    private function createLearningOutcomes(int $unitId, array $outcomes): void
    {
        foreach ($outcomes as $index => $outcome) {
            LearningOutcome::create([
                'learning_unit_id' => $unitId,
                'outcome_code' => $outcome[0],
                'description' => $outcome[1],
                'bloom_level' => $outcome[2],
                'klp_references' => $outcome[3],
                'sort_order' => $index + 1
            ]);
        }
    }

    private function createUnit1Questions(int $packageId, int $unitId, int $examId): void
    {
        $questions = [
            [
                'question_text' => '什么是企业？',
                'options' => [
                    'A' => '任何具有共同目标集合的组织集合',
                    'B' => '仅指大型跨国公司',
                    'C' => '只包括私营部门的组织',
                    'D' => '政府机构的专用术语'
                ],
                'correct_answer' => 'A',
                'explanation' => '在TOGAF中，企业被定义为具有共同目标集合的任何组织集合。这可以包括整个公司、部门、政府机构或任何其他组织单位。',
                'difficulty' => 'easy',
                'bloom_level' => 'remembering'
            ],
            [
                'question_text' => '企业架构的主要目的是什么？',
                'options' => [
                    'A' => '创建详细的技术文档',
                    'B' => '指导有效的业务变革',
                    'C' => '减少IT成本',
                    'D' => '替代项目管理'
                ],
                'correct_answer' => 'B',
                'explanation' => '企业架构的核心目的是指导有效的业务变革。它通过提供一个全面的框架来理解组织的当前状态和期望的未来状态，从而支持战略决策和变革管理。',
                'difficulty' => 'medium',
                'bloom_level' => 'understanding'
            ],
            [
                'question_text' => '以下哪项不是拥有企业架构的关键好处？',
                'options' => [
                    'A' => '更有效的IT投资',
                    'B' => '降低业务运营风险',
                    'C' => '消除所有IT项目',
                    'D' => '改善业务和IT的一致性'
                ],
                'correct_answer' => 'C',
                'explanation' => '企业架构不会消除IT项目，而是帮助更好地规划和管理它们。企业架构的真正好处包括：更有效的IT投资、降低风险、改善业务和IT的一致性、提高敏捷性等。',
                'difficulty' => 'easy',
                'bloom_level' => 'understanding'
            ],
            [
                'question_text' => 'TOGAF标准包含哪些主要组成部分？',
                'options' => [
                    'A' => '仅包含ADM',
                    'B' => 'ADM、参考模型和能力框架',
                    'C' => 'ADM、ADM指南与技术、架构内容框架和企业连续系列',
                    'D' => '只有理论概念，没有实践指导'
                ],
                'correct_answer' => 'C',
                'explanation' => 'TOGAF标准包含四个主要部分：1) 架构开发方法(ADM) 2) ADM指南与技术 3) 架构内容框架 4) 企业连续系列与工具。这些组成部分共同提供了一个完整的企业架构框架。',
                'difficulty' => 'medium',
                'bloom_level' => 'remembering'
            ],
            [
                'question_text' => 'TOGAF定义的四个架构域是什么？',
                'options' => [
                    'A' => '业务、数据、应用、技术',
                    'B' => '战略、战术、运营、支持',
                    'C' => '前端、后端、数据库、网络',
                    'D' => '规划、设计、实施、维护'
                ],
                'correct_answer' => 'A',
                'explanation' => 'TOGAF定义了四个架构域：业务架构(Business Architecture)、数据架构(Data Architecture)、应用架构(Application Architecture)和技术架构(Technology Architecture)。这四个域共同构成了完整的企业架构。',
                'difficulty' => 'easy',
                'bloom_level' => 'remembering'
            ],
            [
                'question_text' => '业务架构主要关注什么？',
                'options' => [
                    'A' => '服务器和网络配置',
                    'B' => '业务战略、治理、组织和关键业务流程',
                    'C' => '数据库设计',
                    'D' => '应用程序代码'
                ],
                'correct_answer' => 'B',
                'explanation' => '业务架构定义了业务战略、治理、组织结构和关键业务流程。它描述了组织如何运作以实现其目标，是其他三个架构域的基础。',
                'difficulty' => 'medium',
                'bloom_level' => 'understanding'
            ],
            [
                'question_text' => '数据架构描述了什么？',
                'options' => [
                    'A' => '组织的逻辑和物理数据资产及数据管理资源的结构',
                    'B' => '仅指数据库表结构',
                    'C' => '只关注大数据技术',
                    'D' => '员工的个人数据'
                ],
                'correct_answer' => 'A',
                'explanation' => '数据架构描述了组织的逻辑和物理数据资产的结构，以及数据管理资源。它包括数据模型、数据流、数据治理等方面，确保数据的一致性、准确性和可用性。',
                'difficulty' => 'medium',
                'bloom_level' => 'remembering'
            ],
            [
                'question_text' => '应用架构提供了什么的蓝图？',
                'options' => [
                    'A' => '硬件设备',
                    'B' => '要部署的各个应用系统及其相互关系',
                    'C' => '员工培训计划',
                    'D' => '财务预算'
                ],
                'correct_answer' => 'B',
                'explanation' => '应用架构提供了要部署的各个应用系统、它们之间的交互以及它们与核心业务流程的关系的蓝图。它确保应用系统能够有效支持业务需求。',
                'difficulty' => 'easy',
                'bloom_level' => 'remembering'
            ],
            [
                'question_text' => '技术架构描述了什么？',
                'options' => [
                    'A' => '业务流程',
                    'B' => '支持业务、数据和应用服务部署所需的逻辑软件和硬件能力',
                    'C' => '组织结构图',
                    'D' => '市场营销策略'
                ],
                'correct_answer' => 'B',
                'explanation' => '技术架构描述了支持业务、数据和应用服务部署所需的逻辑软件和硬件能力。这包括IT基础设施、中间件、网络、通信等技术组件。',
                'difficulty' => 'medium',
                'bloom_level' => 'remembering'
            ],
            [
                'question_text' => '为什么TOGAF被认为是一个开放的标准？',
                'options' => [
                    'A' => '因为它是免费的',
                    'B' => '因为它由The Open Group维护，任何人都可以访问和使用',
                    'C' => '因为它只能在开源软件中使用',
                    'D' => '因为它没有版权保护'
                ],
                'correct_answer' => 'B',
                'explanation' => 'TOGAF是一个开放的标准，因为它由The Open Group（一个中立的国际标准组织）维护，任何人都可以访问、学习和使用。这种开放性促进了广泛的采用和持续的改进。',
                'difficulty' => 'medium',
                'bloom_level' => 'understanding'
            ],
            [
                'question_text' => 'TOGAF标准的主要优势是什么？',
                'options' => [
                    'A' => '它提供了一个经过验证的、可重复的方法来开发企业架构',
                    'B' => '它自动生成所有架构文档',
                    'C' => '它消除了对架构师的需求',
                    'D' => '它只适用于IT部门'
                ],
                'correct_answer' => 'A',
                'explanation' => 'TOGAF的主要优势在于它提供了一个经过行业验证的、可重复的方法来开发企业架构。它不是自动化工具，而是一个框架和方法论，需要有经验的架构师来应用。',
                'difficulty' => 'medium',
                'bloom_level' => 'understanding'
            ],
            [
                'question_text' => '企业架构如何支持业务战略？',
                'options' => [
                    'A' => '通过替代业务战略',
                    'B' => '通过提供一个框架来将业务战略转化为可执行的变革计划',
                    'C' => '通过只关注技术实施',
                    'D' => '通过忽略业务需求'
                ],
                'correct_answer' => 'B',
                'explanation' => '企业架构通过提供一个结构化的框架来支持业务战略，该框架可以将高层业务战略转化为具体的、可执行的变革计划和项目。它确保IT投资与业务目标保持一致。',
                'difficulty' => 'medium',
                'bloom_level' => 'understanding'
            ],
            [
                'question_text' => '以下哪项最好地描述了架构框架？',
                'options' => [
                    'A' => '一个软件开发工具',
                    'B' => '一种用于开发广泛不同架构的基础结构',
                    'C' => '一个项目管理方法',
                    'D' => '一个数据库管理系统'
                ],
                'correct_answer' => 'B',
                'explanation' => '架构框架是一种用于开发广泛不同架构的基础结构。它提供了工具、通用词汇、推荐标准、合规性方法、建议的工作产品等，帮助架构师系统地开发架构。',
                'difficulty' => 'easy',
                'bloom_level' => 'understanding'
            ],
            [
                'question_text' => 'TOGAF可以与其他框架一起使用吗？',
                'options' => [
                    'A' => '不可以，TOGAF必须单独使用',
                    'B' => '可以，TOGAF可以与其他框架（如ITIL、COBIT）集成',
                    'C' => '只能与The Open Group的其他标准一起使用',
                    'D' => '只能在特定行业中使用'
                ],
                'correct_answer' => 'B',
                'explanation' => 'TOGAF被设计为可以与其他管理框架和标准集成使用，如ITIL（IT服务管理）、COBIT（IT治理）、PRINCE2（项目管理）等。这种灵活性使组织能够创建适合其特定需求的综合方法。',
                'difficulty' => 'medium',
                'bloom_level' => 'understanding'
            ],
            [
                'question_text' => '企业架构的范围可以是什么？',
                'options' => [
                    'A' => '只能是整个企业',
                    'B' => '可以是整个企业、部门、业务单元或单个项目',
                    'C' => '只能是IT部门',
                    'D' => '必须包括所有外部合作伙伴'
                ],
                'correct_answer' => 'B',
                'explanation' => '企业架构的范围是灵活的，可以根据需要进行调整。它可以涵盖整个企业、特定部门、业务单元，甚至单个项目。关键是明确定义架构工作的边界和范围。',
                'difficulty' => 'easy',
                'bloom_level' => 'understanding'
            ]
        ];

        foreach ($questions as $index => $q) {
            Question::create([
                'exam_id' => $examId,
                'learning_outcome_id' => null,
                'content' => $q['question_text'],
                'options' => $q['options'],
                'correct_answer' => $q['correct_answer'],
                'explanation' => $q['explanation'],
                'knowledge_point' => 'Unit 1 - Concepts',
                'difficulty' => $q['difficulty'],
                'bloom_level' => $q['bloom_level'],
                'sort_order' => $index + 1
            ]);
        }
    }
}
