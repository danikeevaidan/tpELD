<script >
  import axios from "axios";
  import store from "../store/index.js";

  export default {
    data: function () {
      return {
        drivers: []
      }
    },
    mounted() {
        console.log("USER/DRIVER", store.getters['user/driver']);
    },
    methods: {

    }
  }

</script>

<template>

    <!-- Основной баннер -->
    <header class="bg-light py-5 text-center">
        <div class="container">
            <h1 class="display-5 fw-bold">Платформа для учета рабочего времени водителей</h1>
            <p class="lead text-muted">Автоматизация рабочего времени водителей грузовиков по стандартам FMCSA</p>
            <a href="#about" class="btn btn-primary btn-lg">Узнать больше</a>
        </div>
    </header>

    <!-- О проекте -->
    <section id="about" class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h2 class="text-primary">О проекте</h2>
                    <p>Наша платформа создана для автоматизированного учета рабочего времени водителей грузовиков, соответствующего требованиям FMCSA. Мы предоставляем комплексное решение для мониторинга времени вождения, отдыха и ожидания, интеграции с ELD и GPS, а также для генерации отчетов по стандартам безопасности.</p>
                </div>
                <div class="col-lg-6">
                    <img src="https://plus.unsplash.com/premium_photo-1664695368767-c42483a0bda1?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8dHJ1Y2t8ZW58MHx8MHx8fDA%3D" alt="Проект" class="img-fluid rounded">
                </div>
            </div>
        </div>
    </section>

    <!-- Функциональные возможности -->
    <section id="features" class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center text-primary mb-4">Функциональные возможности</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Учет рабочего времени</h5>
                            <p class="card-text">Автоматическая регистрация времени водителей, интеграция с ELD для точного учета времени.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">GPS отслеживание</h5>
                            <p class="card-text">Реальное время и история местоположения водителей для полного мониторинга.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Генерация отчетов</h5>
                            <p class="card-text">Подробные отчеты по рабочему времени и нарушению правил для регуляторов и диспетчеров.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Преимущества -->
    <section id="advantages" class="py-5">
        <div class="container">
            <h2 class="text-center text-primary mb-4">Преимущества платформы</h2>
            <div class="row g-4">
                <div class="col-md-4 text-center">
                    <div class="p-3 border rounded">
                        <h5 class="fw-bold">Соответствие требованиям FMCSA</h5>
                        <p>Гарантия выполнения всех требований безопасности и норм вождения.</p>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <div class="p-3 border rounded">
                        <h5 class="fw-bold">Интеграция с GPS и ELD</h5>
                        <p>Подключение к устройствам ELD и GPS для точных данных о местоположении и времени работы.</p>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <div class="p-3 border rounded">
                        <h5 class="fw-bold">Гибкость и масштабируемость</h5>
                        <p>Масштабируемое решение для работы с множеством водителей и транспортных средств.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Контакты -->
    <section id="contact" class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center text-primary mb-4">Связаться с нами</h2>
            <div class="row">
                <div class="col-md-6">
                    <p class="lead">Если у вас есть вопросы, свяжитесь с нами через форму ниже или по телефону.</p>
                    <ul class="list-unstyled">
                        <li><strong>Телефон:</strong> +7 (123) 456-7890</li>
                        <li><strong>Email:</strong> info@truckingplatform.com</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <form>
                        <div class="mb-3">
                            <label for="name" class="form-label">Ваше имя</label>
                            <input type="text" class="form-control" id="name" placeholder="Введите ваше имя">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Введите ваш email">
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Сообщение</label>
                            <textarea class="form-control" id="message" rows="4" placeholder="Ваше сообщение"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Отправить</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Подвал -->
    <footer class="text-center py-3">
        <p class="mb-0">© 2024 Учет рабочего времени водителей. Все права защищены.</p>
    </footer>
</template>

<style scoped>

</style>
