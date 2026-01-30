#!/bin/bash

echo "🚀 启动 TOGAF Master 服务器"
echo "================================"
echo ""

# 检查端口是否被占用
check_port() {
    if lsof -Pi :$1 -sTCP:LISTEN -t >/dev/null ; then
        echo "⚠️  警告: 端口 $1 已被占用"
        echo "   运行 'lsof -i :$1' 查看占用进程"
        echo "   运行 'kill -9 <PID>' 杀死进程"
        return 1
    fi
    return 0
}

echo "📡 检查端口..."
check_port 9527
BACKEND_PORT_OK=$?
check_port 9528
FRONTEND_PORT_OK=$?

if [ $BACKEND_PORT_OK -ne 0 ] || [ $FRONTEND_PORT_OK -ne 0 ]; then
    echo ""
    echo "❌ 端口被占用，请先释放端口"
    exit 1
fi

echo "✅ 端口检查通过"
echo ""

# 启动后端
echo "🔧 启动后端服务器 (端口 9527)..."
cd backend
php artisan serve --port=9527 > ../backend.log 2>&1 &
BACKEND_PID=$!
echo "   后端 PID: $BACKEND_PID"
cd ..

# 等待后端启动
sleep 2

# 启动前端
echo "🎨 启动前端服务器 (端口 9528)..."
cd frontend
ionic serve > ../frontend.log 2>&1 &
FRONTEND_PID=$!
echo "   前端 PID: $FRONTEND_PID"
cd ..

echo ""
echo "================================"
echo "✅ 服务器启动成功！"
echo ""
echo "📝 访问地址："
echo "   后端: http://localhost:9527"
echo "   前端: http://localhost:9528"
echo ""
echo "📊 进程信息："
echo "   后端 PID: $BACKEND_PID"
echo "   前端 PID: $FRONTEND_PID"
echo ""
echo "📋 日志文件："
echo "   后端: backend.log"
echo "   前端: frontend.log"
echo ""
echo "🛑 停止服务器："
echo "   kill $BACKEND_PID $FRONTEND_PID"
echo ""
echo "================================"

# 保存PID到文件
echo $BACKEND_PID > .backend.pid
echo $FRONTEND_PID > .frontend.pid

echo ""
echo "提示: 按 Ctrl+C 不会停止服务器"
echo "      使用 ./STOP_SERVERS.sh 停止服务器"
