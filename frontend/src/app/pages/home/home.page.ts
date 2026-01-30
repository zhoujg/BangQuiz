import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { ApiService } from '../../services/api.service';

@Component({
  selector: 'app-home',
  templateUrl: './home.page.html',
  styleUrls: ['./home.page.scss']
})
export class HomePage implements OnInit {
  level1Progress: number = 0;
  level2Progress: number = 0;
  userStats: any = null;

  constructor(
    private router: Router,
    private apiService: ApiService
  ) {}

  ngOnInit() {
    this.loadUserProgress();
    this.loadUserStats();
  }

  loadUserProgress() {
    // Load Level 1 progress
    this.apiService.getLearningProgress(1).subscribe({
      next: (data) => {
        this.level1Progress = data.overall_progress || 0;
      },
      error: (err) => console.error('加载Level 1进度失败', err)
    });

    // Load Level 2 progress
    this.apiService.getLearningProgress(2).subscribe({
      next: (data) => {
        this.level2Progress = data.overall_progress || 0;
      },
      error: (err) => console.error('加载Level 2进度失败', err)
    });
  }

  loadUserStats() {
    this.apiService.getUserStats().subscribe({
      next: (data) => {
        this.userStats = data;
      },
      error: (err) => console.error('加载用户统计失败', err)
    });
  }

  selectLevel(level: string) {
    this.router.navigate(['/learning-path'], { queryParams: { level } });
  }

  goToLearningPath() {
    this.router.navigate(['/learning-path']);
  }

  goToMockExam() {
    this.router.navigate(['/mock-exam']);
  }

  goToAnalysis() {
    this.router.navigate(['/analysis']);
  }

  goToADMMap() {
    this.router.navigate(['/adm-map']);
  }

  openProfile() {
    this.router.navigate(['/profile']);
  }
}
