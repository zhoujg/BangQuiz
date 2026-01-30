import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { AlertController } from '@ionic/angular';
import { ApiService } from '../../services/api.service';

@Component({
  selector: 'app-question',
  templateUrl: './question.page.html',
  styleUrls: ['./question.page.scss']
})
export class QuestionPage implements OnInit {
  questions: any[] = []; // 所有题目
  currentQuestionIndex: number = 0; // 当前题目索引
  totalQuestions: number = 0; // 总题目数
  question: any = null;
  selectedAnswer: string = '';
  showResult: boolean = false;
  isCorrect: boolean = false;
  explanation: string = '';
  startTime: number = 0;
  examId: number = 1; // 当前测验ID
  unitId: number | null = null; // 学习单元ID
  mode: string = 'exam'; // 模式：exam, unit-practice, mock-exam
  
  // 统计数据
  correctCount: number = 0;
  isCompleted: boolean = false;

  constructor(
    private apiService: ApiService,
    private route: ActivatedRoute,
    private router: Router,
    private alertController: AlertController
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
      this.loadQuestions();
    });
  }

  loadQuestions() {
    // 根据模式加载题目列表
    if (this.mode === 'unit-practice' && this.unitId) {
      // 加载特定学习单元的题目
      this.apiService.getUnitQuestions(this.unitId).subscribe({
        next: (data) => {
          this.questions = data || [];
          this.totalQuestions = this.questions.length;
          if (this.totalQuestions > 0) {
            this.loadCurrentQuestion();
          }
        },
        error: (err) => console.error('加载题目失败', err)
      });
    } else {
      // 默认模式：逐个加载
      this.loadNextQuestion();
    }
  }

  loadCurrentQuestion() {
    if (this.currentQuestionIndex < this.totalQuestions) {
      this.question = this.questions[this.currentQuestionIndex];
      this.showResult = false;
      this.selectedAnswer = '';
      this.startTime = Date.now();
    } else {
      // 所有题目完成
      this.isCompleted = true;
    }
  }

  loadNextQuestion() {
    this.showResult = false;
    this.selectedAnswer = '';
    this.startTime = Date.now();
    
    // 默认加载下一题
    this.apiService.getNextQuestion(this.examId).subscribe({
      next: (data) => {
        this.question = data;
      },
      error: (err) => console.error('加载题目失败', err)
    });
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
        
        // 更新统计
        if (this.isCorrect) {
          this.correctCount++;
        }
      },
      error: (err) => console.error('提交答案失败', err)
    });
  }

  nextQuestion() {
    this.currentQuestionIndex++;
    
    if (this.mode === 'unit-practice' && this.questions.length > 0) {
      // 单元练习模式：加载下一题
      this.loadCurrentQuestion();
    } else {
      // 其他模式：加载新题目
      this.loadNextQuestion();
    }
  }

  restartPractice() {
    this.currentQuestionIndex = 0;
    this.correctCount = 0;
    this.isCompleted = false;
    this.loadCurrentQuestion();
  }

  async exitPractice() {
    const alert = await this.alertController.create({
      header: '确认退出',
      message: '确定要退出练习吗？当前进度将不会保存。',
      buttons: [
        {
          text: '取消',
          role: 'cancel'
        },
        {
          text: '退出',
          handler: () => {
            this.router.navigate(['/learning-path']);
          }
        }
      ]
    });

    await alert.present();
  }
}
