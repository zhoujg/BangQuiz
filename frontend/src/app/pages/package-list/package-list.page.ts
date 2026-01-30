import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { ApiService } from '../../services/api.service';

@Component({
  selector: 'app-package-list',
  templateUrl: './package-list.page.html',
  styleUrls: ['./package-list.page.scss']
})
export class PackageListPage implements OnInit {
  packages: any[] = [];

  constructor(
    private router: Router,
    private apiService: ApiService
  ) {}

  ngOnInit() {
    this.loadPackages();
  }

  loadPackages() {
    this.apiService.getExamPackages().subscribe({
      next: (data) => {
        this.packages = data;
      },
      error: (err) => console.error('加载测验包失败', err)
    });
  }

  selectPackage(packageId: number) {
    this.router.navigate(['/exams', packageId]);
  }
}
