import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';
import { environment } from '../../environments/environment';

@Injectable({
  providedIn: 'root'
})
export class ApiService {
  private apiUrl = environment.apiUrl;

  constructor(private http: HttpClient) {}

  private getHeaders(): HttpHeaders {
    return new HttpHeaders({
      'Content-Type': 'application/json',
      'Accept': 'application/json'
    });
  }

  // 测验包和测验
  getExamPackages(): Observable<any> {
    return this.http.get(`${this.apiUrl}/exam-packages`, {
      headers: this.getHeaders()
    });
  }

  getExams(packageId: number): Observable<any> {
    return this.http.get(`${this.apiUrl}/exam-packages/${packageId}/exams`, {
      headers: this.getHeaders()
    });
  }

  // 题目相关
  getNextQuestion(packageId: number): Observable<any> {
    return this.http.get(`${this.apiUrl}/questions/next`, {
      headers: this.getHeaders(),
      params: { package_id: packageId.toString() }
    });
  }

  getQuestion(questionId: number): Observable<any> {
    return this.http.get(`${this.apiUrl}/questions/${questionId}`, {
      headers: this.getHeaders()
    });
  }

  getUnitQuestions(unitId: number): Observable<any> {
    return this.http.get(`${this.apiUrl}/learning-units/${unitId}/questions`, {
      headers: this.getHeaders()
    });
  }

  submitAnswer(questionId: number, selectedOption: string, timeSpent: number): Observable<any> {
    return this.http.post(`${this.apiUrl}/questions/answer`, 
      { 
        question_id: questionId, 
        selected_option: selectedOption, 
        time_spent: timeSpent 
      },
      { headers: this.getHeaders() }
    );
  }

  // 学习路径
  getLearningUnits(packageId?: number): Observable<any> {
    const params: any = {};
    if (packageId) {
      params.package_id = packageId.toString();
    }
    return this.http.get(`${this.apiUrl}/learning-units`, {
      headers: this.getHeaders(),
      params
    });
  }

  getLearningProgress(packageId: number): Observable<any> {
    return this.http.get(`${this.apiUrl}/learning-progress/${packageId}`, {
      headers: this.getHeaders()
    });
  }

  // 分析相关
  getWeaknessReport(packageId: number): Observable<any> {
    return this.http.get(`${this.apiUrl}/analysis/weakness`, {
      headers: this.getHeaders(),
      params: { package_id: packageId.toString() }
    });
  }

  getPassPrediction(packageId: number): Observable<any> {
    return this.http.get(`${this.apiUrl}/analysis/prediction`, {
      headers: this.getHeaders(),
      params: { package_id: packageId.toString() }
    });
  }

  getUserStats(): Observable<any> {
    return this.http.get(`${this.apiUrl}/analysis/stats`, {
      headers: this.getHeaders()
    });
  }

  getDueReviews(packageId: number): Observable<any> {
    return this.http.get(`${this.apiUrl}/review/due`, {
      headers: this.getHeaders(),
      params: { package_id: packageId.toString() }
    });
  }
}
