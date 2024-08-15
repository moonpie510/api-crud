### Задание

Написать микросервис работы с гостями используя язык программирования на выбор PHP или Go, можно пользоваться любыми opensource пакетами, также возможно реализовать с использованием фреймворков или без них. БД также любая на выбор, использующая SQL в качестве языка запросов.

Микросервис реализует API для CRUD операций над гостем. То есть принимает данные для создания, изменения, получения, удаления записей гостей хранящихся в выбранной базе данных.

Сущность "Гость" Имя, фамилия и телефон – обязательные поля. А поля телефон и email уникальны. В итоге у гостя должны быть следующие атрибуты: идентификатор, имя, фамилия, email, телефон, страна. Если страна не указана то доставать страну из номера телефона +7 - Россия и т.д.

Правила валидации нужно придумать и реализовать самостоятельно. Микросервис должен запускаться в Docker.

В ответах сервера должны присутствовать два заголовка X-Debug-Time и X-Debug-Memory, которые указывают сколько миллисекунд выполнялся запрос и сколько Кб памяти потребовалось соответственно

### Как установить
#### 1) Скачиваем репозиторий
```shell
git clone git@github.com:moonpie510/api-crud.git
    
или
    
git clone https://github.com/moonpie510/api-crud.git
```

#### 2) Скопировать файл .env и прописать в него свои данные для подключения к базе данных
```shell
cp .env.example .env

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=bnovo
DB_USERNAME=root
DB_PASSWORD=root
```

#### 3) Поднятие docker контейнера
```shell
docker compose up -d
```

#### 4) Установка зависимостей
```shell
docker exec docker_php composer install
```

#### 5) Генерация ключа (если надо)
```shell
docker exec docker_php php artisan key:generate
```

#### 6) Миграция с seed
```shell
docker exec docker_php php atrisan migrate --seed
```

#### 7) Запуск сервера
```shell
docker exec docker_php php artisan serve
```

### Что реализовано
- Seed для первичного наполнения базы данных контентом.
- Созданы две таблицы (Guest, Country), которые связаны через foreign key. В таблице Country находятся страны, которые может выбрать пользователь, которые загружаются из json(database/seeders/countries.json).
- API для выполнения CRUD операций для Guest. Реализована валидация, а так же данные отдаются в виде коллекции Resource
- С помощью стороннего пакета [Laravel Phone](https://github.com/Propaganistas/Laravel-Phone?ysclid=lzveqfvbp9963468365), пользователю автоматически присваивается страна в зависимости от указанного телефона, если он ее не указал.
- Добавлены заголовки X-Debug-Time и X-Debug-Memory, которые считают время и память запроса.

### API маршруты

| Тип запроса | API                     | Описание         |
|-------------|-------------------------|------------------|
| GET         | api/guests              | Список гостей    |
| POST        | api/guests              | Добавление гостя |
| GET         | api/guests/{guest}      | Вывод гостя      |
| PATCH       | api/guests/{guest}      | Изменение гостя  |
| DELETE      | api/guests/{guest}      | Удаление гостя   |
| GET         | api/countries           | Список стран     |
| GET         | api/countries/{country} | Вывод страны     |

Список гостей

```
GET /api/guests
```

Создать гостя

country_id можно не указывать

```
POST /api/guests
{
    "name": "aboba",
    "surname": "aboba",
    "email": "aboba@mail.ru",
    "phone": "+79531875434"
    "country_id": 26
}
```

Получить гостя

```
GET /api/guests/{guest}
```

Обновить гостя

```
PUT /api/guests/{guest}
{
    "name": "aboba2",
    "surname": "aboba2",
    "email": "aboba@mail.ru",
    "phone": "+79531875434"
    "country_id": 26
}
```

Удалить гостя

```
DELETE /api/guests/{guest}
```

Список стран

```
GET /api/countries
```

Вывести страну по id

```
GET /api/countries/{country}
```


