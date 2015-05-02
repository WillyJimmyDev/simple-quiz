<?php
namespace SimpleQuiz\Utils;

use SimpleQuiz\Utils\Base\User;

class LeaderBoard {
    
    public function getMembers($quizid, $number = false)
    {  
        $members = \ORM::for_table('users')
                ->left_outer_join('quiz_users', array('quiz_users.user_id', '=', 'users.id'))
                ->where('quiz_users.quiz_id', $quizid)
                ->order_by_desc('quiz_users.score')
                ->find_array();
        
        if ($number)
        {
            usort($members, array('\SimpleQuiz\Utils\Base\Utils', 'memberSort') );
            return array_slice($members, 0, $number, true);
        }
        
        return $members;
    }
    
    public function addMember($quizid, User $user,$score,$start,$end,$timetaken)
    {  
        //this should be called at start of quiz and fail if user already exists
        //record should be updated at end of quiz with score etc
        $quser =  \ORM::for_table('users')->where('name', $user->getName())->find_one();
        $userid = $quser->id();
        
        $quizuser = \ORM::for_table('quiz_users')->create();
        $quizuser->set(array(
            'quiz_id' => $quizid,
            'user_id'  => $userid,
            'score' => $score,
            'start_time' => $start,
            'date_submitted' => $end,
            'time_taken' => $timetaken
        ));
        $quizuser->save();
        return true;
    }
}
