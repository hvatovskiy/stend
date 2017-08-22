<?php

namespace frontend\models\agency;

use Yii;

use frontend\models\link\Link;


/**
 * This is the model class for table "agency".
 *
 * @property integer $idagency
 * @property string $agencyname
 * @property string $agencywebsite
 *
 * @property Link[] $links
 */
class Agency extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'agency';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idagency'], 'required'],
            [['idagency'], 'integer'],
            [['agencyname', 'agencywebsite'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idagency' => Yii::t('app', 'Idagency'),
            'agencyname' => Yii::t('app', 'Agencyname'),
            'agencywebsite' => Yii::t('app', 'Agencywebsite'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAgencyArticles()
    {
        return $this->hasMany(Link::className(), ['agency_idagency' => 'idagency'])->inverseOf('agencyIdagency');
    }

    /**
     * @inheritdoc
     * @return AgencyQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AgencyQuery(get_called_class());
    }
}
