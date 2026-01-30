import { Component, OnInit } from '@angular/core';
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

  constructor(private apiService: ApiService) {}

  ngOnInit() {
    this.loadNextQuestion();
  }

  loadNextQuestion() {
    this.showResult = false;
    this.selectedAnswer = '';
    this.startTime = Date.now();
    
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
      },
      error: (err) => console.error('提交答案失败', err)
    });
  }

  nextQuestion() {
    this.loadNextQuestion();
  }
}
