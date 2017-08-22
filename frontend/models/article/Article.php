<?php

namespace frontend\models\article;

use Yii;

use frontend\models\link\Link;

/**
 * This is the model class for table "article".
 *
 * @property integer $idarticle
 * @property string $articletitle
 * @property string $articleurl
 * @property string $description
 * @property string $newarticleurl
 * @property integer $isworkurl
 * @property string $articledtime
 *
 * @property Link[] $links
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['isworkurl'], 'integer'],
            [['articledtime'], 'safe'],
            [['articletitle', 'articleurl', 'newarticleurl'], 'string', 'max' => 1024],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idarticle' => Yii::t('app', 'Idarticle'),
            'articletitle' => Yii::t('app', 'Articletitle'),
            'articleurl' => Yii::t('app', 'Articleurl'),
            'description' => Yii::t('app', 'Description'),
            'newarticleurl' => Yii::t('app', 'Newarticleurl'),
            'isworkurl' => Yii::t('app', 'Isworkurl'),
            'articledtime' => Yii::t('app', 'Articledtime'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAgencyArticles()
    {
        return $this->hasMany(Link::className(), ['article_idarticle' => 'idarticle']);
    }

    /**
     * @inheritdoc
     * @return ArticleQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ArticleQuery(get_called_class());
    }
}
