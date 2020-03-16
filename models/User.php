<?php
namespace app\models;
use yii\base\NotSupportedException;
use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;


use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Calendar[] $calendars
 */
class User extends ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'auth_key', 'hash_pass', 'email'], 'required'],
          
            [['name', 'hash_pass', 'passwd_reset_token', 'email'], 'string'],
         
            [['name'], 'unique'],
            [['email'], 'unique'],
            [['passwd_reset_token'], 'unique'],
            [['email'],'email']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
          
            'name' => 'Имя пользователя',
            
            'hash_pass' => 'Пароль',
           
            'email' => 'Email',
           
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */

    public function fields(){
        return ['id','email','name'];
    }


    public static function findIdentity($id)
    {
             return static::findOne(['id' => $id]);
    }
        /**
        * {@inheritdoc}
        */
     public static function findIdentityByAccessToken($token, $type = null)
    {
        return  static::findOne(['auth_key' => $token]);
    }
        /**
        * Finds user by username
        *
        * @param string $username
        * @return static|null
        */
    public static function findByUsername($name)
    {
        return static::findOne(['name' => $name]);
    }
        /**
        * {@inheritdoc}
        */
    public function getId()
    {
        return $this->getPrimaryKey();
    }
        /**
        * {@inheritdoc}
        */

    public function getAuthKey()
    {
        return $this->auth_key;
    }
        /**
        * {@inheritdoc}
        */
     public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }
        /**
        * Validates password
        *
        * @param string $password password to validate
        * @return bool if password provided is valid for current user
        */
    public function validatePassword($password)
    {
        return  Yii::$app->security->validatePassword($password,$this->hash_pass);
    }
        /**
        * Generates password hash from password and sets it to the model
        *
        * @param string $password
        */
    public function setPassword($password)
    {
        $this->hash_pass = Yii::$app->security->generatePasswordHash($password);
    }
        /**
        * Generates "remember me" authentication key
        */

    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }
    public function getActivity()
    {
    
    return $this->hasOne(Activity::className(),['id_user' => 'id']);
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => CompositeAuth::className(),
            'authMethods' => [
                HttpBasicAuth::className(),
                HttpBearerAuth::className(),
                QueryParamAuth::className(),
            ],
        ];
        return $behaviors;
     }

}