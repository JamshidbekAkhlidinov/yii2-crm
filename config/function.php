<?php
/*
 *   Jamshidbek Akhlidinov
 *   29 - 11 2023 17:26:12
 *   https://ustadev.uz
 *   https://github.com/JamshidbekAkhlidinov/yii2basic
 */

use app\modules\admin\enums\LanguageEnum;
use app\modules\admin\forms\MessageForm;
use app\modules\admin\models\I18nSourceMessage;
use yii\helpers\FileHelper;
use yii\helpers\Html;

if (!function_exists('app')) {
    function app()
    {
        return \Yii::$app;
    }
}

if (!function_exists('controller')) {
    function controller()
    {
        return \Yii::$app->controller;
    }
}

if (!function_exists('module')) {
    function module()
    {
        return \Yii::$app->controller->module;
    }
}

if (!function_exists('user')) {
    function user()
    {
        return \Yii::$app->user;
    }
}

if (!function_exists('authManager')) {
    function authManager()
    {
        return \Yii::$app->authManager;
    }
}


if (!function_exists('can')) {
    function can($permission)
    {
        return \Yii::$app->user->can($permission);
    }
}

if (!function_exists('security')) {
    function security()
    {
        return Yii::$app->getSecurity();
    }
}

if (!function_exists('post')) {
    function post($attribute = null)
    {
        return Yii::$app->request->post($attribute);
    }
}

if (!function_exists('get')) {
    function get($attribute = null)
    {
        return Yii::$app->request->get($attribute);
    }
}


if (!function_exists('session')) {
    function session()
    {
        return Yii::$app->session;
    }
}

if (!function_exists('params')) {
    function &params()
    {
        return Yii::$app->params;
    }
}


if (!function_exists('icon')) {
    function icon($name = null, $options = [])
    {
        $icon = 'ri';
        $type = 'line';

        if (isset($options['icon'])) {
            $icon = $options['icon'];
        }

        if (isset($options['type'])) {
            $type = $options['type'];
        }

        $name = $icon . ' ' . $name;
        if ($icon == 'ri') {
            $name = $icon . '-' . $name . '-' . $type;
        }

        if (isset($options['class'])) {
            $name .= ' ' . $options['class'];
        }

        $options['class'] = $name;

        return Html::tag('i', '', $options);
    }
}


if (!function_exists('env')) {
    function env($attribute = null, $default = "")
    {
        return $_ENV[$attribute] ?? $default;
    }
}


if (!function_exists('translate')) {
    function translate($text, $options = []): string
    {
        saveFileDataForTranslate("app", $text);
        //autoTranslate('app', $text);
        return \Yii::t('app', $text, $options);
    }
}

if (!function_exists('translateBotMessage')) {
    function translateBotMessage($text, $options = []): string
    {
        saveFileDataForTranslate("app_bot", $text);
        //autoTranslate('app_bot', $text);
        return Yii::t('app_bot', $text, $options);
    }
}

if (!function_exists('autoTranslate')) {
    function autoTranslate($category, $text)
    {
        $message = I18nSourceMessage::findOne(['category' => $category, 'message' => $text]);
        if (!$message) {
            $model = new I18nSourceMessage([
                'category' => $category,
                'message' => $text,
            ]);
            $items = [];
            foreach (LanguageEnum::LABELS as $key => $label) {
                $items[$key] = googleTranslate($text, $key);
            }
            $form = new MessageForm($model);
            $form->items = $items;
            $form->save();
        }
    }
}

if (!function_exists('googleTranslate')) {
    function googleTranslate($text, $language)
    {
        $text = str_replace("\n", "", $text);
        $url = "https://translate.googleapis.com/translate_a/single?client=gtx&sl=auto&tl=" . $language . "&hl=en-US&dt=t&dt=bd&dj=1&source=bubble&tk=708340.708340&q=" . urlencode($text);
        $get = file_get_contents($url);
        $array = json_decode($get, true);
        return implode("\n", array_column($array['sentences'], 'trans'));
    }
}

if (!function_exists('saveFileDataForTranslate')) {
    function saveFileDataForTranslate($filename, $text)
    {
        $file = Yii::getAlias("@app/web/") . 'json/' . $filename . ".json";
        if (file_exists($file)) {
            $fileContent = file_get_contents($file);
        } else {
            $fileContent = '[]';
        }
        $arrayData = json_decode($fileContent, true);
        $texts = array_column($arrayData, 'value');

        if (!in_array($text, $texts)) {
            $arrayData[] = ['category' => $filename, 'value' => $text];
        }
        file_put_contents($file, json_encode($arrayData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }
}


if(!function_exists('getAllRoutes')){
    function getAllRoutes($basePath, $baseNamespace = 'app') {
        $allRoutes = [];

        $controllerPath = $basePath . '/controllers';
        if (is_dir($controllerPath)) {
            $controllers = FileHelper::findFiles($controllerPath, ['only' => ['*Controller.php']]);

            foreach ($controllers as $controller) {
                $controllerName = basename($controller, 'Controller.php');
                $namespace = "{$baseNamespace}\\controllers\\{$controllerName}Controller";
                if (class_exists($namespace)) {
                    $reflection = new ReflectionClass($namespace);
                    $methods = $reflection->getMethods(ReflectionMethod::IS_PUBLIC);

                    foreach ($methods as $method) {
                        if (str_starts_with($method->name, 'action') && $method->name !== 'actions') {
                            $actionName = strtolower(str_replace('action', '', $method->name));
                            $controllerRoute = strtolower(str_replace('Controller', '', $controllerName));
                            $allRoutes[] = "{$controllerRoute}/{$actionName}";
                        }
                    }
                }
            }
        }

        $modulesPath = $basePath . '/modules';
        if (is_dir($modulesPath)) {
            $modules = FileHelper::findDirectories($modulesPath, ['recursive' => false]);
            foreach ($modules as $moduleDir) {
                $moduleName = basename($moduleDir);
                $moduleNamespace = "{$baseNamespace}\\modules\\{$moduleName}";
                $moduleRoutes = getAllRoutes($moduleDir, $moduleNamespace);
                foreach ($moduleRoutes as $route) {
                    $allRoutes[] = "{$moduleName}/{$route}";
                }
            }
        }
        return $allRoutes;
    }
}


