## Weather

PHP天气查询扩展组件

#### 安装

```
composer require hesunfly/weather
```

#### 使用

使用前需要在高德地图开放平台申请天气查询接口的key

##### 代码示例

基本使用：

1. 获取实时天气：

```
use Hesunfly\Weather\Weather;

$weather = new Weather('高德地图key');

$weather->getWeather('城市名称');
```

2. 获取预告天气：

```
use Hesunfly\Weather\Weather;

$weather = new Weather('高德地图key');

$weather->getWeather('城市名称', 'all');
```

3. 获取xml形式的数据：

```
use Hesunfly\Weather\Weather;

$weather = new Weather('高德地图key');

$weather->getWeather('城市名称', 'base', 'xml');
```

参数说明：

getWeather('城市名称', '返回天气类型：@base:实况天气；@all:预报天气'，'返回数据格式：@json; @xml')



## License

MIT