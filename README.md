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

如果想要更换缓存文件保存位置，可以修改Base类构造函数中的保存路径

## 监听
`Hook::action($hookName, $args)`

## 使用过滤器

使用过滤器和使用action钩子用法一模一样，只需要把上面`getAction`替换成`getFilter`就可以了

## 过滤器监听

`$result = Hook::filter($hookName, $args)`

