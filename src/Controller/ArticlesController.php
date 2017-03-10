<?php
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;

class ArticlesController extends AppController {

    public function index() {
        $this->set('title_for_layout', 'Articles');
        $this->loadModel('Articles');
        $this->loadModel('Categories');

        $this->paginate = [
            'contain' => ['users', 'categories'],
            'conditions' => [
                'Articles.status' => 1
            ],
            'limit' => ARTICLES_PER_PAGE,
            'order' => [
                'Articles.id' => 'desc'
            ]
        ];
        $articles = $this->paginate($this->Articles);
        $this->set(compact('articles'));

        $slider_articles = $this->Articles->find('all')->where(['status' => 1, 'slider' => 1])->order(['id' => 'DESC'])->limit(SLIDER_ARTICLES_PER_PAGE);
        $this->set(compact('slider_articles'));

        //Load theme
        $this->viewBuilder()->templatePath('Themes/'.CAKEBLOG_THEME);
        $this->render('articles.index');
    }

    public function view($slug = NULL) {
        $article = $this->Articles->find('all')->where(['Articles.slug' => $slug, 'status' => 1])->contain(['users', 'categories'])->first();
        $this->loadModel('Pages');
        $page = $this->Pages->find('all')->where(['slug' => $slug])->first();
        if(!empty($article)) {
            $this->set('title_for_layout', $article->title);
            $this->set('description_for_layout', $article->metadescription);
            $this->set('keywords_for_layout', $article->metakeywords);
            $this->set('author_for_layout', $article->user->full_name);
            $this->set(compact('article'));
            //Load theme
            $this->viewBuilder()->templatePath('Themes/'.CAKEBLOG_THEME);
            $this->render('articles.view');
        } elseif(!empty($page)) {
            $this->set('title_for_layout', $page->title);
            $this->set(compact('page'));
            //Load theme
            $this->viewBuilder()->templatePath('Themes/'.CAKEBLOG_THEME);
            $this->render('pages.view');
        } else {
            $this->postType($slug);
        }
    }

    public function postType($slug = NULL) {
        $this->loadModel('Post_Type');
        $post_type = $this->Post_Type->find('all')->where(['slug' => $slug])->first();
        if(empty($post_type)) {
            throw new NotFoundException('Could not find that page.');
        }
        $this->set(compact('post_type'));
        $this->loadModel('Articles');
        $this->paginate = [
            'contain' => ['users', 'categories'],
            'conditions' => [
                'Articles.post_type_id' => $post_type->id,
                'Articles.status' => 1
            ],
            'limit' => ARTICLES_PER_PAGE,
            'order' => [
                'Articles.id' => 'desc'
            ]
        ];
        $articles = $this->paginate($this->Articles);
        $this->set(compact('articles'));

        $slider_articles = $this->Articles->find('all')->where(['status' => 1, 'slider' => 1, 'post_type_id' => $post_type->id])->order(['id' => 'DESC'])->limit(SLIDER_ARTICLES_PER_PAGE);
        $this->set(compact('slider_articles'));

        //Load theme
        $this->viewBuilder()->templatePath('Themes/'.CAKEBLOG_THEME);
        $this->render('articles.posttype');
    }

    public function rss() {
        $this->set('title_for_layout', ''.SITE_TITLE.' RSS');
        $this->viewBuilder()->layout('rss/default');
        $this->loadModel('Articles');
        $articles = $this->Articles->find('all')->where(['status' => 1])->order(['id' => 'DESC'])->limit(20);
        $this->set(compact('articles'));
        //Load theme
        $this->viewBuilder()->templatePath('Themes/'.CAKEBLOG_THEME);
        $this->render('articles.rss');
    }

    public function shortcode($string = NULL) {
        if (strpos($string, '[shortcode]') !== false) {
            $shortcode = $this->get_string_between($string, '[function]', '[/function]');
            if (strpos($string, '[args]') !== false) {
                $args_call = $this->get_string_between($string, '[args]', '[/args]');
                $args = explode(',', $args_call);
                $shortcode_call = call_user_func(array($this, $shortcode), $args);
                $shortcode_final = str_replace('[shortcode][function]'.$shortcode.'[/function][args]'.$args_call.'[/args][/shortcode]', $shortcode_call, $string);
            } else {
                $shortcode_call = call_user_func(array($this, $shortcode));
                $shortcode_final = str_replace('[shortcode][function]'.$shortcode.'[/function][/shortcode]', $shortcode_call, $string);
            }
        } else {
            $shortcode_final = $string;
        }
        return $shortcode_final;
    }

