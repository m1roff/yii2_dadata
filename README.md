# Расширение для работы с dadata и другие мелочи

## Подключение

В конфиг файле

```php
'modules' => [
    'dadata' => [
        'class' => 'm1roff\dadata\Module',
        'token' => '',
        'secret' => '',
    ],
],
```

## Использование

### Гражданство

```php
$form->field($model, 'citizenship')->widget(SuggestWidget::class, [
    'type' => SuggestWidget::TYPE_CITIZENSHIP,
    'options' => [
        'placeholder' => 'Гражданство',
        'class' => 'form-control input-lg lrr-input',
    ],
])
```
