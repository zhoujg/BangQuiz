#!/bin/bash

echo "🛑 停止 TOGAF Master 服务器"
echo "================================"
echo ""

# 读取PID
if [ -f .backend.pid ]; then
    BACKEND_PID=$(cat .backend.pid)
    echo "🔧 停止后端服务器 (PID: $BACKEND_PID)..."
    kill $BACKEND_PID 2>/dev/null && echo "   ✅ 后端已停止" || echo "   ⚠️  后端进程不存在"
    rm .backend.pid
else
    echo "⚠️  未找到后端PID文件"
fi

if [ -f .frontend.pid ]; then
    FRONTEND_PID=$(cat .frontend.pid)
    echo "🎨 停止前端服务器 (PID: $FRONTEND_PID)..."
    kill $FRONTEND_PID 2>/dev/null && echo "   ✅ 前端已停止" || echo "   ⚠️  前端进程不存在"
    rm .frontend.pid
else
    echo "⚠️  未找到前端PID文件"
fi

# 清理可能残留的进程
echo ""
echo "🧹 清理残留进程..."
pkill -f "php artisan serve --port=9527" 2>/dev/null
pkill -f "ionic serve" 2>/dev/null

echo ""
echo "================================"
echo "✅ 服务器已停止"
echo "================================"