    public function get_string_between($string, $start, $end){
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }

    public function gallery($string = NULL) {
        if (strpos($string, '[gallery]') !== false) {
            $gallery = $this->get_string_between($string, '[gallery]', '[/gallery]');
            $columns = substr($gallery, 0, 1);
            $gallery_array = substr($gallery,1);
            $args = explode(',', $gallery_array);
            $count = 1;
            $display = '';
            $display .= '<div class="gallery">';
            $display .= '<div class="row">';
            foreach ($args as $arg) {
                if (strpos($arg, '==') !== false) {
                    $image = current(explode('==', $arg));
                    $arg_explode = explode('==', $arg);
                    $image_title = end($arg_explode);
                } else {
                    $image = $arg;
                    $image_title = SITE_TITLE;
                }
                $display .= '<div class="col-sm-'.$columns.'">';
                $display .= '<a href="#" data-toggle="modal" data-target="#galleryModal' . $count . '">';
                $display .= '<img class="img-responsive img-thumbnail" src="' . $image . '" />';
                $display .= '</a>';
                $display .= '<!-- Modal -->
<div id="galleryModal' . $count . '" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">' . $image_title . '</h4>
      </div>
      <div class="modal-body">
      <img class="center-block img-responsive" src="' . $image . '" />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>';
                $display .= '</div>';
                if($columns == 2) {
                    if ($count % 6 == 0) {
                        $display .= '</div><div class="row">';
                    }
                } elseif($columns == 3) {
                    if ($count % 4 == 0) {
                        $display .= '</div><div class="row">';
                    }
                } elseif($columns == 4) {
                    if ($count % 3 == 0) {
                        $display .= '</div><div class="row">';
                    }
                } elseif($columns == 6) {
                    if ($count % 2 == 0) {
                        $display .= '</div><div class="row">';
                    }
                }
                $count++;
            }
            $display .= '</div>';
            $display .= '</div>';
            $gallery_final = str_replace('[gallery]'.$gallery.'[/gallery]', $display, $string);
        } else {
            $gallery_final = $string;
        }
        return $gallery_final;
    }

    public function instagram($string = NULL) {
        if (strpos($string, '[instagram]') !== false) {
            $this->loadModel('Instagram');
            $instagram_images = $this->Instagram->find('all')->where(['status' => 1])->order(['id' => 'DESC']);

            $gallery = $this->get_string_between($string, '[instagram]', '[/instagram]');
            $columns = substr($gallery, 0, 1);

            $count = 1;
            $display = '';
            $display .= '<div class="instagram">';
            $display .= '<div class="row">';
            foreach ($instagram_images as $image) {
                $display .= '<div class="col-sm-'.$columns.'">';
                $display .= '<a target="blank" data-toggle="modal" data-target="#instagramModal'.$count.'">';
                $display .= '<img class="img-thumbnail center-block" src="'.BASE_URL.'/uploads/instagram/sm/'.$image->image.'" alt="'.$image->title.'" />';
                $display .= '</a>';
                $display .= '</div>';
                $display .= '<div id="instagramModal'.$count.'" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">'.$image->title.' | '.$image->created_time.'</h4>
      </div>
      <div class="modal-body">
        <img class="img-responsive center-block" src="'.BASE_URL.'/uploads/instagram/lg/'.$image->image.'" />
        <p><div class="label label-default">Description</div></br>'.$image->title.' | '.$image->created_time.'</p>
        <p><div class="label label-default">Link to Instagram post</div></br><a href="'.$image->link.'" target="_blank">'.$image->link.'</a></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>';
                if($columns == 2) {
                    if ($count % 6 == 0) {
                        $display .= '</div><div class="row">';
                    }
                } elseif($columns == 3) {
                    if ($count % 4 == 0) {
                        $display .= '</div><div class="row">';
                    }
                } elseif($columns == 4) {
                    if ($count % 3 == 0) {
                        $display .= '</div><div class="row">';
                    }
                } elseif($columns == 6) {
                    if ($count % 2 == 0) {
                        $display .= '</div><div class="row">';
                    }
                }
                $count++;
            }
            $display .= '</div>';
            $display .= '</div>';
            $gallery_final = str_replace('[instagram]'.$gallery.'[/instagram]', $display, $string);
        } else {
            $gallery_final = $string;
        }
        return $gallery_final;
    }
}
