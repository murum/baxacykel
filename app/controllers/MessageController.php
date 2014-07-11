<?php

class MessageController extends BaseController {

    protected $layout = 'templates.layout.master';

    public function getIndex() {
        $user = Auth::user();

        $messages = Message::
            where('reciever', '=', $user->id)
            ->orderby('created_at', 'DESC')
            ->take(15)
            ->get();

        $this->layout->content = View::make('message.index')
            ->with('messages', $messages);
    }

    public function getIndexMember($id) {
        $user = Auth::user();

        $messages = Message::
            where('reciever', '=', $user->id)
            ->orderby('created_at', 'DESC')
            ->take(15)
            ->get();

        try {
            $reciever = User::where('id', '=', $id)->firstOrFail();

            $this->layout->content = View::make('message.index')
                ->with('messages', $messages)
                ->with('reciever', $reciever);

        } catch(Exception $ex) {
            $this->layout->content = View::make('message.index')
                ->with('messages', $messages);
        }
    }

    public function postMessage() {
        $user = Auth::user();
        $reciever_name = Input::get('reciever');

        $reciever = User::where('username', '=', $reciever_name)->first();

        if(!isset($reciever)) {
            return Redirect::to('/meddelanden')->with('error', 'Användaren du försökte skicka till finns inte');
        }

        $content = Input::get('content');
        $title = Input::get('title');

        $message = new Message;
        $message->reciever = $reciever->id;
        $message->sender = $user->id;
        $message->message = $content;
        $message->title = $title;
        if( $message->save() ) {
            return Redirect::to('/meddelanden')->with('success', 'Meddelandet blev skickat!');
        } else {
            return Redirect::to('/meddelanden')->with('error', 'Ett oväntat fel inträffade, vänligen försök igen');
        }
    }

    public function postDeleteMessage() {
        $user = Auth::user();
        $id = Input::get('message_id');
        try {
            $message = Message::where('id', '=', $id)->firstOrFail();

            if( $user->id != $message->reciever ) {
                return Redirect::to('/meddelanden')->with('error', 'Du försökte ta bort ett meddelande som du ej är mottagare på.');
            }

            $message->delete();
            return Redirect::to('/meddelanden')->with('success', 'Meddelandet togs bort.');

        } catch (Exception $e) {
            return Redirect::to('/meddelanden')->with('error', 'Meddelandet du försökte ta bort existerar inte.');
        }
    }

    public function putReadMessage() {
        $user = Auth::user();
        $id = Input::get('message');

        try {
            $message = Message::where('id', '=', $id)->firstOrFail();

            if( $user->id != $message->reciever ) {
                return Response::json(array('success' => false, 'message' => 'Du försökte ta bort ett meddelande som du ej är mottagare på.'));
            }

            $message->read = true;
            if( $message->save() ) {
                return Response::json(array('success' => true, 'message' => $id));
            }

        } catch (Exception $e) {
            return Response::json(array('success' => false, 'message' => 'Meddelandet du försökte ta bort existerar inte.'));
        }
    }

}