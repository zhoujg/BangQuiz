import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { ApiService } from '../../services/api.service';

@Component({
  selector: 'app-learning-path',
  templateUrl: './learning-path.page.html',
  styleUrls: ['./learning-path.page.scss']
})
export class LearningPathPage implements OnInit {
  selectedLevel: string = 'level1';
  learningUnits: any[] = [];
  level1Progress: number = 0;
  level2Progress: number = 0;

  constructor(
    private router: Router,
    private apiService: ApiService
  ) {}

  ngOnInit() {
    this.loadLearningUnits();
    this.loadProgress();
  }

  loadLearningUnits() {
    const packageId = this.selectedLevel === 'level1' ? 1 : 2;
    this.apiService.getLearningUnits(packageId).subscribe({
      next: (data) => {
        this.learningUnits = data;
      },
      error: (err) => console.error('加载学习单元失败', err)
    });
  }

  loadProgress() {
    this.apiService.getLearningProgress(1).subscribe({
      next: (data) => {
        this.level1Progress = data.overall_progress || 0;
      }
    });
    
    this.apiService.getLearningProgress(2).subscribe({
      next: (data) => {
        this.level2Progress = data.overall_progress || 0;
      }
    });
  }

  getOutcomeIcon(masteryLevel: number): string {
    if (masteryLevel >= 80) return 'checkmark-circle';
    if (masteryLevel >= 60) return 'alert-circle';
    if (masteryLevel > 0) return 'time';
    return 'ellipse-outline';
  }

  getOutcomeColor(masteryLevel: number): string {
    if (masteryLevel >= 80) return 'success';
    if (masteryLevel >= 60) return 'warning';
    if (masteryLevel > 0) return 'primary';
    return 'medium';
  }

  getBloomColor(bloomLevel: string): string {
    const colors: any = {
      'remembering': 'success',
      'understanding': 'primary',
      'applying': 'danger'
    };
    return colors[bloomLevel] || 'medium';
  }

  getBloomLabel(bloomLevel: string): string {
    const labels: any = {
      'remembering': '记忆',
      'understanding': '理解',
      'applying': '应用'
    };
    return labels[bloomLevel] || bloomLevel;
  }

  startUnit(unitId: number) {
    this.router.navigate(['/unit-practice', unitId]);
  }

  viewUnitDetails(unitId: number) {
    this.router.navigate(['/unit-details', unitId]);
  }

  goToMockExam() {
    const examType = this.selectedLevel === 'level1' ? 'level1-mock' : 'level2-mock';
    this.router.navigate(['/mock-exam', examType]);
  }

  showLearningTips() {
    // 显示学习建议弹窗
    this.router.navigate(['/learning-tips']);
  }
}
