import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { ApiService } from '../../services/api.service';

@Component({
  selector: 'app-exam-list',
  templateUrl: './exam-list.page.html',
  styleUrls: ['./exam-list.page.scss']
})
export class ExamListPage implements OnInit {
  packageId: number = 0;
  packageName: string = '';
  exams: any[] = [];

  constructor(
    private route: ActivatedRoute,
    private router: Router,
    private apiService: ApiService
  ) {}

  ngOnInit() {
    this.packageId = Number(this.route.snapshot.paramMap.get('id'));
    this.loadExams();
  }

  loadExams() {
    this.apiService.getExams(this.packageId).subscribe({
      next: (data) => {
        this.exams = data;
      },
      error: (err) => console.error('加载测验列表失败', err)
    });
  }

  startExam(examId: number) {
    this.router.navigate(['/question', examId]);
  }
}
