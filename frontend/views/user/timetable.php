<?php

use yii\web\YiiAsset;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Составить расписание';
$this->params['breadcrumbs'][] = ['label' => 'Профиль', 'url' => ['/user/account?id='.Yii::$app->user->identity->id]];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src='https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js'></script>
<link href='https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.3.2/main.min.css' rel='stylesheet' />
<script src='https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.3.2/main.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.3.2/locales-all.min.js'></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        function mobileCheck() { //изменение ширины, если мобильная версия
            /*if (window.innerWidth >= 768) {
            return false;
        } else {
            return true;
        }*/
            return window.innerWidth < 768;
        }

        let clickCnt = 0; //количество кликов

        var colors = ['#506fa9','#c10000','#234d20',
                     '#8008ff','#ff69b4','#ff9900'];

        var color = colors[Math.floor(Math.random() * colors.length)]; //рандомный цвет

        var calendar = new FullCalendar.Calendar(calendarEl, {
            schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives', //скрыть предупреждение о лицензии
            locale: 'ru', //язык
            timeZone: 'local',
            //selectable: true, //выбор даты
            selectable: !mobileCheck(), //mobileCheck() ? false : true
            //selectMirror: true,
            initialView: mobileCheck() ? "newView" : "timeGridWeek", //вид по умолчанию
            headerToolbar: mobileCheck() ? {left: 'title', center: 'addEventButton', right: 'prev,next,changeViewButton'} :
                {left: 'prev,next addEventButton', center: 'title', right: 'today timeGridWeek,dayGridMonth'},
            //editable: true, //возможность изменять события (перемещать, растягивать и т.д.)
            defaultTimedEventDuration: '01:00', //продолжительность события
            forceEventDuration: true,
            allDaySlot: false, // поле "весь день"
            slotMinTime: '06:00:00', //начало дня
            slotMaxTime: '20:30:00', //конец дня
            slotDuration: '00:30:00',
            slotLabelInterval: 30,
            snapDuration: '01:00:00',
            selectLongPressDelay: 25,
            eventColor: color,
            events: '/user/events',

            eventDidMount: function (info) {

                info.el.addEventListener('click', function() {
                    clickCnt++;
                    if (clickCnt === 1) {
                        oneClickTimer = setTimeout(function() {
                            clickCnt = 0;
                            //Swal.fire('' + info.event.start );
                        }, 400);
                    } else if (clickCnt === 2) {
                        clearTimeout(oneClickTimer);
                        clickCnt = 0;
                        //info.event.remove();
                        var id = info.event.id; //Удаление событий

                        $.ajax({
                            url:'/user/remove',
                            method:'POST',
                            data:{id:id},
                            success: function (){
                                calendar.refetchEvents();
                            }
                        })
                    }
                });
            },

            /*eventResize:function (event){

                var id = event.id;
                var start = FullCalendar.formatDate(start, 'Y-MM-DD HH:mm:ss');
                var end = FullCalendar.formatDate(end, 'Y-MM-DD HH:mm:ss');

                $.ajax({
                    url:'/user/renew',
                    method:'POST',
                    data:{
                        id:id,
                        start:start,
                        end:end
                    },
                    success: function (){
                        calendar.refetchEvents();
                        alert('update');
                    }
                })
            },

            eventDrop:function (event){

                var id = event.id;
                var start = FullCalendar.formatDate(start, 'Y-MM-DD HH:mm:ss');
                var end = FullCalendar.formatDate(end, 'Y-MM-DD HH:mm:ss');

                $.ajax({
                    url:'/user/renew',
                    method:'POST',
                    data:{
                        id:id,
                        start:start,
                        end:end
                    },
                    success: function (){
                        calendar.refetchEvents();
                        alert('update');
                    }
                })
            },*/

            views: {
                dayGridMonth: {
                    titleFormat: {year: 'numeric', month: 'long'},
                    selectable: false,
                    displayEventEnd: true,
                },
                listWeek: {
                    titleFormat: {month: 'short'},
                },
                newView: {
                    type: 'dayGridMonth',
                    titleFormat: {month: 'short'},
                    displayEventEnd: false,
                    //eventTimeFormat: {hour: 'numeric', minute: '2-digit',}
                },
            },

            /*select: function(info) {
                var moment = info.startStr;
                var date = new Date(moment);

                if (!isNaN(date.valueOf())) { // valid?
                    calendar.addEvent({
                        //title: 'Практика',
                        start: date,
                        //allDay: true
                    });
                }
            },*/

            customButtons: {
                changeViewButton: {
                    text: 'Вид',
                    click: function () {
                        const view = calendar.view;
                        //console.log(view.type);
                        if (view.type === 'newView')
                        {
                            calendar.changeView('listWeek');
                        }
                        else
                        {
                            calendar.changeView('newView');
                        }
                    }
                },
                addEventButton: {
                    text: 'Добавить',
                    click: function() {
                        /*var dateStr = prompt('Введите дату в формате ГГГГ-ММ-ДД:');
                        var time = prompt('Введите время в формате ЧЧ:ММ:');
                        var date = new Date(dateStr + ' ' + time);*/
                        (async () => {
                            const { value: formValues } = await Swal.fire({
                                title: 'Введите дату и время:',
                                html:
                                    /*'<label for="date-input" style="margin-bottom: 0; margin-right: 230px">Дата</label>' +
                                    '<input type="date" id="date-input" class="swal2-input" placeholder="Дата">' +
                                    '<label for="start-time" style="margin-bottom: 0; margin-right: 220px">Начало</label>' +
                                    '<input type="time" id="start-time" class="swal2-input" placeholder="Начало">' +
                                    '<label for="end-time" style="margin-bottom: 0; margin-right: 220px">Конец</label>' +
                                    '<input type="time" id="end-time" class="swal2-input" placeholder="Конец">',*/
                                    '<label for="start-time" style="margin-bottom: 0; margin-right: 220px">Начало</label>' +
                                    '<input type="datetime-local" id="start-time" class="swal2-input" placeholder="Начало">' +
                                    '<label for="end-time" style="margin-bottom: 0; margin-right: 220px">Конец</label>' +
                                    '<input type="datetime-local" id="end-time" class="swal2-input" placeholder="Конец">',
                                focusConfirm: false,
                                preConfirm: () => {
                                    return [
                                        /*document.getElementById('date-input').value,*/
                                        document.getElementById('start-time').value,
                                        document.getElementById('end-time').value,
                                    ]
                                }
                            })

                            //var start = new Date (document.getElementById('date-input').value + ' ' + document.getElementById('start-time').value);
                            //var end = new Date (document.getElementById('date-input').value + ' ' + document.getElementById('end-time').value);
                            var start = document.getElementById('start-time').value;
                            var end =  document.getElementById('end-time').value;

                            //if ( !isNaN(start.valueOf())) {
                            if (start.valueOf() && end.valueOf()) {
                                calendar.addEvent({
                                    //title: 'Практика',
                                    start: start,
                                    end: end,
                                });
                                Swal.fire('Занятие добавлено! ' + moment(document.getElementById('start-time').value).format('MM.DD.YYYY HH:mm') + '-' + moment(document.getElementById('end-time').value).format('MM.DD.YYYY HH:mm').substr(11));
                                //location.reload();
                            } else {
                                Swal.fire('Неправильно введены дата или время!');
                            }

                            if (start) {
                                $.ajax({
                                    url:'/user/insert',
                                    type:'POST',
                                    data:{
                                        start:start,
                                        end:end
                                    },
                                    success: function () {
                                    calendar.refetchEvents();
                                    }
                                })
                            }
                        })()
                    }
                }
            },
        });
        calendar.render();
    });

</script>
<div class="user-timetable">

    <div id='calendar'></div>

</div>





