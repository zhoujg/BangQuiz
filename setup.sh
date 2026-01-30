#!/bin/bash

echo "🚀 TOGAF Master 项目初始化脚本"
echo "================================"

# 检查是否在项目根目录
if [ ! -d "backend" ] || [ ! -d "frontend" ]; then
    echo "❌ 错误：请在项目根目录运行此脚本"
    exit 1
fi

echo ""
echo "📦 步骤 1/5: 初始化Laravel项目..."
cd backend

# 检查composer
if ! command -v composer &> /dev/null; then
    echo "❌ 错误：未找到composer，请先安装composer"
    exit 1
fi

# 安装Laravel依赖
echo "正在安装Laravel依赖..."
composer install --no-interaction

# 生成应用密钥
echo "正在生成应用密钥..."
php artisan key:generate --force

echo "✅ Laravel初始化完成"

echo ""
echo "🗄️  步骤 2/5: 配置数据库..."
echo "请确保已创建数据库: togaf_master"
echo "数据库配置在 backend/.env 文件中"
read -p "按回车继续..."

# 运行迁移
echo "正在运行数据库迁移..."
php artisan migrate --force

echo "✅ 数据库迁移完成"

echo ""
echo "📝 步骤 3/5: 导入示例数据..."
php artisan db:seed --class=TOGAFCompleteSeeder --force

echo "✅ 示例数据导入完成"

echo ""
echo "📱 步骤 4/5: 初始化前端项目..."
cd ../frontend

# 检查npm
if ! command -v npm &> /dev/null; then
    echo "❌ 错误：未找到npm，请先安装Node.js"
    exit 1
fi

# 安装前端依赖
echo "正在安装前端依赖..."
npm install

echo "✅ 前端初始化完成"

echo ""
echo "🎉 步骤 5/5: 设置完成！"
echo ""
echo "================================"
echo "✅ 项目初始化成功！"
echo ""
echo "📝 下一步："
echo "1. 启动后端服务："
echo "   cd backend && php artisan serve"
echo ""
echo "2. 启动前端服务（新终端）："
echo "   cd frontend && ionic serve"
echo ""
echo "3. 访问应用："
echo "   前端: http://localhost:8100"
echo "   后端: http://localhost:8000"
echo ""
echo "================================"
