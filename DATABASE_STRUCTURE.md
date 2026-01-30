# 数据库结构说明

## 核心概念

```
测验包 (ExamPackage)
    └── 测验 (Exam)
            └── 题目 (Question)
```

### 1. 测验包 (exam_packages)
测验包是最顶层的概念，代表一个完整的学习主题。

**示例：**
- TOGAF 10 企业架构
- BIZBOK 业务架构
- AWS Solutions Architect
- PMP 项目管理

**字段：**
- `name`: 测验包名称
- `code`: 唯一标识码
- `description`: 描述
- `cover_image`: 封面图片
- `is_active`: 是否启用

### 2. 测验 (exams)
测验是测验包下的具体章节或主题测试。

**示例（TOGAF测验包下）：**
- 第1章：ADM概述
- 第2章：架构愿景
- 第3章：业务架构
- 第4章：信息系统架构
- 模拟考试1
- 模拟考试2

**字段：**
- `exam_package_id`: 所属测验包
- `title`: 测验标题
- `chapter`: 章节编号（可选）
- `description`: 描述
- `question_count`: 题目数量
- `time_limit`: 时间限制（分钟）
- `pass_score`: 及格分数
- `sort_order`: 排序
- `is_active`: 是否启用

### 3. 题目 (questions)
具体的测验题目。

**字段：**
- `exam_id`: 所属测验
- `content`: 题目内容
- `options`: 选项（JSON）
- `correct_answer`: 正确答案
- `explanation`: 详细解析
- `knowledge_point`: 知识点标签
- `difficulty`: 难度（easy/medium/hard）
- `scenario`: 场景案例（可选）
- `sort_order`: 排序

### 4. 用户答题记录 (user_answers)
记录用户的每次答题。

**字段：**
- `user_id`: 用户ID
- `question_id`: 题目ID
- `user_answer`: 用户答案
- `is_correct`: 是否正确
- `time_spent`: 答题用时（秒）
- `answered_at`: 答题时间

### 5. 弱点分析 (weakness_analysis)
按测验包统计用户在各知识点的掌握情况。

**字段：**
- `user_id`: 用户ID
- `exam_package_id`: 测验包ID
- `knowledge_point`: 知识点
- `total_attempts`: 总答题次数
- `correct_attempts`: 正确次数
- `accuracy_rate`: 正确率
- `weakness_level`: 弱点等级（strong/normal/weak/critical）

### 6. 复习计划 (review_schedule)
基于SM-2算法的智能复习安排。

**字段：**
- `user_id`: 用户ID
- `question_id`: 题目ID
- `repetition`: 重复次数
- `easiness_factor`: 难度因子
- `interval`: 复习间隔（天）
- `next_review_at`: 下次复习时间

## 使用场景示例

### 场景1：用户选择学习TOGAF
1. 获取测验包列表 → 显示"TOGAF 10 企业架构"
2. 点击进入 → 显示该包下的所有测验（第1章、第2章...）
3. 选择"第1章：ADM概述" → 开始答题
4. 系统记录答题情况 → 更新弱点分析

### 场景2：智能推题
1. 用户在TOGAF包下做了100题
2. 系统分析发现"ADM核心概念"正确率只有40%（严重薄弱）
3. 下次获取题目时，优先推送"ADM核心概念"相关题目
4. 帮助用户针对性提升

### 场景3：记忆曲线复习
1. 用户答对一道题 → 系统安排1天后复习
2. 1天后再次答对 → 安排6天后复习
3. 6天后再次答对 → 安排15天后复习
4. 如果答错 → 重置为1天后复习

## 数据关系图

```
ExamPackage (测验包)
    ├── Exam (测验) × N
    │       └── Question (题目) × N
    │               └── UserAnswer (答题记录) × N
    │
    └── WeaknessAnalysis (弱点分析) × N
            └── 按知识点统计
```
