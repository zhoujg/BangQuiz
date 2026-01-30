#!/bin/bash

echo "🔄 重新组织项目结构..."

# 1. 备份旧的backend目录
echo "📦 备份旧的backend目录..."
mv backend backend_old

# 2. 将新的Laravel项目移到正确位置
echo "📦 移动新的Laravel项目..."
mv backend_old/backend backend

# 3. 清理旧文件
echo "🗑️  清理旧文件..."
rm -rf backend_old

echo ""
echo "✅ 项目结构重组完成！"
echo ""
echo "📂 当前结构："
echo "BangQuiz/"
echo "├── backend/          ← Laravel 10项目"
echo "├── frontend/         ← Ionic Angular项目"
echo "└── docs/            ← 文档"
echo ""
echo "📝 下一步："
echo "1. cd backend"
echo "2. php artisan serve"
echo ""
echo "前端："
echo "1. cd frontend"
echo "2. npm install"
echo "3. ionic serve"
