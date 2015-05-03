<?php
namespace SimpleQuiz\Utils;

use SimpleQuiz\Utils\Base\User;
use SimpleQuiz\Utils\Exceptions\RegisterException;
use Slim\Slim;

class Simple implements Base\ISimple {
    
    public function addQuiz(Array $quizmeta)
    {
        $quiz = \ORM::for_table('quizzes')->create();
        $quiz->name = $quizmeta['name'];
        $quiz->description = $quizmeta['description'];
        $quiz->category = $quizmeta['category'];
        $quiz->active = $quizmeta['active']; 
        $quiz->set_expr('created', 'NOW()');
        $quiz->set_expr('updated', 'NOW()');
        $quiz->save();
        return true;
    }
    
    public function updateQuiz(Array $quizmeta)
    {
        $quiz = \ORM::for_table('quizzes')->find_one($quizmeta['id']);
        
        $quiz->set(array(
            'name' => $quizmeta['name'],
            'description' => $quizmeta['description'],
            'category' => $quizmeta['category'],
            'active' => $quizmeta['active']
        ));
        $quiz->set_expr('updated', 'NOW()');
        $quiz->save();
   
        return true;
    }
    
     public function deleteQuiz($quizid)
    {
        $quiz = \ORM::for_table('quizzes')->find_one($quizid);
        $quiz->delete();
        return true;
    }
    
    public function getQuizzes($active = true) {
        
        if ($active) {
            $quizzes = \ORM::for_table('quizzes')->join('categories', array('quizzes.category', '=', 'categories.id'))->select_many('quizzes.id', 'quizzes.name', 'quizzes.description', array('category' => 'categories.name'), 'quizzes.active')->where('active',1)->find_many();
        } else {
            $quizzes = \ORM::for_table('quizzes')->join('categories', array('quizzes.category', '=', 'categories.id'))->select_many('quizzes.id', 'quizzes.name', 'quizzes.description', array('category' => 'categories.name'), 'quizzes.active')->find_many();
        }
        return $quizzes;
    }
    
    public function getCategories($active = true) {
        if ($active) {
            $categories = \ORM::for_table('categories')->join('quizzes', array('quizzes.category', '=',
                'categories.id'))->select_many('categories.id','categories.name','categories.description',
                'quizzes.category','quizzes.active')->where('quizzes.active', 1)->find_many();
        }
        else {
            $categories = \ORM::for_table('categories')->find_many();
        }
        return $categories;
    }
    
    public function getCategory($id) {
        
        $category = \ORM::for_table('categories')->select_many('name','description')->find_one($id);
        
        return $category;
    }
    
    public function getCategoryQuizzes($id) {
        
        $quizzes = \ORM::for_table('quizzes')->join('categories', array('quizzes.category', '=', 'categories.id'))->select_many('quizzes.id', 'quizzes.name', 'quizzes.description', array('category' => 'categories.name'), 'quizzes.active')->where('quizzes.category', $id)->find_many();
        
        return $quizzes;
    }
    
    public function getUsers($quizid = true)
    {
        if($quizid)
        {
            $users = \ORM::for_table('quiz_users')->join('quizzes', array('quiz_users.quiz_id', '=',
                'quizzes.id'))->join('users', array('quiz_users.user_id', '=', 'users.id'))->select_many('users.name')
            ;

            return $users;
        }
    }

    public function quizUserExists($quizid, $userid){

        return \ORM::for_table('quiz_users')->where( array('quiz_id' => $quizid, 'user_id' => $userid) )->find_one();
    }

    /**
     * @param User $user
     * @return User $user
     * @throws RegisterException
     */
    public function registerUser(User $user)
    {
        $name = $user->getName();
        $email = $user->getEmail();
        $password = $user->getPassword();

        $userexists =  \ORM::for_table('users')->where_any_is(
                array(
                    array('name' => $name),
                    array('email' => $email)
                )
            )->find_one();

        if ($userexists)
        {
            throw new RegisterException;
        }
        else
        {
            //register a new user
            $newuser = \ORM::for_table('users')->create();
            $newuser->set('name', $name);
            $newuser->set('email', $email);
            $newuser->set('pass', $password);
            $newuser->save();
            $user->setId($newuser->id());

            return $user;
        }
    }

    public static function redirect(Slim $app, Session $session, $forward = false){

        // redirect them to intended url if required
        if ($forward)
        {
            if ($session->get('urlRedirect'))
            {
                $tmp = $session->get('urlRedirect');
                $session->remove('urlRedirect');
                $app->redirect($app->request->getRootUri() . $tmp);
            }
        }
        else
        {
            //log them in and send to home page
            $app->redirect($app->request->getRootUri() . '/');
        }
    }
}
