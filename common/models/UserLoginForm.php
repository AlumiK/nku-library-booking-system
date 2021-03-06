<?php

namespace common\models;

use Yii;
use yii\base\Model;

/**
 *
 * @property-read null|User $user
 */
class UserLoginForm extends Model
{
    public $student_id;
    public $password;
    public $rememberMe = true;

    private $_user;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['student_id', 'password'], 'required'],
            ['student_id', 'string', 'length' => 7],

            ['rememberMe', 'boolean'],

            ['password', 'validatePassword'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'student_id' => '学号',
            'password' => '密码',
            'rememberMe' => '保持登录状态',
        ];
    }

    /**
     * 验证密码是否正确
     *
     * @param string $attribute
     */
    public function validatePassword($attribute)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, '学号或密码不正确。');
            }
        }
    }

    /**
     * 根据给定的学号和密码登录学生
     *
     * @return bool
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        }

        return false;
    }

    /**
     * 根据 [[student_id]] 寻找学生模型
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByStudentId($this->student_id);
        }

        return $this->_user;
    }
}
