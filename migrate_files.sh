#!/bin/bash

echo "🔄 开始迁移文件到新的Laravel项目..."

# 源目录（旧的backend）
OLD_BACKEND="backend"
# 目标目录（新的Laravel项目）
NEW_BACKEND="backend/backend"

# 1. 复制数据库迁移文件
echo "📦 复制数据库迁移文件..."
cp -r ${OLD_BACKEND}/database/migrations/*.php ${NEW_BACKEND}/database/migrations/ 2>/dev/null || echo "迁移文件已存在或不需要复制"

# 2. 复制Seeders
echo "📦 复制Seeders..."
cp -r ${OLD_BACKEND}/database/seeders/*.php ${NEW_BACKEND}/database/seeders/ 2>/dev/null || echo "Seeder文件已存在或不需要复制"

# 3. 复制Models
echo "📦 复制Models..."
cp -r ${OLD_BACKEND}/app/Models/*.php ${NEW_BACKEND}/app/Models/ 2>/dev/null || echo "Model文件已存在或不需要复制"

# 4. 复制Controllers
echo "📦 复制Controllers..."
mkdir -p ${NEW_BACKEND}/app/Http/Controllers/Api
cp -r ${OLD_BACKEND}/app/Http/Controllers/Api/*.php ${NEW_BACKEND}/app/Http/Controllers/Api/ 2>/dev/null || echo "Controller文件已存在或不需要复制"

# 5. 复制Services
echo "📦 复制Services..."
mkdir -p ${NEW_BACKEND}/app/Services
cp -r ${OLD_BACKEND}/app/Services/*.php ${NEW_BACKEND}/app/Services/ 2>/dev/null || echo "Service文件已存在或不需要复制"

# 6. 复制Middleware
echo "📦 复制Middleware..."
cp ${OLD_BACKEND}/app/Http/Middleware/*.php ${NEW_BACKEND}/app/Http/Middleware/ 2>/dev/null || echo "Middleware文件已存在或不需要复制"

# 7. 复制Kernel
echo "📦 复制Kernel..."
cp ${OLD_BACKEND}/app/Http/Kernel.php ${NEW_BACKEND}/app/Http/ 2>/dev/null || echo "Kernel文件已存在或不需要复制"

# 8. 复制Providers
echo "📦 复制Providers..."
cp ${OLD_BACKEND}/app/Providers/*.php ${NEW_BACKEND}/app/Providers/ 2>/dev/null || echo "Provider文件已存在或不需要复制"

# 9. 复制Routes
echo "📦 复制Routes..."
cp ${OLD_BACKEND}/routes/api.php ${NEW_BACKEND}/routes/ 2>/dev/null || echo "Routes文件已存在或不需要复制"

# 10. 复制Config
echo "📦 复制Config..."
cp ${OLD_BACKEND}/config/cors.php ${NEW_BACKEND}/config/ 2>/dev/null || echo "CORS配置已存在或不需要复制"

# 11. 复制.env
echo "📦 复制.env配置..."
cp ${OLD_BACKEND}/.env ${NEW_BACKEND}/.env 2>/dev/null || echo ".env文件已存在"

echo ""
echo "✅ 文件迁移完成！"
echo ""
echo "📝 下一步："
echo "1. cd backend/backend"
echo "2. php artisan migrate"
echo "3. php artisan db:seed --class=TOGAFCompleteSeeder"
echo "4. php artisan serve"
