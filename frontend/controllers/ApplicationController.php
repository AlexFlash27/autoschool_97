<?php

namespace frontend\controllers;

use Yii;
use common\models\ApplicationForm;
use frontend\models\ApplicationFormSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use PhpOffice\PhpWord\TemplateProcessor;

/**
 * ApplicationController implements the CRUD actions for ApplicationForm model.
 */
class ApplicationController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            //Доступ только для админа
            [
                'class' => AccessControl::className(),
                'only' => ['index', 'view', 'update', 'create'],
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'update', 'create'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],

            ],

            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all ApplicationForm models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = 'app_crud';
        $searchModel = new ApplicationFormSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAge()
    {
        $model = new ApplicationForm();

        return $this->render('age', [
            'model' => $model,
        ]);
    }

    public function actionBlank()
    {
        $model = new ApplicationForm();
        //если пришли post-данные, загружаем их в модель//
        if ($model->load(Yii::$app->request->post())) {
            //проверяем и сохраняем эти данные//
            if ($model->save()) {
                /* * Данные прошли валидацию * */

                //генерируем имя пользователя//
                $random_username = $model->last_name. '_' .mt_rand(100, 999);
                $connection = Yii::$app->db;
                $connection->createCommand("UPDATE application SET username = ('$random_username') ORDER BY id DESC LIMIT 1")->execute();

                //отправляем письмо на почту//
                $textBody = 'Имя пользователя: ' . strip_tags($random_username) . PHP_EOL;
                $textBody .= 'Пароль: ' . strip_tags($model->password) . PHP_EOL . PHP_EOL;

                $htmlBody = '<p><b>Имя пользователя</b>: ' . strip_tags($random_username) . '</p>';
                $htmlBody .= '<p><b>Пароль</b>: ' . strip_tags($model->password) . '</p>';

                Yii::$app->mailer->compose()
                    ->setFrom(Yii::$app->params['senderEmail'])
                    ->setTo($model->email)
                    ->setSubject('Регистрация на сайте "Автошкола Гармония"')
                    ->setTextBody('Благодарим за заполнения формы на запись в автошколу. Ваши данные для входа на сайт автошколы:' .$textBody)
                    ->setHtmlBody('Благодарим за заполнения формы на запись в автошколу. Ваши данные для входа на сайт автошколы: <br>' .$htmlBody)
                    ->send();

                Yii::$app->mailer->compose()
                    ->setFrom(Yii::$app->params['senderEmail'])
                    ->setTo('alexflash27@yandex.ru')
                    ->setSubject('Заполнение заявления на сайте "Автошкола Гармония"')
                    ->setTextBody('Новый пользователь заполнил заявление на сайте: http://autoschool-test/application?sort=-updated_at')
                    ->setHtmlBody('Новый пользователь заполнил заявление на сайте: http://autoschool-test/application?sort=-updated_at')
                    ->send();

                //заполняем по шаблону и сохраняем договор//
                if ($model->category == 'Категория «B» автомобили')
                {
                    $document = new TemplateProcessor('C:\Users\user\Desktop\OpenServer\domains\autoschool-test\frontend\web\documents_templates\Договор кат.В взрослый.docx');
                } else {
                    $document = new TemplateProcessor('C:\Users\user\Desktop\OpenServer\domains\autoschool-test\frontend\web\documents_templates\Договор кат.А.docx');
                }

                $document->setValue('first_name', $model->first_name);
                $document->setValue('last_name', $model->last_name);
                $document->setValue('patronymic', $model->patronymic);
                $document->setValue('series_number', $model->series_number);
                $document->setValue('issued_by', $model->issued_by);
                $document->setValue('date_of_issue', $model->date_of_issue);
                $document->setValue('place_registration', $model->place_registration);
                $document->setValue('place_residence', $model->place_residence);
                $document->setValue('phone_number', $model->phone_number);

                $category_name = mb_substr($model->category, 0, 14, 'UTF-8');

                $document->saveAs('C:\Users\user\Desktop\OpenServer\domains\autoschool-test\frontend\web\documents\ '.$category_name.$model->last_name.' '.$model->first_name.'.docx');

                /*$document->setValue(
                    [
                        'first_name' => $model->first_name,
                        'last_name' => $model->last_name,
                        'patronymic' => $model->patronymic,
                        'series_number' => $model->series_number,
                        'issued_by' => $model->issued_by,
                        'date_of_issue' => $model->date_of_issue,
                        'place_registration' => $model->place_registration,
                        'place_residence' => $model->place_residence,
                        'phone_number' => $model->phone_number,
                    ]
                );*/
                //данные прошли валидацию, отмечаем этот факт//
                Yii::$app->session->setFlash('success', 'Спасибо за заполнения формы. Ожидайте звонка.');
                //перезагружаем страницу, чтобы избежать повтороной отправки формы//
                return $this->refresh();
            } else {
                //данные не прошли валидацию, отмечаем этот факт//
                Yii::$app->session->setFlash('error', 'Данные не прошли проверку.');
                //не перезагружаем страницу, чтобы сохранить пользовательские данные//
            }
        }

        return $this->render('blank', ['model' => $model]);
    }

    public function actionBlankchild() //Нет 18 лет
    {
        $model = new ApplicationForm();
        //если пришли post-данные, загружаем их в модель//
        if ($model->load(Yii::$app->request->post())) {
            //проверяем и сохраняем эти данные//
            if ($model->save()) {
                /* * Данные прошли валидацию * */

                //генерируем имя пользователя//
                $random_username = $model->last_name.'_'.mt_rand(100, 999);
                $connection = Yii::$app->db;
                $connection->createCommand("UPDATE application SET username = ('$random_username') ORDER BY id DESC LIMIT 1")->execute();

                //отправляем письмо на почту//
                $textBody = 'Имя пользователя: ' . strip_tags($random_username) . PHP_EOL;
                $textBody .= 'Пароль: ' . strip_tags($model->password) . PHP_EOL . PHP_EOL;

                $htmlBody = '<p><b>Имя пользователя</b>: ' . strip_tags($random_username) . '</p>';
                $htmlBody .= '<p><b>Пароль</b>: ' . strip_tags($model->password) . '</p>';

                Yii::$app->mailer->compose()
                    ->setFrom(Yii::$app->params['senderEmail'])
                    ->setTo($model->email)
                    ->setSubject('Регистрация на сайте "Автошкола Гармония"')
                    ->setTextBody('Благодарим за заполнения формы на запись в автошколу. Ваши данные для входа на сайт автошколы:' .$textBody)
                    ->setHtmlBody('Благодарим за заполнения формы на запись в автошколу. Ваши данные для входа на сайт автошколы: <br>' .$htmlBody)
                    ->send();

                Yii::$app->mailer->compose()
                    ->setFrom(Yii::$app->params['senderEmail'])
                    ->setTo('alexflash27@yandex.ru')
                    ->setSubject('Заполнение заявления на сайте "Автошкола Гармония"')
                    ->setTextBody('Новый пользователь заполнил заявление на сайте: http://autoschool-test/application?sort=-updated_at')
                    ->setHtmlBody('Новый пользователь заполнил заявление на сайте: http://autoschool-test/application?sort=-updated_at')
                    ->send();

                //заполняем по шаблону и сохраняем договор//
                $document = new TemplateProcessor('C:\Users\user\Desktop\OpenServer\domains\autoschool-test\frontend\web\documents_templates\Договор кат.В детский.docx');

                $document->setValue('first_name', $model->first_name);
                $document->setValue('last_name', $model->last_name);
                $document->setValue('patronymic', $model->patronymic);
                $document->setValue('series_number', $model->series_number);
                $document->setValue('issued_by', $model->issued_by);
                $document->setValue('date_of_issue', $model->date_of_issue);
                $document->setValue('place_registration', $model->place_registration);
                $document->setValue('place_residence', $model->place_residence);
                $document->setValue('phone_number', $model->phone_number);

                $document->setValue('par_first_name', $model->par_first_name);
                $document->setValue('par_last_name', $model->par_last_name);
                $document->setValue('par_patronymic', $model->par_patronymic);
                $document->setValue('par_series_number', $model->par_series_number);
                $document->setValue('par_issued_by', $model->par_issued_by);
                $document->setValue('par_date_of_issue', $model->par_date_of_issue);
                $document->setValue('par_place_registration', $model->par_place_registration);
                $document->setValue('par_place_residence', $model->par_place_residence);
                $document->setValue('par_phone_number', $model->par_phone_number);

                $category_name = mb_substr($model->category, 0, 14, 'UTF-8');

                $document->saveAs('C:\Users\user\Desktop\OpenServer\domains\autoschool-test\frontend\web\documents\ '.$category_name.$model->last_name.' '.$model->first_name.'.docx');

                //данные прошли валидацию, отмечаем этот факт//
                Yii::$app->session->setFlash('success', 'Спасибо за заполнения формы. Ожидайте звонка.');
                //перезагружаем страницу, чтобы избежать повтороной отправки формы//
                return $this->refresh();
            } else {
                //данные не прошли валидацию, отмечаем этот факт//
                Yii::$app->session->setFlash('error', 'Данные не прошли проверку.');
                //не перезагружаем страницу, чтобы сохранить пользовательские данные//
            }
        }

        return $this->render('blankchild', ['model' => $model]);
    }

    /**
     * Displays a single ApplicationForm model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ApplicationForm model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ApplicationForm();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ApplicationForm model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ApplicationForm model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ApplicationForm model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ApplicationForm the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ApplicationForm::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
