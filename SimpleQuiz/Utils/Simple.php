<?php
namespace SimpleQuiz\Utils;

class Simple implements Base\SimpleInterface {
    
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
            $categories = \ORM::for_table('categories')->join('quizzes', array('quizzes.category', '=', 'categories.id'))->select_many('categories.id','categories.name','categories.description','quizzes.category')->find_many(); 
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
    
    public function getUsers($quizid = false)
    {
        
    }
}
