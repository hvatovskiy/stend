<?php

namespace frontend\models\agencyarticle;

use Yii;
use frontend\models\agency\Agency;//
use frontend\models\article\Article;//

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
class AgencyArticle extends \yii\db\ActiveRecord
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
            [['idlink', 'article_idarticle', 'agency_idagency'], 'integer'],
            [['linkdtime'], 'safe'],
            [['linkname'], 'string', 'max' => 100],
            [['agency_idagency'], 'exist', 'skipOnError' => true, 'targetClass' => Agency::className(), 'targetAttribute' => ['agency_idagency' => 'idagency']],
            [['article_idarticle'], 'exist', 'skipOnError' => true, 'targetClass' => Article::className(), 'targetAttribute' => ['article_idarticle' => 'idarticle']],
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
            'article_idarticle' => Yii::t('app', 'Article Idarticle'),
            'agency_idagency' => Yii::t('app', 'Agency Idagency'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAgencyIdagency()
    {
        return $this->hasOne(Agency::className(), ['idagency' => 'agency_idagency'])->inverseOf('agencyArticles');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticleIdarticle()
    {
        return $this->hasOne(Article::className(), ['idarticle' => 'article_idarticle'])->inverseOf('agencyArticles');
    }

    /**
     * @inheritdoc
     * @return AgencyArticleQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AgencyArticleQuery(get_called_class());
    }
}
