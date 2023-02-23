<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\User;
use yii\helpers\ArrayHelper;

/**
 * UserSearch represents the model behind the search form about `backend\models\User`.
 */
class UserSearch extends Model
{
    public $id;
    public $username;
    public $email;  
    public $created_at;
    public $updated_at; 
    // public $last_name;
    // public $first_name;
    // public $status_ref_ident;
    // public $date_add_from;
    // public $date_add_to;

    // public $date_add;
    // public $date_modify;

    /**
     * @inheritdoc
     */

    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['username', 'email'], 'safe'],
            [['created_at', 'updated_at'], 'date'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => Yii::t('app', 'USER_NAME'),
            'email' => Yii::t('app', 'USER_EMAIL'),
        ];
    }

    /**
     * @inheritdoc
     */
    // public function scenarios()
    // {
    //     // bypass scenarios() implementation in the parent class
    //     return Model::scenarios();
    // }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params = [])
    {
        $query = User::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['id' => SORT_ASC],
            ],
            'pagination' => [
                'pageSize' => ArrayHelper::getValue($params, 'per-page', 10),
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            
            // 'status_ref_ident' => $this->status_ref_ident,
        ]);

        $query->andFilterWhere(['<', 'id', 22]);

        // if (!empty($this->role)) {
        //     $subQuery = (new \yii\db\Query)
        //         ->select('item_name')
        //         ->from('auth_assignment au')
        //         ->where('au.user_id = user.id')
        //         ->andFilterWhere(['au.item_name' => $this->role]);

        //     $query->andFilterWhere(['exists', $subQuery]);
        // }

        // $query->andFilterWhere(['like', 'username', $this->username])
        // ->andFilterWhere(['like', 'email', $this->email])
        // // ->andFilterWhere(['=', 'role', $this->role])
        // ->andFilterWhere(['like', 'last_name', $this->last_name])
        // ->andFilterWhere(['like', 'first_name', $this->first_name])
        // ->andFilterWhere(['>=', 'date_add', $this->date_add_from ? strtotime($this->date_add_from . ' 00:00:00') : null])
        // ->andFilterWhere(['<=', 'date_add', $this->date_add_to ? strtotime($this->date_add_to . ' 23:59:59') : null]);

        return $dataProvider;
    }
}
