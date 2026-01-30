import { NgModule } from '@angular/core';
import { PreloadAllModules, RouterModule, Routes } from '@angular/router';

const routes: Routes = [
  {
    path: '',
    redirectTo: 'home',
    pathMatch: 'full'
  },
  {
    path: 'home',
    loadChildren: () => import('./pages/home/home.module').then(m => m.HomePageModule)
  },
  {
    path: 'learning-path',
    loadChildren: () => import('./pages/learning-path/learning-path.module').then(m => m.LearningPathPageModule)
  },
  {
    path: 'question',
    loadChildren: () => import('./pages/question/question.module').then(m => m.QuestionPageModule)
  },
  {
    path: 'analysis',
    loadChildren: () => import('./pages/analysis/analysis.module').then(m => m.AnalysisPageModule)
  },
  {
    path: 'package-list',
    loadChildren: () => import('./pages/package-list/package-list.module').then(m => m.PackageListPageModule)
  },
  {
    path: 'exam-list/:id',
    loadChildren: () => import('./pages/exam-list/exam-list.module').then(m => m.ExamListPageModule)
  }
];

@NgModule({
  imports: [
    RouterModule.forRoot(routes, { preloadingStrategy: PreloadAllModules })
  ],
  exports: [RouterModule]
})
export class AppRoutingModule {}
