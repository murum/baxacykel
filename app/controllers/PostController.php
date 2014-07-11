<?php

class PostController extends BaseController {

    public function reply() {

        $thread_id = (int) Input::get('thread_id');
        try {
            $thread = Thread::findOrFail($thread_id);


            $content = Input::get('content');

            if($content != '') {
                $post = new Post();
                $post->content = $content;
                $post->user_id = Auth::user()->id;
                $post->thread_id = $thread->id;
                if($post->save()) {

                    $thread->last_post = date('Y-m-d H:i:s');
                    $thread->save();

                    return Redirect::to('trad/' . $thread->id)->with('message', 'Postat!');
                } else {
                    return Redirect::to('trad/' . $thread->id)->with('error', 'Oväntat fel inträffade, försök igen! Ifall felet kvarstår vänligen kontakta en administratör');
                }
            } else {
                return Redirect::to('trad/' . $thread->id)->with('error', 'Du måste ange innehåll i ditt svar..');
            }

        } catch (Exception $e) {
            return Redirect::to('forum/')->with('warning', 'Tråden du sökte finns ej!');
        }
    }


}