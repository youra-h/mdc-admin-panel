<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;

class UtilsController extends Controller
{
    public function actionCreateAdmin()
    {
        if ($this->createUser('admin', 'admin'))
            echo 'ok';
        else 
            echo 'error';
    }

    public function createUser($name, $pass) 
    {
        $user = new \common\models\User();
        $user->username = $name;
        $user->email = $name.'@example.ru';
        $user->status = \common\models\User::STATUS_ACTIVE;
        $user->setPassword($pass);
        $user->generateAuthKey();
        return $user->save();
    }

    public function actionPullUsers()
    {
        $name = array('Johnathon','Anthony','Erasmo','Raleigh','Nancie','Tama','Camellia','Augustine','Christeen','Luz','Diego','Lyndia','Thomas','Georgianna','Leigha','Alejandro','Marquis','Joan','Stephania','Elroy','Zonia','Buffy','Sharie','Blythe','Gaylene','Elida','Randy','Margarete','Margarett','Dion','Tomi','Arden','Clora','Laine','Becki','Margherita','Bong','Jeanice','Qiana','Lawanda','Rebecka','Maribel','Tami','Yuri','Michele','Rubi','Larisa','Lloyd','Tyisha','Samatha','Mischke','Serna','Pingree','Mcnaught','Pepper','Schildgen','Mongold','Wrona','Geddes','Lanz','Fetzer','Schroeder','Block','Mayoral','Fleishman','Roberie','Latson','Lupo','Motsinger','Drews','Coby','Redner','Culton','Howe','Stoval','Michaud','Mote','Menjivar','Wiers','Paris','Grisby','Noren','Damron','Kazmierczak','Haslett','Guillemette','Buresh','Center','Kucera','Catt','Badon','Grumbles','Antes','Byron','Volkman','Klemp','Pekar','Pecora','Schewe','Ramage');
        foreach ($name as $key => $value) {
            if ($this->createUser($value, '123456'))
                echo $value;
            else
                echo $value.' - error';
        }        
    }
}
