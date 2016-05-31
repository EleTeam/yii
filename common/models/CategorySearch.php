<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Category;

/**
 * CategorySearch represents the model behind the search form about `common\models\Category`.
 */
class CategorySearch extends Category
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'featured', 'image', 'featured_image', 'image_small', 'name', 'parent_id', 'del_flag', 'create_date', 'create_by', 'update_date', 'update_by', 'short_description', 'app_featured_home', 'parent_ids', 'remarks', 'is_audit', 'meta_keywords', 'meta_description', 'href', 'href_target', 'image_medium', 'image_large'], 'safe'],
            [['sort', 'app_featured_home_sort'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Category::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'sort' => $this->sort,
            'create_date' => $this->create_date,
            'update_date' => $this->update_date,
            'app_featured_home_sort' => $this->app_featured_home_sort,
        ]);

        $query->andFilterWhere(['like', 'id', $this->id])
            ->andFilterWhere(['like', 'featured', $this->featured])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'featured_image', $this->featured_image])
            ->andFilterWhere(['like', 'image_small', $this->image_small])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'parent_id', $this->parent_id])
            ->andFilterWhere(['like', 'del_flag', $this->del_flag])
            ->andFilterWhere(['like', 'create_by', $this->create_by])
            ->andFilterWhere(['like', 'update_by', $this->update_by])
            ->andFilterWhere(['like', 'short_description', $this->short_description])
            ->andFilterWhere(['like', 'app_featured_home', $this->app_featured_home])
            ->andFilterWhere(['like', 'parent_ids', $this->parent_ids])
            ->andFilterWhere(['like', 'remarks', $this->remarks])
            ->andFilterWhere(['like', 'is_audit', $this->is_audit])
            ->andFilterWhere(['like', 'meta_keywords', $this->meta_keywords])
            ->andFilterWhere(['like', 'meta_description', $this->meta_description])
            ->andFilterWhere(['like', 'href', $this->href])
            ->andFilterWhere(['like', 'href_target', $this->href_target])
            ->andFilterWhere(['like', 'image_medium', $this->image_medium])
            ->andFilterWhere(['like', 'image_large', $this->image_large]);

        return $dataProvider;
    }
}
