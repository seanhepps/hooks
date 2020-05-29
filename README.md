# hooks
类似WordPress的钩子机制，单独的类包，可直接用于laravel、thinkphp等框架

## laravel添加服务提供者
`\seanhepps\hooks\HookServiceProvider::class`
## 添加别名
`'Hook'  =>  \seanhepps\hooks\Facades\Hook::class`

## 添加钩子
`Hook::getAction()->register($name, $class, 20)`

## 保存到文件
`Hook::getAction()->save()`

## 监听
`Hook::action($hookName, $args)`
