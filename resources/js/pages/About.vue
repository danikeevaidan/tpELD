<script setup>

</script>

<template>
    <div class="container my-5">
        <h1 class="display-5 text-primary mb-4">Техническое задание на разработку платформы для учета рабочего времени водителей грузовиков по правилам FMCSA</h1>

        <section>
            <h2 class="text-secondary">Цель проекта</h2>
            <p>Создать платформу для автоматизированного учета рабочего времени водителей грузовиков в соответствии с требованиями FMCSA, аналогичную системе Swift ELD. Платформа должна обеспечивать сбор данных с электронных устройств контроля (ELD), хранение информации о рабочем времени водителей, интеграцию с GPS и генерацию отчетов, соответствующих требованиям FMCSA.</p>
        </section>

        <section>
            <h2 class="text-secondary">Технологический стек</h2>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Язык разработки:</strong> PHP</li>
                <li class="list-group-item"><strong>Фреймворк:</strong> Laravel (версия 11)</li>
                <li class="list-group-item"><strong>База данных:</strong> MySQL или PostgreSQL</li>
                <li class="list-group-item"><strong>Frontend:</strong> Vue.js (при необходимости для админ-панели и интерфейса)</li>
                <li class="list-group-item"><strong>ELD устройства:</strong> Интеграция с API устройств через REST или другие протоколы</li>
                <li class="list-group-item"><strong>API:</strong> REST API для мобильных приложений и веб-клиентов</li>
                <li class="list-group-item"><strong>Хостинг:</strong> AWS, DigitalOcean или аналогичные облачные решения</li>
            </ul>
        </section>

        <section>
            <h2 class="text-secondary mt-4">Основные функциональные модули</h2>

            <div class="accordion" id="functionalModules">
                <!-- Модуль для водителей -->
                <div class="accordion-item">
                    <h3 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            1. Модуль для водителей
                        </button>
                    </h3>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#functionalModules">
                        <div class="accordion-body">
                            <ul>
                                <li><strong>Регистрация и авторизация:</strong> Возможность зарегистрироваться через мобильное приложение или веб-интерфейс, поддержка OAuth 2.0.</li>
                                <li><strong>Учет рабочего времени:</strong> Автоматическая регистрация времени через интеграцию с ELD, возможность корректировки статусов работы.</li>
                                <li><strong>GPS отслеживание:</strong> Интеграция для отслеживания местоположения водителей в реальном времени.</li>
                                <li><strong>Просмотр отчетов (HOS):</strong> Просмотр отчетов за день, неделю и месяц с экспортом в PDF.</li>
                                <li><strong>Уведомления:</strong> Уведомления при приближении к превышению допустимого времени.</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Модуль для диспетчеров и администраторов -->
                <div class="accordion-item">
                    <h3 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            2. Модуль для диспетчеров и администраторов
                        </button>
                    </h3>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#functionalModules">
                        <div class="accordion-body">
                            <ul>
                                <li><strong>Мониторинг в реальном времени:</strong> Отображение текущего местоположения и статуса всех водителей.</li>
                                <li><strong>Отчеты и статистика:</strong> Генерация отчетов по времени работы водителей.</li>
                                <li><strong>Управление пользователями:</strong> Создание и редактирование профилей водителей и учетных записей.</li>
                                <li><strong>Интеграция с бухгалтерией:</strong> Экспорт данных для расчета заработной платы.</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Административная панель -->
                <div class="accordion-item">
                    <h3 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            3. Административная панель
                        </button>
                    </h3>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#functionalModules">
                        <div class="accordion-body">
                            <ul>
                                <li><strong>Управление устройствами ELD:</strong> Добавление и управление устройствами.</li>
                                <li><strong>Настройки системы:</strong> Настройка правил уведомлений и норм времени для водителей.</li>
                                <li><strong>Журнал событий:</strong> Логирование всех действий для внутреннего аудита.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <h2 class="text-secondary mt-4">Технические требования</h2>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Backend:</strong> Laravel 9+, Eloquent ORM, REST API</li>
                <li class="list-group-item"><strong>Frontend:</strong> Vue.js или React, адаптивная верстка</li>
                <li class="list-group-item"><strong>Уведомления и очередь задач:</strong> Laravel Queue, SendGrid, Firebase</li>
                <li class="list-group-item"><strong>Безопасность:</strong> OAuth 2.0 или JWT, SSL, шифрование данных</li>
                <li class="list-group-item"><strong>Масштабируемость:</strong> Горизонтальное масштабирование backend</li>
                <li class="list-group-item"><strong>Тестирование:</strong> Unit и интеграционные тесты</li>
            </ul>
        </section>

        <section>
            <h2 class="text-secondary mt-4">Этапы разработки</h2>
            <ol class="list-group list-group-numbered">
                <li class="list-group-item"><strong>Этап 1:</strong> Анализ и проектирование (2 недели)</li>
                <li class="list-group-item"><strong>Этап 2:</strong> Разработка API и Backend (6 недель)</li>
                <li class="list-group-item"><strong>Этап 3:</strong> Разработка административной панели (4 недели)</li>
                <li class="list-group-item"><strong>Этап 4:</strong> Интеграция с ELD и GPS (4 недели)</li>
                <li class="list-group-item"><strong>Этап 5:</strong> Тестирование и отладка (3 недели)</li>
                <li class="list-group-item"><strong>Этап 6:</strong> Внедрение и запуск (2 недели)</li>
            </ol>
        </section>
    </div>
</template>

<style scoped>

</style>
