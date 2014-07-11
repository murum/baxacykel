<?php

class ChatMessageTableSeeder extends Seeder {

    public function run()
    {
        DB::table('chat_messages')->delete();

        $data = array(
            array(
                'user_id' => 1,
                'message' => 'Välkommen till chatten för baxacykel.se',
            ),
        );

        DB::table('chat_messages')->insert($data);
    }

}