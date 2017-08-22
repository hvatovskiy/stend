<?php

namespace frontend\models\agencyarticle;

/**
 * This is the ActiveQuery class for [[AgencyArticle]].
 *
 * @see AgencyArticle
 */
class AgencyArticleQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return AgencyArticle[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return AgencyArticle|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
