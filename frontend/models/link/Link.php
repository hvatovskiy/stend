<?php

namespace frontend\models\link;

use Yii;
use frontend\models\agency\Agency;//
use frontend\models\article\Article;//
use frontend\models\message\Message;//
use frontend\models\user\User;//

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
class Link extends \yii\db\ActiveRecord
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
            //[['idlink'], 'required'],
            [['idlink', 'user_iduserfrom', 'user_iduserto', 'message_idmessage', 'article_idarticle', 'agency_idagency' ], 'integer'],
			[['linkdtime', 'article_idarticle', 'agency_idagency' ], 'safe'],
            [['linkname'], 'string', 'max' => 100],
            [['agency_idagency'], 'exist', 'skipOnError' => true, 'targetClass' => Agency::className(), 'targetAttribute' => ['agency_idagency' => 'idagency']],
            [['article_idarticle'], 'exist', 'skipOnError' => true, 'targetClass' => Article::className(), 'targetAttribute' => ['article_idarticle' => 'idarticle']],
            [['message_idmessage'], 'exist', 'skipOnError' => true, 'targetClass' => Message::className(), 'targetAttribute' => ['message_idmessage' => 'idmessage']],
            [['user_iduserfrom'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_iduserfrom' => 'id']],
            [['user_iduserto'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_iduserto' => 'id']],
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
            //'agency_idagency' => Yii::t('app', 'Agency Idagency'),
            //'article_idarticle' => Yii::t('app', 'Article Idarticle'),
			'agency_idagency' => Yii::t('app', 'Agency Name'),//
            'article_idarticle' => Yii::t('app', 'Article Title'),//
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAgencyIdagency()
    {
        return $this->hasOne(Agency::className(), ['idagency' => 'agency_idagency'])->inverseOf('links');
    }
	
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticleIdarticle()
    {
        return $this->hasOne(Article::className(), ['idarticle' => 'article_idarticle'])->inverseOf('links');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessageIdmessage()
    {
        return $this->hasOne(Message::className(), ['idmessage' => 'message_idmessage'])->inverseOf('linksMesssages');
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
     * @inheritdoc
     * @return LinkQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LinkQuery(get_called_class());
    }
}
