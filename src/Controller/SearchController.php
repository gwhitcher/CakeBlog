<?php
namespace App\Controller;

class SearchController extends AppController {

    public function index() {
        $this->set('title_for_layout', 'Search');
        $this->loadModel('Articles');
        $this->loadModel('Categories');
        $this->loadModel('Post_Type');
        $this->loadModel('Pages');

        $category_array = array
        (
            array(1,'Articles', ''),
            array(2,'Categories', ''),
            array(3,'Pages', '')
        );
        $post_types = $this->Post_Type->find('all');
        $this->set(compact('post_types'));
        $count = 4;
        foreach($post_types as $post_type) {
            array_push($category_array, array($count, $post_type->title, $post_type->id));
            $count++;
        }
        $this->set(compact('category_array'));

        if (!empty($this->request->query['category'])) {
            $keyword = $this->request->query['keyword'];
            $category = $this->request->query['category'];
            if(empty($keyword)) {
                $this->Flash->set('Keyword not entered.  Keyword is required.',
                    ['element' => 'alert-box',
                        'params' => [
                            'class' => 'danger'
                        ]]
                );
            } else {
                foreach($category_array as $cat_array) {
                    if($cat_array[0] == $category) {
                        if (!empty($cat_array[2])) {
                            $this->set('search_results', $this->Articles->find('all', array('order' => 'Articles.id DESC', 'conditions' => array(
                                'OR' => array(
                                    'Articles.title LIKE' => "%$keyword%",
                                    'Articles.body LIKE' => "%$keyword%"
                                ))))->where(['Articles.post_type_id' => $cat_array[2]]));
                        } else {
                            $this->set('search_results', $this->$cat_array[1]->find('all', array('order' => $cat_array[1] . '.id DESC', 'conditions' => array(
                                'OR' => array(
                                    $cat_array[1] . '.title LIKE' => "%$keyword%",
                                    $cat_array[1] . '.body LIKE' => "%$keyword%"
                                )))));
                        }
                        }
                }
            }

        }

        //Load theme
        $this->viewBuilder()->templatePath('Themes/'.CAKEBLOG_THEME);
        $this->render('search.index');
    }


}