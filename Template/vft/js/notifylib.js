// Базовый контейнер уведомлений

const notificationContainer = document.querySelector('.notification-container');

// Дата-контейнер с информацией о статусе авторизации пользователя

const notificationAuthData = document.querySelector('#notification-auth-data');

// Шаблон функции создания уведомлений
/**
 * 
 * @param {*} name Задает заголовок уведомления
 * @param {*} actionName Текст внутри кнопки на уведомлении
 * @param {*} notificationText Текст уведомления
 * @param {*} addClassName Дополнительный класс для уведомления
 */

function createNotification(addClassName, actionName, notificationText, name) {
    // Проверяем видел ли пользователь уведомление ранее, если видел - не рисуем его
    let storageItemName = addClassName + 'Accepted';
    if (localStorage.getItem(storageItemName) != 'true') {
        // Создаем новый DIV для вставки шаблона
        let newElement = document.createElement('div');
        // Шаблон уведомления
        newElement.innerHTML = '<div class="popup ' + addClassName + '-main">' +
            '<div class="' + addClassName + ' popup__head">' + '<p class="' + addClassName + ' popup__title">' + name + '</p>' + '</div>' + '<p class="' + addClassName + ' popup__text">' + notificationText + '</p>' + '<div class="popup-actions">' + '<a class="popup__confirm ' + addClassName + '-confirm" href="#">' + actionName + '</a>' + '</div>' + '</div>';
        // Добавляем уведомление в контейнер 
        notificationContainer.appendChild(newElement);
    }
}

/**
 * 
 * @param {*} className Имя класса уведомления на которое вешается событие, дубль переменной addClassName функции createNotification
 */

function logicNotification(className) {
    let notificationMainName = '.' + className + '-main';
    let notificationActionName = '.' + className + '-confirm';
    let storageItemName = className + 'Accepted';
    let notificationMain = document.querySelector(notificationMainName);
    let acceptBtn = notificationMain.querySelector(notificationActionName);
    if (localStorage.getItem(storageItemName) != 'true') {
        notificationMain.classList.add('popup_active');
        // Событие на клик по кнопке внутри уведомления
        acceptBtn.addEventListener('click', () => {
            notificationMain.classList.remove('popup_active');
            localStorage.setItem(storageItemName, true);
        })
    }
}

// Функция возвращающая результат проверки авторизации пользователя

function userAuthCheck() {
    if (notificationAuthData.dataset.auth == 'true') {
        return true;
    }
    else {
        return false;
    }
}

// Уведомление о необходимости регистрации
createNotification('notify1', 'Ok', 'Ммммм, хуета', 'Тестовый ноти');
// Логика текущего уведомления
logicNotification('notify1');


createNotification('notify2', 'Ok', 'Охуеть, вот это да, вот это кайф, вааааай', 'Оно работает и похуй');
logicNotification('notify2');

if (userAuthCheck() == false) {
    createNotification('notify3', 'ШААА!', 'Это покажет только неавторизованному пользователю', 'Проверочка на логин')
}


