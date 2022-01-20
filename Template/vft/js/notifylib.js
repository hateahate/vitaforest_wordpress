// Notifylib for Vitaforest Platform
// Release v0.4
// Created by Stepan Pavlenko

// Базовый контейнер уведомлений

const notificationContainer = document.querySelector('.notification-container');

// Дата-контейнер с информацией о статусе авторизации пользователя

const notificationAuthData = document.querySelector('#notification-auth-data');

// Шаблон функции создания уведомлений
/**
 * 
 * @param {*} notificationName Задает заголовок уведомления
 * @param {*} actionName Текст внутри кнопки на уведомлении
 * @param {*} notificationText Текст уведомления
 * @param {*} className Дополнительный класс для уведомления
 */

function createNotification(notificationName, notificationText, actionName, className) {
    // Проверяем видел ли пользователь уведомление ранее, если видел - не рисуем его
    let storageItemName = className + 'Accepted';
    if (localStorage.getItem(storageItemName) != 'true') {
        // Создаем новый DIV для вставки шаблона
        let newElement = document.createElement('div');
        // Шаблон уведомления
        newElement.innerHTML = '<div class="popup ' + className + '-main">' +
            '<div class="' + className + ' popup__head">' + '<p class="' + className + ' popup__title">' + notificationName + '</p>' + '</div>' + '<p class="' + className + ' popup__text">' + notificationText + '</p>' + '<div class="popup-actions">' + '<a class="popup__confirm ' + className + '-confirm" href="#">' + actionName + '</a>' + '</div>' + '</div>';
        // Добавляем уведомление в контейнер 
        notificationContainer.appendChild(newElement);
        logicNotification(className);
    }
}

/**
 * @param {*} notificationUrl Ссылка прикрепленная к кнопке, для перехода по клику
 */

function createNotificationUrl(notificationName, notificationText, actionName, className, notificationUrl) {
    // Проверяем видел ли пользователь уведомление ранее, если видел - не рисуем его
    let storageItemName = className + 'Accepted';
    if (localStorage.getItem(storageItemName) != 'true') {
        // Создаем новый DIV для вставки шаблона
        let newElement = document.createElement('div');
        // Шаблон уведомления
        newElement.innerHTML = '<div class="popup ' + className + '-main">' +
            '<div class="' + className + ' popup__head">' + '<p class="' + className + ' popup__title">' + notificationName + '</p>' + '</div>' + '<p class="' + className + ' popup__text">' + notificationText + '</p>' + '<div class="popup-actions">' + '<a class="popup__confirm ' + className + '-confirm" href="' + notificationUrl + '">' + actionName + '</a>' + '</div>' + '</div>';
        // Добавляем уведомление в контейнер 
        notificationContainer.appendChild(newElement);
        logicNotification(className);
    }
}

/**
 * 
 * @param {*} className Имя класса уведомления на которое вешается событие, дубль переменной className функции createNotification
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

// Функция создания уведомления для неавторизованных пользователей

function createNotificationNonAuth(notificationName, notificationText, actionName, className) {
    if (notificationAuthData.dataset.auth != 'true') {
        createNotification(notificationName, notificationText, actionName, className);
    }
}

// Функция создания уведомления для авторизованных пользователей

function createNotificationAuth(notificationName, notificationText, actionName, className) {
    if (notificationAuthData.dataset.auth == 'true') {
        createNotification(notificationName, notificationText, actionName, className);
    }
}




