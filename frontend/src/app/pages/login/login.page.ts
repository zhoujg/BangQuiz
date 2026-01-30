import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { ApiService } from '../../services/api.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.page.html',
  styleUrls: ['./login.page.scss']
})
export class LoginPage {
  email: string = '';
  password: string = '';
  errorMessage: string = '';
  isLoading: boolean = false;

  constructor(
    private router: Router,
    private apiService: ApiService
  ) {}

  login() {
    if (!this.email || !this.password) {
      this.errorMessage = '请输入邮箱和密码';
      return;
    }

    this.isLoading = true;
    this.errorMessage = '';

    this.apiService.login(this.email, this.password).subscribe({
      next: (response) => {
        // 保存token
        localStorage.setItem('auth_token', response.token);
        localStorage.setItem('user', JSON.stringify(response.user));
        
        // 跳转到首页
        this.router.navigate(['/home']);
      },
      error: (error) => {
        this.isLoading = false;
        this.errorMessage = error.error?.message || '登录失败，请检查邮箱和密码';
      }
    });
  }

  goToRegister() {
    this.router.navigate(['/register']);
  }
}
