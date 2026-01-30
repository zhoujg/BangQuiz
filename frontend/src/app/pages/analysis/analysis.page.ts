import { Component, OnInit } from '@angular/core';
import { ApiService } from '../../services/api.service';

@Component({
  selector: 'app-analysis',
  templateUrl: './analysis.page.html',
  styleUrls: ['./analysis.page.scss']
})
export class AnalysisPage implements OnInit {
  weaknessReport: any = null;
  prediction: any = null;
  examPackageId: number = 1; // 当前测验包ID

  constructor(private apiService: ApiService) {}

  ngOnInit() {
    this.loadAnalysis();
  }

  loadAnalysis() {
    this.apiService.getWeaknessReport(this.examPackageId).subscribe({
      next: (data) => {
        this.weaknessReport = data;
      },
      error: (err) => console.error('加载弱点分析失败', err)
    });

    this.apiService.getPassPrediction(this.examPackageId).subscribe({
      next: (data) => {
        this.prediction = data;
      },
      error: (err) => console.error('加载通过率预测失败', err)
    });
  }

  getWeaknessColor(level: string): string {
    const colors: any = {
      'strong': 'success',
      'normal': 'primary',
      'weak': 'warning',
      'critical': 'danger'
    };
    return colors[level] || 'medium';
  }

  getWeaknessLabel(level: string): string {
    const labels: any = {
      'strong': '掌握良好',
      'normal': '一般',
      'weak': '薄弱',
      'critical': '严重薄弱'
    };
    return labels[level] || level;
  }
}
