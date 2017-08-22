<?php

namespace frontend\models\message;

use frontend\models\link\Link;
use Yii;

/**
 * This is the model class for table "message".
 *
 * @property integer $idmessage
 * @property string $msgcontent
 * @property string $readdtime
 * @property string $senddtime
 *
 * @property Link[] $links
 */
class Message extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'message';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['msgcontent'], 'string'],
            [['readdtime', 'senddtime'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idmessage' => Yii::t('app', 'Idmessage'),
            'msgcontent' => Yii::t('app', 'Msgcontent'),
            'readdtime' => Yii::t('app', 'Readdtime'),
            'senddtime' => Yii::t('app', 'Senddtime'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLinksMesssages()
    {
        return $this->hasMany(Link::className(), ['message_idmessage' => 'idmessage'])->inverseOf('messageIdmessage');
    }

    /**
     * @inheritdoc
     * @return MessageQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MessageQuery(get_called_class());
    }
}
