import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { ApiService } from '../../services/api.service';
import { AlertController } from '@ionic/angular';

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
    private apiService: ApiService,
    private alertController: AlertController
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

  async goToMockExam() {
    // 弹出选择对话框，让用户选择考试级别
    const alert = await this.alertController.create({
      header: '选择模拟考试级别',
      message: '请选择你要参加的模拟考试',
      buttons: [
        {
          text: 'Level 1 Foundation',
          handler: () => {
            this.router.navigate(['/package-list']);
          }
        },
        {
          text: 'Level 2 Practitioner',
          handler: () => {
            this.router.navigate(['/package-list']);
          }
        },
        {
          text: '取消',
          role: 'cancel'
        }
      ]
    });

    await alert.present();
  }

  goToAnalysis() {
    this.router.navigate(['/analysis']);
  }

  async goToADMMap() {
    const alert = await this.alertController.create({
      header: '功能开发中',
      message: 'ADM 架构开发方法地图功能正在开发中，敬请期待！',
      buttons: ['确定']
    });
    await alert.present();
  }

  async openProfile() {
    const alert = await this.alertController.create({
      header: '功能开发中',
      message: '个人资料功能正在开发中，敬请期待！',
      buttons: ['确定']
    });
    await alert.present();
  }
}
