import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { ApiService } from '../../services/api.service';

@Component({
  selector: 'app-question',
  templateUrl: './question.page.html',
  styleUrls: ['./question.page.scss']
})
export class QuestionPage implements OnInit {
  question: any = null;
  selectedAnswer: string = '';
  showResult: boolean = false;
  isCorrect: boolean = false;
  explanation: string = '';
  startTime: number = 0;
  examId: number = 1; // 当前测验ID
  unitId: number | null = null; // 学习单元ID
  mode: string = 'exam'; // 模式：exam, unit-practice, mock-exam

  constructor(
    private apiService: ApiService,
    private route: ActivatedRoute
  ) {}

  ngOnInit() {
    // 获取路由参数
    this.route.queryParams.subscribe(params => {
      if (params['unitId']) {
        this.unitId = +params['unitId'];
        this.mode = params['mode'] || 'unit-practice';
      }
      if (params['examType']) {
        this.mode = 'mock-exam';
      }
      this.loadNextQuestion();
    });
  }

  loadNextQuestion() {
    this.showResult = false;
    this.selectedAnswer = '';
    this.startTime = Date.now();
    
    // 根据模式加载不同的题目
    if (this.mode === 'unit-practice' && this.unitId) {
      // 加载特定学习单元的题目
      this.apiService.getUnitQuestions(this.unitId).subscribe({
        next: (data) => {
          if (data && data.length > 0) {
            // 随机选择一个题目
            this.question = data[Math.floor(Math.random() * data.length)];
          }
        },
        error: (err) => console.error('加载题目失败', err)
      });
    } else {
      // 默认加载下一题
      this.apiService.getNextQuestion(this.examId).subscribe({
        next: (data) => {
          this.question = data;
        },
        error: (err) => console.error('加载题目失败', err)
      });
    }
  }

  submitAnswer() {
    if (!this.selectedAnswer) return;

    const timeSpent = Math.floor((Date.now() - this.startTime) / 1000);

    this.apiService.submitAnswer(
      this.question.id,
      this.selectedAnswer,
      timeSpent
    ).subscribe({
      next: (result) => {
        this.showResult = true;
        this.isCorrect = result.is_correct;
        this.explanation = result.explanation;
      },
      error: (err) => console.error('提交答案失败', err)
    });
  }

  nextQuestion() {
    this.loadNextQuestion();
  }
}
