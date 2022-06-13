<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="/public/css/style.css">
    <title>{{meta.title}}</title>
</head>
<body>
<div class="wrap">
    <header class="header">
        <div class="header__body _container">
            <img class="header__logo" src="/public/img/logo.png" alt="">
            <div class="header__icons">
                <form method="post" class="header__icon header__profile icon_reg_auth">
                    <span class="icon-user"></span>
                    <span class="header__subtitle">
                    {{user_fio}}
                </span>
                    <input type="text" readonly value="Выйти" hidden name="exit">
                </form>
                <form method="post" class="header__icon header__exit icon_reg_auth">
                    <span class="icon-exit"></span>
                    <span class="header__subtitle">
                    Выйти
                </span>
                    <input type="text" readonly value="Выйти" hidden name="exit">
                </form>
            </div>
        </div>
    </header>
    <main class="content">
        <div class="content__body _container">
            <div class="navigation-chain">
                <div class="navigation-chain__item"><a href="http://trans/permission">Разрешения / </a></div>
                <div class="navigation-chain__item navigation-chain__item_active">Просмотр разрешения</div>
            </div>
            <div class="content__add-permission permission-add">
                <form method="post" class="permission-add__top">
                    <div class="permission-add__number">
                        <span> Разрешение № {{permission.id}}
                            {% if permission.status_id > 1 %}
                                 </span><span class="permission__gap">|</span>Номер в СЭД
                        {% endif %}
                    </div>
                    <input type="text" class="permission__number permission__number_first input" readonly name="first_number" placeholder="Номер" value="{{permission.first_number}}">
                    <span class="permission__slash">/</span>
                    <input type="text" class="permission__number permission__number_second input" readonly name="second_number" placeholder="Номер" value="{{permission.second_number}}">
                </form>
                <div class="permission-add__list">
                    <div class="permission-add__item permission-add__item_top">
                        <div class="permission-add__block permission-add__block_top">
                            <div class="permission-add__title">
                                Выдал начальнику {{supervisorOfResponsibleForExecute.lastname}} {{supervisorOfResponsibleForExecute.name}} {{supervisorOfResponsibleForExecute.patronymic}}
                            </div>
                            <form method="post" action="http://trans/employee" class="permission-add__supervisor">
                                <input type="text" readonly name="id_type_person" value="5" hidden>
                            </form>
                        </div>
                        <div class="permission-add__block permission-add__block_top">
                            <div class="permission-add__title">
                                Основание для создания разрешения(приказ, распоряжение,служебная записка и т.д.):
                            </div>
                            <textarea readonly class="permission-add__textarea permission-add__textarea_top textarea" name="description" id="description" cols="30" rows="10" placeholder="Введите основание    ...">{{permission.description}}</textarea>
                        </div>
                    </div>
                    <div class="permission-add__item">
                        <div class="permission-add__title">
                            1. Периоды проведения работ:
                        </div>
                        <div class="permission-add__block">
                            {% if current_dates|length > 0 %}
                            <div class="permission-add__dates">
                                <div class="permission-add__date">
                                    <div class="permission-add__col">
                                        Дата
                                    </div>
                                    <div class="permission-add__col">
                                        Время начала
                                    </div>
                                    <div class="permission-add__col">
                                        Время окончания
                                    </div>
                                </div>
                                {% for current_date in current_dates %}
                                <div class="permission-add__date">
                                    <div class="permission-add__col">
                                        {{current_date.date}}
                                        <input type="text" hidden value="{{current_date.date}}">
                                    </div>
                                    <div class="permission-add__col">
                                        {{current_date.from_time}}
                                        <input type="text" hidden value="{{current_date.from_time}}">
                                    </div>
                                    <div class="permission-add__col">
                                        {{current_date.to_time}}
                                        <input type="text" hidden value="{{current_date.to_time}}">
                                    </div>
                                </div>
                                {% endfor %}
                            </div>
                            {% endif %}
                            {% if permission.period_start > '' %}
                            <div class="permission-add__dates">
                                <div class="permission-add__date">
                                    <div class="permission-add__col">
                                        Период начала
                                    </div>
                                    <div class="permission-add__col">
                                        Период окончания
                                    </div>
                                </div>
                                <div class="permission-add__date">
                                    <div class="permission-add__col">
                                        {{permission.period_start}}
                                        <input type="text" hidden value="{{permission.period_start}}">
                                    </div>
                                    <div class="permission-add__col">
                                        {{permission.period_end}}
                                        <input type="text" hidden value="{{permission.period_end}}">
                                    </div>
                                </div>
                            </div>
                            {% endif %}
                        </div>
                    </div>
                    <div class="permission-add__item">
                        <div class="permission-add__title">
                            2. Наименование работ, основание для выполнения работ:
                        </div>
                        <div class="permission-add__types">
                            <div class="permission-add__subtitle permission-add__subtitile_typical">
                            </div>
                            {% for current_typical_work in current_typical_works %}
                            <form method="post" class="permission-add__type">
                                <div class="permission-add__typical">
                                    <div class="permission-add__type-name">
                                        - {{current_typical_work.name}}
                                    </div>
                                    <input type="text" name="typical_work_id" class="current_typical_work_id" hidden value="{{current_typical_work.typical_work_id}}" >
                                    {% if roles.isAuthor and permission.status_id < 3 %}
                                    <span class="icon-clear permission-add__clear current_typical_work_del"></span>
                                    {% endif %}
                                </div>
                                {% if current_typical_work.description != '' %}
                                <div class="permission-add__block">
                                    <textarea readonly class="permission-add__textarea textarea" name="untypical_works" id="untypical_works" cols="30" rows="10" placeholder="Введите нетиповые работы...">{{current_typical_work.description}}</textarea>
                                </div>
                                {% endif %}
                            </form>
                            {% endfor %}
                        </div>
                        <div class="permission-add__subtitle permission-add__subtitile_untypical">
                        </div>
                        {% if permission.untypical_work != '' %}
                        <div class="permission-add__block">
                            <textarea readonly class="permission-add__textarea textarea" name="untypical_works" id="untypical_works" cols="30" rows="10" placeholder="Введите нетиповые работы...">{{permission.untypical_work}}</textarea>
                        </div>
                        {% endif %}
                    </div>

                    <!-- Маскирование  -->
                    <div class="permission-add__item">

                        <div class="permission-add__subtitle">
                            3. Маскирование защиты:
                        </div>
                        <div class="table-content-mask__rows table-content-mask__row_head">
                            <div class="table-content-mask__col table-content-mask__head" name="system">Система</div>
                            <div class="table-content-mask__col table-content-mask__head" name="protection">Защита</div>
                            <div class="table-content-mask__col table-content-mask__head" name="entrance">Вход</div>
                            <div class="table-content-mask__col table-content-mask__head" name="exit">Выход</div>
                            <div class="table-content-mask__col table-content-mask__head entrance-on" name="type_location">Тип объекта</div>
                            <div class="table-content-mask__col table-content-mask__head entrance-on" name="location">Объект</div>
                            <div class="table-content-mask__col table-content-mask__head entrance-on" name="vtor">Втор</div>
                            <div class="table-content-mask__col table-content-mask__head entrance-on" name="delete-mask">Удалить</div>
                        </div>
                        {% set i = 0 %}
                        {% for protection in protections %}
                        {% set i = i + 1 %}
                        <form action="" method="post" class="form__del-masks">
                            <div class="table-content-mask__rows table-row">
                                <div class="table-content-mask__col table-col col-first">
                                    <input type="text" name="ty-1" class="table-mask-col__input protection input-ty input-row" value="{{protection.system_apcs_name}}" required="required" readonly>
                                </div>
                                <div class="table-content-mask__col table-col">
                                    <input type="text" class="protection_id-{{i}} input-row" name="protection_id-{{i}}" value="{{protection.protection_id}}" hidden>
                                    <input type="text" name="protection-{{i}}" class="table-mask-col__input protection input-row" value="{{protection.protection_name}}" required="required" readonly>
                                </div>
                                {% if protection.entrance_name == 'Вход' %}
                                <div class="table-content-mask__col table-col">
                                    <label class="check-entrance">
                                        <input type="radio" class="check-entrance__input entrance-{{i}} input-row" name="entrance_exit-{{i}}" value="entrance-{{i}}" checked hidden>
                                        <span class="check-entrance__span"></span>
                                    </label>
                                </div>
                                <div class="table-content-mask__col table-col">
                                    <label class="check-entrance">
                                        <input type="radio" class="check-entrance__input exit-{{i}} input-row" name="entrance_exit-{{i}}" value="exit-{{i}}" hidden>
                                        <span class="check-entrance__span"></span>
                                    </label>
                                </div>
                                <div class="table-content-mask__col table-col entrance-on" >
                                    <input type="text" name="type_location-{{i}}" class="table-col__input type_location input-row" value="{{protection.type_object_name}}">
                                </div>
                                <div class="table-content-mask__col table-col col-first entrance-on" >
                                    <input type="text" name="location-{{i}}" class="table-col__input location input-row" value="{{protection.object_name}}">
                                </div>
                                {% elseif protection.entrance_name == 'Выход' %}
                                <div class="table-content-mask__col table-col">
                                    <label class="check-entrance">
                                        <input type="radio" class="check-entrance__input entrance-{{i}} input-row" name="entrance_exit-{{i}}" value="entrance-{{i}}" hidden>
                                        <span class="check-entrance__span"></span>
                                    </label>
                                </div>
                                <div class="table-content-mask__col table-col">
                                    <label class="check-entrance">
                                        <input type="radio" class="check-entrance__input exit-{{i}} input-row" name="entrance_exit-{{i}}" value="exit-{{i}}" checked hidden>
                                        <span class="check-entrance__span"></span>
                                    </label>
                                </div>
                                <div class="table-content-mask__col table-col entrance-on" >
                                    <input type="text" name="type_location-{{i}}" readonly class="table-col__input type_location input-row" value="{{protection.type_object_name}}">
                                </div>
                                <div class="table-content-mask__col table-col col-first entrance-on" >
                                    <input type="text" name="location-{{i}}" readonly class="table-col__input location input-row" value="{{protection.object_name}}">
                                </div>
                                {% endif %}
                                {% if protection.vtor_name == 'Втор' %}
                                <div class="table-content-mask__col table-col entrance-on">
                                    <label class="check-entrance">
                                        <input type="checkbox" class="check-entrance__input vtor" name="vtor-{{i}}" checked hidden>
                                        <span class="check-entrance__span"></span>
                                    </label>
                                </div>
                                {% elseif protection.vtor_name == 'Невтор' %}
                                <div class="table-content-mask__col table-col entrance-on">
                                    <label class="check-entrance">
                                        <input type="checkbox" class="check-entrance__input vtor" name="vtor-{{i}}" hidden>
                                        <span class="check-entrance__span"></span>
                                    </label>
                                </div>
                                {% endif %}
                                <div class="table-content-mask__col table-col">
                                    <label class="check-entrance">
                                        <input type="submit" name="del-masks" value="Удалить" hidden>
                                        <span class="icon-clear permission-add__clear"></span>
                                    </label>
                                </div>
                            </div>
                        </form>
                        {% endfor %}
                    </div>
                    <div class="permission-add__item">
                        <div class="permission-add__title">
                            4. Прочие условия проведения работ:
                        </div>
                        <div class="permission-add__condition condition-permission">
                            <div class="condition-permission__list">
                                <div class="condition-permission__item">
                                    <div class="condition-permission__block">
                                        <div class="condition-permission__subtitle">
                                            4.1 Аварийная готовность:
                                        </div>
                                        <input type="text" readonly id="minute" placeholder="Введите кол. минут" class="input condition-permission__minute" value="{{permission.emergency_minute}}">
                                        <div class="condition-permission__subtitle">
                                            минут
                                        </div>
                                    </div>
                                </div>
                                <div class="condition-permission__item">
                                    <div class="condition-permission__block">
                                        <div class="condition-permission__subtitle">
                                            4.2 Отметка об отсутствии(наличии) аварийного включения резерва(АВР) при выполнении работ:
                                        </div>
                                        <form method="post" class="condition-permission__checkboxes">
                                            <label for="yes-emergency-activation">ДА</label>
                                            {% if permission.is_emergency_activation %}
                                            <input type="radio" disabled id="yes-emergency-activation" name="emergency-activation" checked>
                                            {% else %}
                                            <input type="radio" disabled id="yes-emergency-activation" name="emergency-activation">
                                            {% endif %}
                                            <label for="no-emergency-activation">НЕТ</label>
                                            {% if permission.is_emergency_activation %}
                                            <input type="radio" disabled id="no-emergency-activation" name="emergency-activation">
                                            {% else %}
                                            <input type="radio" disabled id="no-emergency-activation" name="emergency-activation" checked>
                                            {% endif %}
                                        </form>
                                    </div>
                                </div>
                                <div class="condition-permission__item">
                                    <div class="condition-permission__subtitle">
                                        4.3 Ответственные за подготовку работ:
                                    </div>
                                    <div class="permission-add__responsibles">
                                        {% for responsible in responsiblesForPreparation %}
                                        <div class="permission-add__responsible">
                                            <div class="permission-add__name">
                                                {{responsible.lastname}} {{responsible.name}} {{responsible.patronymic}}
                                            </div>
                                            <input type="text" hidden class="responsible__id" value="{{responsible.user_id}}">
                                        </div>
                                        {% endfor %}
                                    </div>
                                </div>
                                <div class="condition-permission__item">
                                    <div class="condition-permission__subtitle">
                                        4.4 Ответственные за проведение работ:
                                    </div>
                                    <div class="permission-add__responsibles">
                                        {% for responsible in responsiblesForExecute %}
                                        <div class="permission-add__responsible">
                                            <div class="permission-add__name">
                                                {{responsible.lastname}} {{responsible.name}} {{responsible.patronymic}}
                                            </div>
                                            <input type="text" hidden class="responsible__id" value="{{responsible.user_id}}">
                                        </div>
                                        {% endfor %}
                                    </div>
                                </div>
                                <div class="condition-permission__item">
                                    <div class="condition-permission__subtitle">
                                        4.5 Ответственные за контроль при производстве работ:
                                    </div>
                                    <div class="permission-add__responsibles">
                                        {% for responsible in responsiblesForControl %}
                                        <div class="permission-add__responsible">
                                            <div class="permission-add__name">
                                                {{responsible.lastname}} {{responsible.name}} {{responsible.patronymic}}
                                            </div>
                                            <input type="text" hidden class="responsible__id" value="{{responsible.user_id}}">
                                        </div>
                                        {% endfor %}
                                    </div>
                                </div>
                                <div class="condition-permission__item">
                                    <div class="condition-permission__subtitle">
                                        4.6 Ответственные за проведение маскирования:
                                    </div>
                                    <div class="permission-add__responsibles">
                                        {% for responsible in responsiblesForMask %}
                                        <div class="permission-add__responsible">
                                            <div class="permission-add__name">
                                                {{responsible.lastname}} {{responsible.name}} {{responsible.patronymic}}
                                            </div>
                                            <input type="text" hidden class="responsible__id" value="{{responsible.user_id}}">
                                        </div>
                                        {% endfor %}
                                    </div>
                                </div>
                                <div class="condition-permission__item">
                                    <div class="condition-permission__subtitle">
                                        4.7 Ответственные за контроль маскирования:
                                    </div>
                                    <div class="permission-add__responsibles">
                                        {% for responsible in responsiblesForControlMask %}
                                        <div class="permission-add__responsible">
                                            <div class="permission-add__name">
                                                {{responsible.lastname}} {{responsible.name}} {{responsible.patronymic}}
                                            </div>
                                            <input type="text" hidden class="responsible__id" value="{{responsible.user_id}}">
                                        </div>
                                        {% endfor %}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="permission-add__item">
                        <div class="permission-add__title">
                            5. При производстве работ обеспечить:
                        </div>
                        <textarea readonly class="permission-add__textarea textarea" name="addition" id="addition" cols="30" rows="10" placeholder="Введите информацию...">{{permission.addition}}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer class="footer">
        <div class="footer__body _container">
            <address class="footer__mail">vitalinosov2000@gmail.com</address>
            <div class="footer__copy">&copy; АО "Транснефть - Север" 2022</div>
            <div class="footer__links">
                <a href="https://vk.com/transneftofficial" target="_blank" class="icon-vk footer__link"></a>
                <a href="https://www.facebook.com/TRANSNEFT" target="_blank" class="icon-facebook footer__link"></a>
                <a href="https://twitter.com/transneftRu" target="_blank" class="icon-twitter footer__link"></a>
                <a href="https://www.instagram.com/transneftru/" target="_blank" class="icon-instagram-second footer__link"></a>
                <a href="https://t.me/transneftofficial" target="_blank" class="icon-telegram footer__link"></a>
                <a href="https://invite.viber.com/?g2=AQAJmjbSlaVw3kiGiek7m4%2BbhLm0X01ggdP5DAoiuQUSUvejqFEpi8Rp5Wy6uqI7&lang=ru" target="_blank" class="icon-viber footer__link"></a>
                <a href="https://www.youtube.com/user/transneftru" target="_blank" class="icon-youtube footer__link"></a>
            </div>
        </div>
    </footer>
    <script src="/public/js/functions.js"></script>
</div>
</body>
</html>