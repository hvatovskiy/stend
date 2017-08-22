<?php

namespace frontend\models\blog;

use Yii;
use frontend\models\user\User;//
use frontend\models\message\Message;//

/**
 * This is the model class for table "link".
 *
 * @property integer $idlink
 * @property string $linkname
 * @property string $linkdtime
 * @property integer $user_iduserfrom
 * @property integer $user_iduserto
 * @property integer $message_idmessage
 * @property integer $article_idarticle
 * @property integer $agency_idagency
 *
 * @property Agency $agencyIdagency
 * @property Article $articleIdarticle
 * @property Message $messageIdmessage
 * @property User $userIduserfrom
 * @property User $userIduserto
 */
class Blog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'link';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idlink'], 'required'],
            [['idlink', 'user_iduserfrom', 'user_iduserto', 'message_idmessage', 'article_idarticle', 'agency_idagency'], 'integer'],
            [['linkdtime'], 'safe'],
            [['linkname'], 'string', 'max' => 100],
            [['user_iduserfrom'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_iduserfrom' => 'id']],
            [['user_iduserto'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_iduserto' => 'id']],
            [['message_idmessage'], 'exist', 'skipOnError' => true, 'targetClass' => Message::className(), 'targetAttribute' => ['message_idmessage' => 'idmessage']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idlink' => Yii::t('app', 'Idlink'),
            'linkname' => Yii::t('app', 'Linkname'),
            'linkdtime' => Yii::t('app', 'Linkdtime'),
            'user_iduserfrom' => Yii::t('app', 'User Iduserfrom'),
            'user_iduserto' => Yii::t('app', 'User Iduserto'),
            'message_idmessage' => Yii::t('app', 'Message Idmessage'),
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserIduserfrom()
    {
        return $this->hasOne(User::className(), ['id' => 'user_iduserfrom'])->inverseOf('linksUsersFrom');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserIduserto()
    {
        return $this->hasOne(User::className(), ['id' => 'user_iduserto'])->inverseOf('linksUsersTo');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessageIdmessage()
    {
        return $this->hasOne(Message::className(), ['idmessage' => 'message_idmessage'])->inverseOf('linksMesssages');
    }

}
