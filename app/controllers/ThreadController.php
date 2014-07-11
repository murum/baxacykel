<?php

class ThreadController extends BaseController {

    protected $layout = 'templates.layout.master';

    public function getIndex($id) {

        $thread = Thread::find($id);

        if ( ! $thread ) {
            $this->layout->content = View::make('forums.notfound');
        } else { 
            $this->layout->content = View::make('forums.thread')->with('thread', $thread);
        }
    }

    public function postThread() {

        $validator = Validator::make(Input::all(), Thread::$rules);
 
        if ($validator->passes()) {

            $thread = new Thread();

            $category_id = Input::get('category_id');

            $category = Category::findOrFail($category_id);

            $thread->title = Input::get('title');
            $thread->category_id = $category->id;
            $thread->content = Input::get('content');
            $thread->user_id = Auth::user()->id;
            $thread->last_post = date('Y-m-d H:i:s');

            $thread->save();

            return Redirect::to('trad/' . $thread->id)->with('message', 'Tråden skapad!');
        }

        return Redirect::to('/forum#create-thread')->withErrors($validator)->withInput();

    }

}